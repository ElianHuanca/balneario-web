<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    protected $table = 'ambiente';

    protected $fillable = [
        'nombre',
        'dimension',
        'id_persona',
        'id_ubicacion'
    ];

    static public $default = [
        'nombre',
        'dimension',
    ];
    static public $atributos = [
        'nombre',
        'dimension',
        'created_at',
    ];
    static public $interface = [
        'nombre',
        'dimension',
        'created_at',
    ];
}
