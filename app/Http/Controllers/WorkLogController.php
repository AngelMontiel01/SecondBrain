<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkLog;

class WorkLogController extends Controller
{
    public function index()
    {
        $logs = WorkLog::all(); 
        return response()->json($logs);
    }
}
