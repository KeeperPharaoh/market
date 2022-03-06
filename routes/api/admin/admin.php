<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\UserController;
/*
|--------------------------------------------------------------------------
| Routes for Admin
|--------------------------------------------------------------------------
|
| These routes were generated for group Admin
| All of them have prefix /api/v1/admin
|
*/
Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/paginate', [CategoryController::class, 'paginate']);
        Route::get('categories/{id}', [CategoryController::class, 'show']);
        Route::post('categories', [CategoryController::class, 'store']);
        Route::post('categories/{id}', [CategoryController::class, 'update']);
        Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

        Route::get('products', [ProductController::class, 'index']);
        Route::get('products/paginate', [ProductController::class, 'paginate']);
        Route::get('products/{id}', [ProductController::class, 'show']);
        Route::post('products', [ProductController::class, 'store']);
        Route::post('products/{id}', [ProductController::class, 'update']);
        Route::delete('products/{id}', [ProductController::class, 'destroy']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/paginate', [OrderController::class, 'paginate']);
        Route::get('orders/{id}', [OrderController::class, 'show']);
        Route::post('orders', [OrderController::class, 'store']);
        Route::post('orders/{id}', [OrderController::class, 'update']);
        Route::delete('orders/{id}', [OrderController::class, 'destroy']);

        Route::get('users', [UserController::class, 'index']);
        Route::get('users/paginate', [UserController::class, 'paginate']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::post('users', [UserController::class, 'store']);
        Route::post('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);

    });
