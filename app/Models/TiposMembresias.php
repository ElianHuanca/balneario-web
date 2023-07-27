<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposMembresias extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tiposMembresias';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'duracion'
    ];
}
