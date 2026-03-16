<?php

namespace App\Repositories;

use App\Models\ReservationExtra;

class ReservationExtraRepository extends BaseRepository
{
    public function __construct(ReservationExtra $model)
    {
        $this->model = $model;
    }
}
