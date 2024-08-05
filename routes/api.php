<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\UserDetailController;
use App\Http\Controllers\V1\FileController;
use App\Http\Controllers\V1\ArticleController;
use App\Http\Controllers\V1\TagController;
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
    // UserController
        Route::post('signup',[UserController::class,'RegisterUser']);
        Route::post('login',[UserController::class,'LoginUser']);
        Route::post('logout',[UserController::class,'LogoutUser']);
        Route::post('check-token',[UserController::class,'CheckToken']);
        Route::get('get-user-by-id/{id}',[UserController::class,'GetUserById']);
        Route::delete('delete-user/{userId}',[UserController::class,'DeleteUser']);
        Route::put('update-user/{userId}',[UserController::class,'UpdateUser']);
        Route::put('change-password/{userId}',[UserController::class,'ChangePassword']);
    //UserDetailController
        Route::post('create-user-detail',[UserDetailController::class,'CreateUserDetail']);
        Route::put('update-user-detail/{userId}',[UserDetailController::class,'UpdateUserDetail']);
        Route::get('get-user-detail/{userId}',[UserDetailController::class,'getUserDetail']);
    //FileController
        Route::post('upload-file',[FileController::class,'upload']);
        Route::delete('delete-file/{fileName}',[FileController::class,'deleteFile']);
   //ArticleController
        Route::get('get-articles',[ArticleController::class,'index']);
        Route::post('create-article',[ArticleController::class,'store']);
        Route::get('get-article/{articleId}',[ArticleController::class,'show']);
        Route::put('update-article/{articleId}',[ArticleController::class,'update']);
        Route::delete('delete-article/{articleId}',[ArticleController::class,'destroy']);
  //TagController
        Route::get('get-tags',[TagController::class,'index']);
        Route::post('create-tag',[TagController::class,'store']);
        Route::get('get-tag/{tagId}',[TagController::class,'show']);
        Route::put('update-tag/{tagId}',[TagController::class,'update']);
        Route::delete('delete-tag/{tagId}',[TagController::class,'destroy']);


});

