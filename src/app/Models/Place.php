<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {
    protected $table = 'lareja_web_place';
    public $timestamps = false; // As requested: No timestamp fields
    protected $fillable = ['name', 'capacity'];
}
