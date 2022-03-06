<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\AuthController;

Route::prefix('auth')
    ->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::get('logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum');
    });


Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'categories']);
    Route::get('{id}/subcategories',[CategoryController::class, 'subcategories']);
});

Route::get('category/{id}', [ProductController::class, 'productsByCategory']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::get('product', [ProductController::class, 'products']);
