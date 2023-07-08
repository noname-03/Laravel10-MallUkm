<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;

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
        Route::post('refresh', [AuthController::class, 'refresh']);

        Route::get('cart', [CartController::class, 'index']);
        Route::post('cart', [CartController::class, 'store']);
    });
});

Route::get('category', [CategoryProductController::class, 'index']);

Route::get('product', [ProductController::class, 'index']);
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::get('product/recomendation', [ProductController::class, 'recomendation']);