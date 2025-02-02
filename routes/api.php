<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\RecordController;

Route::middleware('jwt:auth')->get('/user', function (Request $request) {
    return response()->json($request->user());  // This will return the authenticated user data
});

Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']); // No authentication middleware here

Route::middleware(['jwt.auth'])->group(function () {
    // All routes inside this group will require JWT authentication
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::get('profile', [UserController::class, 'me']);
    Route::post('logout', [UserController::class, 'logout']);
    // Add any other routes that need authentication here
});

Route::get('show', [RecordController::class, 'index']);
Route::post('create', [RecordController::class, 'store']);
Route::put('/update/{record}', [RecordController::class, 'put']);
Route::patch('/update/{record}', [RecordController::class, 'patch']);
Route::delete('delete/{id}', [RecordController::class, 'destroy']);