@extends('layouts.main')

@section('container')
<div class="w-full overflow-x-auto">
    @if ($donations->count())
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Donatur</th>
                <th class="px-4 py-2 text-right">Jumlah</th>
                <th class="px-4 py-2 text-left">Tipe Donasi</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-right"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($donations as $donation)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $donation->id }}</td>
                <td class="px-4 py-2">{{ $donation->donatur_name }}</td>
                <td class="px-4 py-2 text-right">Rp.{{ number_format($donation->amount) }}</td>
                <td class="px-4 py-2">{{ ucwords(str_replace('_', ' ', $donation->donation_type)) }}</td>
                <td class="px-4 py-2">{{ ucFirst($donation->status) }}</td>
                @if ($donation->status == 'pending')
                <td class="px-4 py-2 text-right">
                    <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                        onclick="snap.pay('{{ $donation->snap_token }}')">
                        Complete Pay
                    </button>
                </td>
                @else
                <td class="px-4 py-2"></td>
                @endif
            </tr>
            @endforeach

        </tbody>
    </table>
    </div>
    <div class="flex justify-center w-full mt-4">
        {{ $donations->links() }}
    </div>
    @else
        <p class="flex items-center justify-center h-screen text-center text-gray-500">No Transaction for now.</p>
    @endif

<script src="https://code.jquery.com/jquery-3.4.1.min.js">
</script>
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('services.midtrans.clientKey') }}">
</script>
@endsection
