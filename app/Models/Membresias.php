<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'membresias';
    protected $fillable = [
        'fecha_ini',
        'fecha_fin',
        'iduser',
        'idtipomembresia',
        'idpago'
    ];
}
