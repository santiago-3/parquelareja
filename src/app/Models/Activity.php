<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model {
    use SoftDeletes;
    protected $table = 'lareja_web_activity';
    protected $fillable = ['date', 'name', 'description', 'place_id', 'link'];

    public function place() {
        return $this->belongsTo(Place::class);
    }
}
