<?php

use App\Http\Controllers\UserController;
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


Route::prefix('v1/user/')->group(function(){
    Route::post('/', [UserController::class, 'RegisterUser']);
    Route::get('/', [UserController::class, 'LoginUser']);

    Route::middleware('auth:api')->group(function(){
        Route::delete('/', [UserController::class, 'DeleteUser']);
        Route::patch('/', [UserController::class, 'UpdateUserInfo']);
    });
 
});

