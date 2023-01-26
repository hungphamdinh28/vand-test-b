<?php

use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\ProductController;

// Auth
\Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    \Route::post('login', [AuthController::class, 'login'])->name('login');
    \Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    \Route::patch('reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    \Route::get('user', [AuthController::class, 'getUserAuth'])->name('user')->middleware('auth:api');
    \Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:api');
    \Route::get('get-user', [AuthController::class, 'getUser'])->middleware('auth:api');
});

\Route::group(['middleware' => 'auth:api'], function() {
    // Marketplace Admin only routes
    \Route::group(['as' => 'catalog.', 'prefix' => 'catalog'], function() {
        // Product Routes
        \Route::apiResource('product', 'ProductController');

        \Route::apiResource('store', 'StoreController');
    });
});
