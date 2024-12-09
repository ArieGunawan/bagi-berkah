<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DonationController::class, 'index'])->name('donations.index');
Route::get('/about', [DonationController::class, 'about'])->name('donations.about');
Route::get('/donation', [DonationController::class, 'donation'])->name('donations.donate')->middleware('auth');
Route::post('/donation', [DonationController::class, 'store']);
Route::get('/status', [DonationController::class, 'status'])->name('donations.status')->middleware('auth');
Route::get('/blogs', [BlogController::class, 'blog'])->name('donations.blog')->middleware('auth');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('donations.create')->middleware('auth');
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/{blog:title}/view', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', [DonationController::class, 'index'])->middleware(['auth', 'verified'])->name('');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

require __DIR__.'/auth.php';
