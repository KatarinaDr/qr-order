<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ExampleComponent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu-order', function () {
    return view('manu-order');
});
