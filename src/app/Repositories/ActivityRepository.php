<?php
namespace App\Repositories;
use App\Models\Activity;
use App\Models\Files;
use Illuminate\Database\UniqueConstraintViolationException;

class ActivityRepository extends BaseRepository {
    public function __construct(Activity $model, Files $filesModel) {
        $this->model = $model;
        $this->files = $filesModel;
    }

    public function update($id, array $data) {
        $file = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $original_name = $_FILES['image']['name'];
            $extension = collect(explode('.', $original_name))->last();
            $newFileName = "activity-$id.$extension";
            $newFilePath = "files/$newFileName";
            copy($_FILES['image']['tmp_name'], $newFilePath);
            try {
                $file = $this->files->create([
                    'filename'    => $newFileName,
                    'mimetype'    => $_FILES['image']['type'],
                    'path'        => $newFilePath,
                ]);
            }
            catch(UniqueConstraintViolationException $e) {
            }
        }

        if ($file) {
            $data['file_id'] = $file->id;
        }
        $record = $this->find($id);
        $record->update($data);
        $record->save();
        return $record;
    }

    public function create(array $data) {

        $activity = $this->model->create($data);
        $file = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $original_name = $_FILES['image']['name'];
            $extension = collect(explode('.', $original_name))->last();
            $newFileName = "activity-{$activity->id}.$extension";
            $newFilePath = "files/$newFileName";
            copy($_FILES['image']['tmp_name'], $newFilePath);
            try {
                $file = $this->files->create([
                    'filename'    => $newFileName,
                    'mimetype'    => $_FILES['image']['type'],
                    'path'        => $newFilePath,
                ]);
            }
            catch(UniqueConstraintViolationException $e) {
            }

        }

        if ($file) {
            $activity->file_id = $file->id;
            $activity->save();
        }
        return $activity;
    }

    public function find($id) {
        return $this->model->query()->with('image')->findOrFail($id);
    }
}
