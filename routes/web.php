<?php

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

Route::any('/', [App\Http\Controllers\LandingPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'manageBids'])->name('home');
Route::get('/manageBids', [App\Http\Controllers\HomeController::class, 'manageBids'])->name('manageBids');
Route::any('/changePin', [App\Http\Controllers\HomeController::class, 'changePin'])->name('changePin');
Route::any('/createBid', [App\Http\Controllers\HomeController::class, 'createBid'])->name('createBid');

