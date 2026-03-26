<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationHost extends Model
{
    protected $table = 'lareja_web_reservation_host';

    protected $fillable = [
        'reservation_id', 
        'person_id', 
        'from', 
        'to', 
        'place_id', 
        'enabled', 
        'hosting', 
        'linens', 
    ];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    public function place() {
        return $this->belongsTo(Places::class);
    }
}
