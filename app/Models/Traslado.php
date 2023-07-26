<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    use HasFactory;
    protected $table = "traslado_activo"; // especificar la tabla de tu bd
    protected $fillable = [
        "descripcion",
        "fecha_traslado",
        "id_activo",
        "id_ambiente",
        "id_persona"
    ]; // especificar los campos que tiene tu table
 

}