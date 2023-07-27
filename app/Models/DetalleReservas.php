<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleReservas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detalle_reservas';
    protected $fillable = [
        'idReserva',
        'idAmbiente'
    ];
}
