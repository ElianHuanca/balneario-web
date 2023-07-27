<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "permiso2";
    protected $fillable = [
        "id_user",
        "id_rol",
        "usuario",
        "fecha_inicio",
        "fecha_fin",
        "estado"
    ];
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    
    public function primaryKey()
    {
        return ['id_user', 'id_rol'];
    }
}
