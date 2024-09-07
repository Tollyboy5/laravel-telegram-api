<?php

use App\Http\Controllers\TeleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/person', [TeleController::class, 'person']);
Route::post('/store', [TeleController::class, 'store']);
Route::get('/delete/doc/{id}', [TeleController::class, 'destroy']);
