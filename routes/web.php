<?php

use App\Http\Controllers\client\CertificatePaymentOrderController;
use App\Http\Controllers\client\CertificateStudyController;
use App\Http\Controllers\client\CertificateСharacteristicController;
use App\Http\Controllers\client\GoogleLoginController;
use App\Http\Controllers\client\IndexController;
use App\Http\Controllers\panel\PanelAuthController;
use App\Http\Controllers\panel\PanelRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'home'])->name('page.home');
Route::get('/login', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/logout', [GoogleLoginController::class, 'logout'])->name('google.logout');
Route::get('/panel/login', [PanelAuthController::class, 'login'])->name('panel.login');
Route::get('/panel/logout', [PanelAuthController::class, 'logout'])->name('panel.logout');
Route::post('/panel/login', [PanelAuthController::class, 'auth'])->name('panel.auth');


Route::middleware(['auth:student'])->prefix('certificate')->group(function() {
    Route::get('study', [CertificateStudyController::class, 'study'])->name('certificate.study');
    Route::post('study', [CertificateStudyController::class, 'store'])->name('post.certificate.study');
    Route::get('characteristic', [CertificateСharacteristicController::class, 'characteristic'])->name('certificate.characteristic');
    Route::post('characteristic', [CertificateСharacteristicController::class, 'store'])->name('post.certificate.characteristic');
    Route::get('payment-order', [CertificatePaymentOrderController::class, 'paymentOrder'])->name('certificate.paymentOrder');
    Route::post('payment-order', [CertificatePaymentOrderController::class, 'store'])->name('post.certificate.paymentOrder');
});

Route::middleware(['auth:web'])->prefix('panel')->group(function() {
    Route::get('/', [PanelRequestController::class, 'index'])->name('panel.index');
});