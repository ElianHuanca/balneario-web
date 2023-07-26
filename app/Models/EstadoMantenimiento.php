<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoMantenimiento extends Model
{
    use HasFactory;
    protected $table = 'estado_mantenimiento';
    protected $fillable = [
        'id',
        'nombre',
    ];
}
