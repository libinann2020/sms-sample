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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('2fa');
  
Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');


/*-------------------------------------------------------------------------------------------------------*/
use App\Http\Controllers\TwilioSMSController;
Route::get('sendSMS', [TwilioSMSController::class, 'index']);


/*-------------------------------------------------------------------------------------------------------*/
use App\Http\Controllers\SmsController;
Route::get('send-sms', [ SmsController::class, 'index' ])->name('get.sms.form');
Route::post('send-sms', [ SmsController::class, 'sendMessage' ])->name('send.sms');


/*-------------------------------------------------------------------------------------------------------*/
Route::get('/', function () {
    return view('auth_verify.register');
})->name('register');

Route::get('/verify', function () {
    return view('auth_verify.verify');
})->name('verify');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/', [App\Http\Controllers\AuthController::class, 'create'])->name('register');
Route::post('/verify', [App\Http\Controllers\AuthController::class, 'verify'])->name('verify');
