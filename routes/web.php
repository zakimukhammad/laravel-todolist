<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home']);

Route::view('/template', 'template');

Route::controller(\App\Http\Controllers\UserController::class)->group(function() {
    Route::get('/login', 'login')->name('login')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/login', 'doLogin')->name('doLogin')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/logout', 'doLogout')->name('doLogout')->middleware([OnlyMemberMiddleware::class]);
});
