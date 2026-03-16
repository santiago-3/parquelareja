<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model {
    use SoftDeletes;
    protected $table = 'lareja_web_person';
    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 
        'is_master', 'from_reservation', 'reservation_comments'
    ];
}
