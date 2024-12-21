<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Logout route
    Route::post('/auth/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    
    Route::get('/iban', [\App\Http\Controllers\Api\IbanController::class, 'index']);
    Route::get('/iban/{iban}', [\App\Http\Controllers\Api\IbanController::class, 'show']);
    Route::delete('/iban/{iban}', [\App\Http\Controllers\Api\IbanController::class, 'destroy']);
    Route::put('/iban/{iban}', [\App\Http\Controllers\Api\IbanController::class, 'update']);
    Route::post('/iban', [\App\Http\Controllers\Api\IbanController::class, 'store']);
});
