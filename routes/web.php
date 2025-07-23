<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QrController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu-order', function () {
    return view('manu-order');
});

//Route::post('/print-order', [OrderController::class, 'printOrder'])->name('print.order');

Route::get('/scan-qr', [QrController::class, 'scanQr'])->name('qr.scan');

Route::get('/category-articles', \App\Livewire\CategoryArticles::class)
    ->name('category.articles');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register/success', [RegisterController::class, 'showSuccess'])->name('register.success');
Route::get('/register/manager', [RegisterController::class, 'showRegistrationForm'])->name('register.manager');
Route::get('/register/waiter', [RegisterController::class, 'registerWaiter'])->name('register.waiter');
Route::post('/register/waiter', [RegisterController::class, 'registerWaiterPost'])->name('register.waiter.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/waiter-manager', function () {
    return view('auth.waiter-manager');
})->name('waiter.manager.select');

Route::get('/license-expired', function () {
    return view('license-expired');
})->name('license.expired');

Route::get('/tables', [\App\Http\Controllers\TablesController::class, 'showTables'])->name('tables');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
