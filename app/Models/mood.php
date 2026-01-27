<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mood extends Model
{
    use HasFactory;

    protected $table = 'Mood';

    protected $primaryKey = 'idMood';

    public $timestamps = false;

    protected $fillable = [
        'energia',
        'animo',
        'nota'
    ];
}
