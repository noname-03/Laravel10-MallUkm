<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileCompanyController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('getUser', [AuthController::class, 'getUser']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('cart', [CartController::class, 'index']);
        Route::post('cart/store', [CartController::class, 'store']);
        Route::post('cart/update/{id}', [CartController::class, 'update']);
        Route::post('cart/delete/{id}', [CartController::class, 'delete']);

        Route::get('address', [AddressController::class, 'index']);
        Route::post('address/store', [AddressController::class, 'store']);
        Route::post('address/update/{id}', [AddressController::class, 'update']);
        Route::post('address/delete/{id}', [AddressController::class, 'delete']);
        Route::get('address/selected', [AddressController::class, 'selected']);
        Route::post('address/update/{id}/selected', [AddressController::class, 'updateSelected']);

        Route::get('transaction', [TransactionController::class, 'index']);
        Route::post('transaction/store', [TransactionController::class, 'createPayment']);
        Route::get('transaction/show/{id}', [TransactionController::class, 'show']);
        Route::get('transaction/{params}', [TransactionController::class, 'sortByStatus']);

        Route::post('change/password', [UserController::class, 'changePassword']);

    });
});

Route::get('profile/company', [ProfileCompanyController::class, 'index']);

Route::get('category', [CategoryProductController::class, 'index']);
Route::get('category/show/{id}', [CategoryProductController::class, 'show']);
Route::get('category/recomendation', [CategoryProductController::class, 'recomendation']);

Route::get('product', [ProductController::class, 'index']);
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::get('product/recomendation/{params}', [ProductController::class, 'recomendation']);
Route::get('product/promo', [ProductController::class, 'promo']);
Route::get('carousel', [CarouselController::class, 'index']);
Route::post('midtrans/callback', [TransactionController::class, 'callback']);
