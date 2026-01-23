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
        
    }

    public function traerid($id)
    {
        //
    }

    public function actualizar(Request $request)
    {
        //
    }

    public function eliminar($id)
    {
        //
    }
}
