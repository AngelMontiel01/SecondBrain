<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard/data', [DashboardController::class, 'data']);
Route::get('/dashboard/mood-work', [DashboardController::class, 'moodVsWork']);
Route::get('/dashboard/hobbyImpact', [DashboardController::class, 'hobbieImpact']);

