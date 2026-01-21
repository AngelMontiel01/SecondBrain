<?php

use App\Http\Controllers\WorkLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    require base_path('routes/web/worklog/worklog.php');
    require base_path('routes/web/mood/mood.php');
    require base_path('routes/web/hobby/hobby.php');
});
