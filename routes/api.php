<?php

use App\Http\Controllers\AssistantController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/assess-query', [AssistantController::class, 'assessQuery'])->name('assessQuery');
