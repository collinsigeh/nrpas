<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'regPost'])->name('register.post')->middleware('guest');
Route::get('/account_confirmation/{confirmation_code}', [AuthController::class, 'confirmReg'])->name('register.confirmation')->middleware('guest');

Route::get('/web/{case}', [AuthController::class, 'webReply'])->name('web.reply');

Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('password.forget')->middleware('guest');
Route::post('/recover_password', [AuthController::class, 'recoverPassword'])->name('password.recover')->middleware('guest');
Route::get('/reset_password/{confirmation_code}', [AuthController::class, 'resetPassword'])->name('password.reset')->middleware('guest');
Route::post('/reset_password', [AuthController::class, 'resetPasswordPost'])->name('password.reset.post')->middleware('guest');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post')->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');