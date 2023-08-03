<?php

use App\Http\Controllers\Web\AnswerController;
use App\Http\Controllers\Web\ResultController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CategoryProductController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\CarouselController;
use App\Http\Controllers\Web\TransactionController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ProfileCompanyController;
use App\Http\Controllers\Web\QuestionController;

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
    Route::middleware('admin')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('categoryProduct', CategoryProductController::class);
        Route::resource('Product', ProductController::class);
        Route::resource('carousel', CarouselController::class);
        Route::resource('user', UserController::class);
        Route::resource('profileCompany', ProfileCompanyController::class);

        Route::resource('transaction', TransactionController::class);

        Route::resource('question', QuestionController::class);
        Route::get('answer', [AnswerController::class, 'index'])->name('answer.index');
        Route::resource('result', ResultController::class);
    });
});