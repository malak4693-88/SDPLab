<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Staff API Routes
Route::get('/staff', [StaffController::class, 'index']);

Route::post('/staff', [StaffController::class, 'store']);

Route::get('/staff/{id}', [StaffController::class, 'show']);

Route::put('/staff/{id}', [StaffController::class, 'update']);

Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
