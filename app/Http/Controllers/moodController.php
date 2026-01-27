<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mood;
class moodController extends Controller
{
    public function traerDatos()
    {
        $mood = DB::select('EXEC SELMOOD');
        return response()->json($mood);
    }


    public function insertar(Request $request)
    {
        $result = DB::select('EXEC INSMOOD ?,?,?,?', [
            $request->input('energia'),
            $request->input('animo'),
            $request->input('nota'),
            $request->input('fecha'),

        ]);
        return response()->json(['Exito' => $result[0]->EXITO]);
    }

    public function traerid($id)
    {
        $result = DB::select('Exec SELMOODID ?', [$id]);
        if (count($result) === 0) {
            return response()->json([]);
        }
        return response()->json([
            'idMood' => $result[0]->idMood,
            'energia' => $result[0]->energia,
            'animo' => $result[0]->animo,
            'nota' => $result[0]->nota,
            'fecha' => $result[0]->fecha,

        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $result = DB::select("EXEC UPMOOD ?, ?, ?, ?, ?", [
            $id,
            $request->energia,
            $request->animo,
            $request->nota,
            $request->fecha,

        ]);

        return response()->json([
            'Exito' => $result[0]->EXITO
        ]);
    }

    public function eliminar($id)
    {
        $result = DB::select('Exec DELMOOD ?', [$id]);

        return response()->json(['Exito' => $result[0]->EXITO]);
    }
}
