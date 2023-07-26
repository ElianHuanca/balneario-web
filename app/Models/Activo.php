<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $table = 'activo';
    protected $fillable = [
        'codigo',
        'nombre',
        'vida_util',
        'valor',
        'periodo_mantenimiento',
        'id_ambiente',
        'id_categoria',
        'id_tipo_ingreso',
        'id_estado'
    ];
    static public $default = [
        'codigo',
        'nombre',
        'vida_util',
        'valor',
    ];
    static public $atributos = [
        'codigo',
        'nombre',
        'vida_util',
        'valor',
        'created_at',
    ];
    static public $interface = [
        'codigo',
        'nombre',
        'vida_util',
        'valor',
        'created_at',
    ];



}
