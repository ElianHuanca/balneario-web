<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
    protected $table = "orden_mantenimiento";
    protected $fillable = [
        "tipo",
        "fecha_solicitud",
        "descripcion",
        "id_activo",
        "id_estado_mantenimiento"
    ];
}
