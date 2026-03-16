<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationExtra extends Model
{
    protected $table = 'lareja_web_reservation_extra';

    protected $fillable = [
        'place_id',
        'reservation_id',
        'date_from',
        'date_to',
        'people_number',
        'details',
        'responsible_id',
        'oven',
        'workshop_categories',
        'multipurpose_checked'
    ];

    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    public function place() {
        return $this->belongsTo(Place::class);
    }

    public function responsible() {
        return $this->belongsTo(Person::class, 'responsible_id');
    }
}
