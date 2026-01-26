<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Hobbie;
use Illuminate\Support\Facades\DB;

class HobbieController extends Controller
{
    public function traerDatos()
    {
        $hobbies = Hobbie::all();
        return response()->json($hobbies);
    }

    public function insertar(Request $request)
    {
        $result = DB::select('EXEC INSHOBBIE ?,?,?,?', [
            $request->input('nombreJuego'),
            $request->input('tipo'),
            $request->input('sesionMinutos'),
            $request->input('nota'),

        ]);

        return response()->json(['Exito' => $result[0]->EXITO]);
    }

    public function traerid($id)
    {
        $result = DB::select('Exec SELHOBBIEID ?', [$id]);

        if (count($result) === 0) {
            return response()->json([]);
        }

        return response()->json([
            'idHobby' => $result[0]->idHobby,
            'nombreJuego' => $result[0]->nombreJuego,
            'tipo' => $result[0]->tipo,
            'sesionMinutos' => $result[0]->sesionMinutos,
            'nota' => $result[0]->nota,
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $result = DB::select("
            EXEC UPHOBBIE ?, ?, ?, ?,?", [
            $id,
            $request->nombreJuego,
            $request->tipo,
            $request->sesionMinutos,
            $request->nota,
        ]);

        return response()->json([
            'Exito' => $result[0]->EXITO
        ]);
    }

    public function eliminar($id)
    {
        $result = DB::select('Exec DELHOBBIE ?', [$id]);

        return response()->json(['Exito' => $result[0]->EXITO]);
    }
}
