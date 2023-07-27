<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'reservas';
    protected $fillable = [
        'fecha',
        'turno',
        'idUser',
        'idPago',        
    ];
}
