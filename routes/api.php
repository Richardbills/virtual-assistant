<?php

use App\Http\Controllers\AssessmentController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/assess-query', [AssessmentController::class, 'assessQuery'])->name('assessQuery');
Route::get('/v1/fetch-common-symptoms', [AssessmentController::class, 'fetchCommonSymptoms'])->name('commonSymptomsQuery');
Route::get('/v1/fetch-streamline-symptoms', [AssessmentController::class, 'fetchStreamlineSymptoms'])->name('streamlineSymptomsQuery');
Route::get('/v1/fetch-result-symptoms', [AssessmentController::class, 'fetchResultSymptoms'])->name('resultSymptomsQuery');
