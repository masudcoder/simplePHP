<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    Mail::raw('This is a test email from production.', function ($message) {
        $message->to('enggmasud1983@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
});

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
Route::any('/submitBid', [App\Http\Controllers\LandingPageController::class, 'submitBid'])->name('submitBid');
Route::any('/testMail', [App\Http\Controllers\LandingPageController::class, 'testMail']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'manageBids'])->name('home');
Route::get('/manageBids', [App\Http\Controllers\HomeController::class, 'manageBids'])->name('manageBids');
Route::get('/bid/edit/{id}', [App\Http\Controllers\HomeController::class, 'editBidForm'])->name('manageBids');
Route::get('/bid/details/{id}', [App\Http\Controllers\HomeController::class, 'details'])->name('manageBids');
Route::post('/bid/updateBid', [App\Http\Controllers\HomeController::class, 'updateBid'])->name('updateBid');
Route::post('/bid/delete', [App\Http\Controllers\HomeController::class, 'deleteBid'])->name('updateBid');

Route::any('/changePin', [App\Http\Controllers\HomeController::class, 'changePin'])->name('changePin');
Route::any('/createBid', [App\Http\Controllers\HomeController::class, 'createBid'])->name('createBid');

