<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\UserController;
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

Route::prefix('v1')->namespace('api\v1')->group(function (){
        Route::post('signup',[UserController::class,'RegisterUser']);
        Route::post('login',[UserController::class,'LoginUser']);
        Route::post('logout',[UserController::class,'LogoutUser']);
        Route::post('check-token',[UserController::class,'CheckToken']);

});
