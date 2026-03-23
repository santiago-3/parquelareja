<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    public function __construct(Reservation $model)
    {
        $this->model = $model;
    }

    public function last() {
        return $this->model
                    ->orderBy('id', 'desc')
                    ->paginate(15);
    }
}
