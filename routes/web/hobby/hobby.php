<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HobbieController;


//Vista 
Route::get('hobbie', function () {
    return view('hobbie.Hobbie');
});

Route::get('/hobbies/getdata', [HobbieController::class, 'traerDatos']);
Route::post('/hobbies/insertar',[HobbieController::class,'insertar']);
Route::get('/hobbies/get/{id}', [HobbieController::class, 'traerid']);
Route::put('/hobbies/act', [HobbieController::class, 'actualizar']);
Route::delete('/hobbies/eliminar/{id}', [HobbieController::class, 'eliminar']);

