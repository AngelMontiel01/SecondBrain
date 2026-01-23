<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    protected $table = 'Hobby_Tracker';

    protected $primaryKey = 'idHobby';

    public $timestamps = false;

    protected $fillable = [
        'nombreJuego',
        'tipo',
        'sesion(Minutos)',
        'nota'
    ];
}
