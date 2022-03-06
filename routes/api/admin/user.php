<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
/*
|--------------------------------------------------------------------------
| Routes for Users
|--------------------------------------------------------------------------
|
| These routes were generated for group User
| All of them have prefix /api/v1/Users
|
*/

Route::get('users', [UserController::class, 'index']);
Route::get('users/paginate', [UserController::class, 'paginate']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
