<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'lareja_web_visitantes';
    
    protected $fillable = [
        'fecha',
        'nombre',
        'apellido',
        'email',
        'teléfono',
    ];
}
