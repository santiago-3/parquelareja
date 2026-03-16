<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'lareja_web_state';
    
    // As requested: No timestamp fields
    public $timestamps = false;

    protected $fillable = ['name'];
}
