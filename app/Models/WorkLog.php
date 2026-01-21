<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLog extends Model
{
    protected $table = 'Work_Log'; // 👈 nombre EXACTO de tu tabla en SQL Server
    protected $primaryKey = 'idWork';
    public $timestamps = false; // 👈 si tu tabla no tiene created_at / updated_at

    protected $fillable = [
        'fecha',
        'tipoDia',
        'actividad',
        'automatizacion',
        'tiempoReal',
    ];
}
