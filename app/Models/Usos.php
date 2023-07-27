<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'usos';
    protected $fillable = [
        'fecha',
        'cantidad',
        'idproducto',
        'idambiente'
    ];
}
