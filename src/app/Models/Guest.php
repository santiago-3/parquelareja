<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'lareja_web_visitantes';
    
    protected $fillable = [
        'name',
        'last_name',
        'category',
        'state_id',
        'reservation_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
