<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthOTPcontroller;  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailsController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(AuthOTPcontroller::class)->group(function()
{
    Route::get('/otp/login','login')->name('otp.login');
    Route::post('/otp/generate','generate')->name('otp.generate');
    Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification'); 
    Route::post('/otp/otplogin', 'otplogin')->name('otp.loginwithotp'); 
    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.showForm');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/success/{id}', [DetailsController::class, 'showSuccessPage'])->name('success.page');
    Route::get('/payment/choose-method', [PaymentController::class, 'choosePaymentMethod'])->name('payment.chooseMethod');
    Route::post('/payment/mpesa', [PaymentController::class, 'processMpesaPayment'])->name('payment.processMpesa');
    Route::get('/parent-details', [PaymentController::class, 'addParentDetails'])->name('addParentDetails');
    Route::post('/payment/stkcallback', [PaymentController::class, 'stkCallback'])->name('stkcallback');
});
