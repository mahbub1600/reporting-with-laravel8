<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/home', [UserController::class, 'welcome'])->name('home');
#Route::get('/', [UserController::class, 'welcome']);
Route::get('/load', [UserController::class, 'load'])->name('load');
Route::get('/show1', [UserController::class, 'show1'])->name('show1');
Route::get('/show2', [UserController::class, 'show2'])->name('show2');
Route::get('/show3', [UserController::class, 'show3'])->name('show3');
Route::get('/show4', [UserController::class, 'show4'])->name('show4');
Route::get('/show5', [UserController::class, 'show5'])->name('show5');
Route::get('/show6', [UserController::class, 'show6'])->name('show6');
Route::get('/show7', [UserController::class, 'show7'])->name('show7');
