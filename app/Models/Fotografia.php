<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{
    use HasFactory;
    protected $table = 'fotografia';
    protected $fillable = [
        'url',
        'fecha',
        'id_tabla',
        'tipo_tabla'
    ];
}
