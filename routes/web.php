<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


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
            Route::get('/send-email',[MailController::class,'SendEmail']);
            
    
        });
    });
    Route::prefix('song/')->group(function(){

        Route::middleware('auth:api')->group(function() {
    
            Route::post('/',[TrackController::class,'CreateRecords']);
            Route::get('/',[TrackController::class,'RetrieveData']);
        
        });
     
    });
    
});

// Route::get('/', [UserController::class, 'LoginUser']);

