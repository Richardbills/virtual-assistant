<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/diagnosis', [HomeController::class, 'diagnosis'])->name('diagnosis');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::post('/feedback', [HomeController::class, 'feedback'])->name('feedback');
