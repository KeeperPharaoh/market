<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\FavoriteController;

/*
|--------------------------------------------------------------------------
| Routes for Api
|--------------------------------------------------------------------------
|
| These routes were generated for group Api
| All of them have prefix /api/v1
|
*/

Route::prefix('auth')
    ->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::get('logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum');
    });
//Пользователь
Route::prefix('user')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('', [UserController::class, 'getAuthUser']);
        Route::put('', [UserController::class, 'updateAuthUser']);
        Route::post('change-password', [UserController::class, 'changePassword']);
        Route::get('history', [UserController::class, 'history']);
    });
//Категории и продукты
Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'categories']);
    Route::get('{id}/subcategories',[CategoryController::class, 'subcategories']);
});

Route::get('category/{id}', [ProductController::class, 'productsByCategory']);
Route::get('product/{id}', [ProductController::class, 'showProductWithAnalogs']);
Route::get('product', [ProductController::class, 'products']);

//Избранное
Route::prefix('favorite')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('', [FavoriteController::class, 'show']);
        Route::post('/{id}', [FavoriteController::class, 'add']);
        Route::delete('/{id}', [FavoriteController::class, 'delete']);
    });

//Показать корзину
Route::get('cart', [ProductController::class, 'getCart']);
//Получить офисы самовывоза
Route::get('/pickup-offices', [OrderController::class, 'pickupOffices']);

//Сделать заказ
Route::post('/order', [OrderController::class, 'create']);

Route::get('/test',[OrderController::class, 'test']);
