<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    public function __construct(Reservation $model)
    {
        $this->model = $model;
    }
}
