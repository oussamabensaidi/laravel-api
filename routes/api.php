<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:api')->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/{id}', [TaskController::class, 'show']);
    Route::post('/', [TaskController::class, 'store']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy']);
});