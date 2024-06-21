<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RpasController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/learn_more', [PageController::class, 'learn_more'])->name('page.learn_more');
Route::get('/help', [PageController::class, 'help'])->name('page.help');
Route::get('/update_migrate_profile_data', [AuthController::class, 'updateMPData'])->name('mpdata.update');

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
    
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'profilePost'])->name('profile.update');

    Route::get('/safety_agreement', [RpasController::class, 'safetyAgreement'])->name('rpas.safety');
    Route::post('/safety_agreement', [RpasController::class, 'safetyAgreementPost'])->name('rpas.safety.post');
    Route::get('/add_rpas', [RpasController::class, 'create'])->name('rpas.create');
    Route::post('/add_rpas', [RpasController::class, 'store'])->name('rpas.store');
    Route::get('registered_rpas', [RpasController::class, 'index'])->name('rpas.index');
    Route::get('certificate/{id}', [RpasController::class, 'certificate'])->name('rpas.certificate');

    Route::resource('/packages', PackageController::class);
    Route::get('/subscriptions/{id}/make_payment', [OrderController::class, 'make_payment'])->name('subscriptions.make_payment');
    Route::get('/subscriptions', [OrderController::class, 'my_subscriptions'])->name('subscriptions.index');
    Route::resource('/orders', OrderController::class);

    Route::patch('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
});