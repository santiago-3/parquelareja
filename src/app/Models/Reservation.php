<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = 'lareja_web_reservation';

    protected $fillable = [
        'is_keeper', 
        'total_amount', 
        'paid_amount', 
        'workshop_people', 
        'state_id', 
        'responsible_id', 
        'responsible_category', 
        'responsible_category_2', 
        'responsible_category_3'
    ];

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function responsible() {
        return $this->belongsTo(Person::class, 'responsible_id');
    }
}
