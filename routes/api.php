<?php

use App\Http\Controllers\Api\V1\IndexController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('v1/login', [UserController::class, 'login']);
Route::post('v1/register', [UserController::class, 'register']);
Route::get('v1/register', [UserController::class, 'getregister']);
Route::post('v1/token', [UserController::class, 'token']);
Route::post('v1/remember', [UserController::class, 'remember']);
Route::get('v1/latest_version', [IndexController::class, 'version']);
Route::get('v1/getstate', [IndexController::class, 'getState']);
Route::post('v1/getcity', [IndexController::class, 'getCity']);
// Legacy API routes removed for CVC scope.


Route::middleware('auth:api')->group(function () {
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update', [UserController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
