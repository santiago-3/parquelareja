<?php

namespace App\Repositories;

use App\Models\Guest;

class GuestRepository extends BaseRepository
{
    public function __construct(Guest $model)
    {
        $this->model = $model;
    }
}
