<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\User\ProfileController;

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


Route::group(['middleware' => ['localization']], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login',[UserAuthController::class,'login']);
        Route::post('/signup',[UserAuthController::class,'signup']);
    });


    Route::group(["middleware" => ["auth:api"]], function () {

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/',[ProfileController::class,'index']);
            Route::put('/',[ProfileController::class,'update']);
        });

    });

});
