<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RpasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/web/{case}', [AuthController::class, 'webReply'])->name('web.reply');

Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'regPost'])->name('register.post');
    Route::get('/account_confirmation/{confirmation_code}', [AuthController::class, 'confirmReg'])->name('register.confirmation');


    Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('password.forget');
    Route::post('/recover_password', [AuthController::class, 'recoverPassword'])->name('password.recover');
    Route::get('/reset_password/{confirmation_code}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset_password', [AuthController::class, 'resetPasswordPost'])->name('password.reset.post');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile_completion', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile_completion', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('/profile_type/{type}', [ProfileController::class, 'accountTypePost'])->name('profile.type.store');
    Route::get('/profile_type', [ProfileController::class, 'accountTypeSelection'])->name('profile.type');

    Route::get('/safety_agreement', [RpasController::class, 'safetyAgreement'])->name('rpas.safety');
});