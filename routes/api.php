<?php

use App\Http\Controllers\Api\Teachers\Session\AuthTeachersController;
use App\Http\Controllers\Api\Users\Session\AuthUserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::post('login', [AuthUserController::class, 'login']);
        Route::post('logout', [AuthUserController::class, 'logout']);
        Route::post('refresh', [AuthUserController::class, 'refresh']);
        Route::post('me', [AuthUserController::class, 'me']);
    });

    Route::group(['prefix' => 'teachers'], function () {
        Route::post('login', [AuthTeachersController::class, 'login']);
        Route::post('logout', [AuthTeachersController::class, 'logout']);
        Route::post('refresh', [AuthTeachersController::class, 'refresh']);
        Route::post('me', [AuthTeachersController::class, 'me']);
    });

});
