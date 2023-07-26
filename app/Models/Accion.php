<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;
    protected $table = "accion2";
    protected $fillable = [
        "id_modulo",
        "id",
        "nombre",
        "param",
        "descripcion",
        "estado"
    ];
}