<?php
namespace App\Repositories;
use App\Models\Activity;

class ActivityRepository extends BaseRepository {
    public function __construct(Activity $model) {
        $this->model = $model;
    }
}
