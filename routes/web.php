<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'regPost'])->name('register.post');
Route::get('/account_confirmation/{confirmation_code}', [AuthController::class, 'confirmReg'])->name('register.confirmation');

Route::get('/web/{case}', [AuthController::class, 'webReply'])->name('web.reply');

Route::get('/forgot_password', [AuthController::class, 'forgotPassword'])->name('password.forget');
Route::post('/recover_password', [AuthController::class, 'recoverPassword'])->name('password.recover');
Route::get('/reset_password', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset_password', [AuthController::class, 'resetPasswordPost'])->name('password.reset.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');