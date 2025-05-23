<?php

use App\Http\Controllers\QrController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ExampleComponent;
use App\Livewire\Cart;
//use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu-order', function () {
    return view('manu-order');
});

//Route::post('/print-order', [OrderController::class, 'printOrder'])->name('print.order');

Route::get('/scan-qr', [QrController::class, 'scanQr'])->name('qr.scan');
Route::get('/qr-expired', [QrController::class, 'expired'])->name('qr.expired');

Route::get('/category-articles', \App\Livewire\CategoryArticles::class)
    ->middleware('check.qr.session')
    ->name('category.articles');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register/success', [RegisterController::class, 'showSuccess'])->name('register.success');


Route::get('/license-expired', function () {
    return view('license-expired');
})->name('license.expired');
