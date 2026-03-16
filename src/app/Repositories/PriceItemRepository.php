<?php

namespace App\Repositories;

use App\Models\PriceItem;

class PriceItemRepository extends BaseRepository
{
    public function __construct(PriceItem $model)
    {
        $this->model = $model;
    }
}
