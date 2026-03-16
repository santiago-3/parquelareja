<?php
namespace App\Repositories;
use App\Models\Place;

class PlaceRepository extends BaseRepository {
    public function __construct(Place $model) {
        $this->model = $model;
    }
}
