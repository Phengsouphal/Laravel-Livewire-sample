<?php

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PlantsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WelcomeInfoController;
use App\Models\WelcomeInfo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('getWelComeInfo', [WelcomeInfoController::class, 'index']);

Route::get('addWelComInfo', function () {
    WelcomeInfo::create([
        'title' => 'Test 2',
        'description' => 'Test 2',
        'thumbnail' => 'Test 2',
    ]);
    // Uses Auth Middleware
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('getSpecialOffers', [PlantsController::class, 'getSpecialOffers']);

    Route::get('getPlantList', [PlantsController::class, 'index']);
    Route::post('getTransactionList', [TransactionController::class, 'getTransactionList']);
    //add more Routes here

    Route::post('getNotificationList', [NotificationController::class, 'getNotificationList']);
});
