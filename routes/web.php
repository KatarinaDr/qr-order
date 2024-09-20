<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ExampleComponent;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu-order', function () {
    return view('manu-order');
});

Route::post('/print-order', [OrderController::class, 'printOrder'])->name('print.order');

