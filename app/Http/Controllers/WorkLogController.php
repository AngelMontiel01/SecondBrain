<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkLog;
use Illuminate\Support\Facades\DB;

class WorkLogController extends Controller
{
    public function index()
    {
        $logs = WorkLog::all();
        return response()->json($logs);
    }

    public function insertar(Request $request)
    {
        $result = DB::select('
            DECLARE @EXITO BIT;
                Exec INSWORK ?, ?, ?, ?, ?,
                    @EXITO = @EXITO OUTPUT;
                        SELECT @EXITO AS EXITO;
        ', [
            $request->input('fecha'),
            $request->input('tipoDia'),
            $request->input('actividad'),
            $request->input('automatizacion'),
            $request->input('tiempoReal'),
        ]);

        return response()->json(['Exito' => $result[0]->EXITO]);
    }

    public function getid($id)
    {
        $data = DB::select(
            'EXEC dbo.SELWORKBYID ?',
            [$id]
        );

        if (count($data) === 0) {
            return response()->json([]);
        }

        return response()->json([
            'idWork' => $data[0]->idWork,
            'fecha' => $data[0]->fecha,
            'tipoDia' => $data[0]->tipoDia,
            'actividad' => $data[0]->actividad,
            'automatizacion' => $data[0]->automatizacion,
            'tiempoReal' => $data[0]->tiempoReal
        ]);
    }

    public function update(Request $request, $id)
    {


        $result = DB::select("
            DECLARE @EXITO BIT;

            EXEC dbo.UPWORK
                ?, ?, ?, ?, ?, ?, @EXITO = @EXITO OUTPUT;

            SELECT @EXITO AS EXITO;
        ", [
            $id,
            $request->fecha,
            $request->tipoDia,
            $request->actividad,
            $request->automatizacion,
            $request->tiempoReal
        ]);

        return response()->json([
            'Exito' => $result[0]->EXITO
        ]);
    }

    public function delete($id)
    {
        $result = DB::select('
            DECLARE @EXITO BIT;
                Exec DELWORK ?, 
                    @EXITO = @EXITO OUTPUT;
                        SELECT @EXITO AS EXITO;
        ', [
            $id
        ]);

        return response()->json(['Exito' => $result[0]->EXITO]);
    }
}
