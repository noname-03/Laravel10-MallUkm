<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CategoryProductController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CarouselController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    // Registration Routes...
    'reset' => false,
    // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('categoryProduct', CategoryProductController::class);
    Route::resource('Product', ProductController::class);
    Route::resource('carousel', CarouselController::class);
});