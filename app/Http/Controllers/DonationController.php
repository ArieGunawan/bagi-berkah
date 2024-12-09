<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class DonationController extends Controller
{
    public function __construct()
    {
    \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
    \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
    \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
    \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index(){
        return view('donation.home');
    }

    public function status(){
        $donations = Donation::orderBy('id', 'ASC')->paginate(8);
        return view('donation.statusTransaction', compact('donations'));
    }

    public function about(){
        return view('donation.about');
    }

    public function donation(){
        return view('donation.donate');
    }

    public function store(Request $request){
        DB::transaction(function() use ($request){
            $donation = Donation::create([
                'transaction_id' => Str::uuid(),
                'donatur_name' => $request->donatur_name,
                'donation_type' => $request->donation_type,
                'amount' => $request->amount,
                'note' => $request->note,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id' => $donation->transaction_id,
                    'gross_amout' => $donation->amount,
                ],
                'customer_details' => [
                    'first_name' => $donation->donatur_name,
                ],
                'item_details' => [
                    [
                        'id' => $donation->donation_type,
                        'price' => $donation->amount,
                        'quantity' => 1,
                        'name' => ucwords(str_replace('_', ' ', $donation->donation_type))
                    ]
                ]
            ];

            $snaptoken = \Midtrans\Snap::getSnapToken($payload);
            $donation->snap_token = $snaptoken;
            $donation->save();

            $this->response['snap_token'] = $snaptoken;

        });

        return response()->json($this->response);
    }

    public function notification(){
        $notif = new \Midtrans\Notification();

        DB::transaction(function () use ($notif) {
            $transactionStatus = $notif->transaction_status;
            $paymentType = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraudStatus = $notif->fraud_status;
            $donation = Donation::where('transaction_id', $orderId)->first();

            if($transactionStatus == 'capture'){
                if($paymentType == 'credit_card'){
                    if($fraudStatus == 'challenge'){
                        $donation->setStatusPending();
                    }else{
                        $donation->setStatusSuccess();
                    }
                }
            }else if($transactionStatus == 'settlement'){
                $donation->setStatusSuccess();
            }else if($transactionStatus == 'pending'){
                $donation->setStatusPending();
            }else if($transactionStatus == 'deny'){
                $donation->setStatusFailed();
            }else if($transactionStatus == 'expire'){
                $donation->setStatusExpired();
            }else if($transactionStatus == 'cancel'){
                $donation->setStatusFailed();
            }
        });
        return;
    }
}
