<?php

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

Route::prefix('custom')->group(function () {
    Route::get('/', function () {
        return view('filament-panels::pages.dashboard');
    });
    Route::get('https://coapi.sajad.uk status', )->name('home');
});
