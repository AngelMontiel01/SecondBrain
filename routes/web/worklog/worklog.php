<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\WorkLogController;


/*|--------------------------------------------------------------------------
| Web Routes --- WorkLog
|----------------------------------------------------------------------------
*/

//vista

Route::get('worklog', function() {
    return view('worklog.index');
});

//datos (json)
Route::get('/worklogs/getdata', [WorkLogController::class, 'index']);
Route::post('/worklogs/insert',[WorkLogController::class,'insertar']);
Route::get('/worklogs/get/{id}', [WorkLogController::class, 'getid']);
Route::put('/worklogs/update/{id}', [WorkLogController::class, 'update']);
Route::delete('/worklogs/delete/{id}', [WorkLogController::class, 'delete']);