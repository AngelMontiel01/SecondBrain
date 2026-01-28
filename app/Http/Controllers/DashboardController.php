<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function data()
    {
        $data = DB::select('EXEC DASH_Worklog_Hoy');

        //Regresar un objeto aun que no haya registro

        return response()->json($data[0] ?? [
            'minutosHoy' => 0,
            'totalRegistros' => 0,
            'totalAutomatizados' => 0,
            'porcentajeAuto' => 0
        ]);
    }
    public function moodVsWork()
    {
        $data = DB::select('EXEC DASH_Mood_vs_Work');
        return response()->json($data);
    }

}
