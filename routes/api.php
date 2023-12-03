<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AvailableController;
use App\Http\Controllers\API\DevController;
use App\Http\Controllers\API\MainController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/available', [AvailableController::class, 'index']);
Route::post('/check-room', [AvailableController::class, 'checkRoom']);

Route::post('/apply-coupon', [MainController::class, 'applyCoupon']);

// Dev Routes
Route::post('/dev/deployment', [DevController::class, 'deployment']);
