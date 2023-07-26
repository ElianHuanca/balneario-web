<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavBar extends Model
{
    use HasFactory;
    protected $table = "navbars";
    protected $fillable = [
        "name",
        "route",
        "ordering"
    ];
}

