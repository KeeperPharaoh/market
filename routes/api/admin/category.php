<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CategoryController;
/*
|--------------------------------------------------------------------------
| Routes for Categories
|--------------------------------------------------------------------------
|
| These routes were generated for group Category
| All of them have prefix /api/v1/Categories
|
*/

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/paginate', [CategoryController::class, 'paginate']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class, 'store']);
Route::post('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
