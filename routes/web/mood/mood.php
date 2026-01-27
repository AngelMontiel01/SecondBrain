<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\moodController;


/*|--------------------------------------------------------------------------
| Web Routes --- mood
|----------------------------------------------------------------------------
*/

//vista

Route::get('mood', function() {
    return view('mood.mood');
});

Route::get('/mood/getdata', [moodController::class, 'traerDatos']);
Route::post('/mood/insertar',[moodController::class,'insertar']);
Route::get('/mood/get/{id}', [moodController::class, 'traerid']);
Route::put('/mood/act/{id}', [moodController::class, 'actualizar']);
Route::delete('/mood/eliminar/{id}', [moodController::class, 'eliminar']);