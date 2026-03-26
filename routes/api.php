<?php
namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

//since this is in api.php and registered in /bootstrap/app.php, all routes in here will have '/api/v1/[xyz]' endpoint
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    //only authenticated users can call logout endpoint
    Route::middleware('auth.api')->group(function(){
        //routes inside here are all protected by Middleware/AuthenticateApi.php (to create middleware 'php artisan make:middleware [middleware name]')
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
