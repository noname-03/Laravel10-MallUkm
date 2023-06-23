<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CategoryProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    // Registration Routes...
    'reset' => false,
    // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categoryProduct', CategoryProductController::class);