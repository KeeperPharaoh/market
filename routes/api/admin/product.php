<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ProductController;
/*
|--------------------------------------------------------------------------
| Routes for Products
|--------------------------------------------------------------------------
|
| These routes were generated for group Product
| All of them have prefix /api/v1/Products
|
*/

Route::get('products', [ProductController::class, 'index']);
Route::get('products/paginate', [ProductController::class, 'paginate']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::post('products', [ProductController::class, 'store']);
Route::post('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);
