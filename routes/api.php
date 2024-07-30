<?php

use App\Services\SmsGatewayServices\SmsGatewayService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\OrderHeaderController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;


############################### AUTH ###############################
Route::post('/auth/verify', [AuthController::class, 'verifyUser']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);


############################### service ###############################
Route::prefix('services')->group(function () {
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/{id}', [ServiceController::class, 'show']);
    Route::put('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'destroy']);
});
############################### category ###############################
Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
############################### article ###############################
Route::prefix('articles')->group(function () {
    Route::post('/', [ArticleController::class, 'store']);
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::put('/{id}', [ArticleController::class, 'update']);
    Route::delete('/{id}', [ArticleController::class, 'destroy']);
});
############################### order header ###############################
Route::prefix('order-headers')->group(function () {
    Route::post('/', [OrderHeaderController::class, 'store']);
    Route::get('/', [OrderHeaderController::class, 'index']);
    Route::get('/{id}', [OrderHeaderController::class, 'show']);
    Route::put('/{id}', [OrderHeaderController::class, 'update']);
    Route::delete('/{id}', [OrderHeaderController::class, 'destroy']);
});
############################### order line ###############################
Route::prefix('order-lines')->group(function () {
    Route::post('/', [OrderLineController::class, 'store']);
    Route::get('/', [OrderLineController::class, 'index']);
    Route::get('/{id}', [OrderLineController::class, 'show']);
    Route::put('/{id}', [OrderLineController::class, 'update']);
    Route::delete('/{id}', [OrderLineController::class, 'destroy']);
});
############################### unit ###############################
Route::prefix('units')->group(function () {
    Route::post('/', [UnitController::class, 'store']);
    Route::get('/', [UnitController::class, 'index']);
    Route::get('/{id}', [UnitController::class, 'show']);
    Route::put('/{id}', [UnitController::class, 'update']);
    Route::delete('/{id}', [UnitController::class, 'destroy']);
});
############################### preference ###############################
Route::prefix('preferences')->group(function () {
    Route::post('/', [PreferenceController::class, 'store']);
    Route::get('/', [PreferenceController::class, 'index']);
    Route::get('/{id}', [PreferenceController::class, 'show']);
    Route::put('/{id}', [PreferenceController::class, 'update']);
    Route::delete('/{id}', [PreferenceController::class, 'destroy']);
});

Route::get('/test', function () {
    $smsGatewayService = new SmsGatewayService();
    $smsGatewayService->sendOtp('95627977', 123456);
    return response()->json(['message' => 'Welcome to the API']);
});
############################### slider ###############################
Route::prefix('sliders')->group(function () {
    Route::post('/', [SliderController::class, 'store']);
    Route::get('/', [SliderController::class, 'index']);
    Route::get('/{id}', [SliderController::class, 'show']);
    Route::put('/{id}', [SliderController::class, 'update']);
    Route::delete('/{id}', [SliderController::class, 'destroy']);
});
############################### version ###############################
Route::prefix('versions')->group(function () {
    Route::post('/', [VersionController::class, 'store']);
    Route::get('/', [VersionController::class, 'index']);
    Route::get('/{id}', [VersionController::class, 'show']);
    Route::put('/{id}', [VersionController::class, 'update']);
    Route::delete('/{id}', [VersionController::class, 'destroy']);
});
