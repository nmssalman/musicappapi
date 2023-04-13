<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TrackController;
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


Route::prefix('v1/')->group(function(){

    Route::prefix('user/')->group(function(){
        Route::post('/', [UserController::class, 'RegisterUser']);
        Route::get('/', [UserController::class, 'LoginUser']);

        Route::middleware('auth:api')->group(function() {
            Route::delete('/', [UserController::class, 'DeleteUser']);
            Route::patch('/', [UserController::class, 'UpdateUserInfo']);
            Route::get('/get-users', [UserController::class, 'GetAllUsers']);
            Route::get('/is-verified-email',[UserController::class,'IsEmailVerified']);
            Route::get('/is-verified-phone',[UserController::class,'IsPhoneVerified']);
            Route::put('/verify-email',[UserController::class,'VerifyEmail']);
            Route::patch('/verify-phone',[UserController::class,'VerifyPhone']);
            
    
        });
    });
    //main/
    Route::prefix('mail/')->group(function(){
        Route::middleware('auth:api')->group(function(){
            Route::post('/send-verification-code',[MailController::class,'sendVerificationCode']);
        });
    });
    Route::prefix('song/')->group(function(){

        Route::middleware('auth:api')->group(function() {
    
            Route::post('/',[TrackController::class,'createASong']);
            Route::get('/',[TrackController::class,'GetData']);
        
        });
     
    });
    
});

   


 

