<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = "persona";


    protected $fillable = [
        'nombre',
        'ci',
        'fecha_nac',
        'genero',
        'telefono',
    ];

    static public $default = [
        'nombre',
        'ci',
        'fecha_nac',
        'genero',
        'telefono',
    ];
    static public $atributos = [
        'nombre',
        'ci',
        'fecha_nac',
        'genero',
        'telefono',
        'created_at',
    ];
    static public $interface = [
        'nombre',
        'ci',
        'fecha_nac',
        'genero',
        'telefono',
        'created_at',
    ];
}
