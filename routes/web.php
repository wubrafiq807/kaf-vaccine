<?php

use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\VaccineController::class, 'index']);
Route::resource('vaccine', VaccineController::class)
    ->only('index','create','store');
Route::post('/', [App\Http\Controllers\VaccineController::class, 'search']);

