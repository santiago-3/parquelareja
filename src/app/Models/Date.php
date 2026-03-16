<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Date extends Model {
    protected $table = 'lareja_web_date';
    protected $fillable = ['date', 'caretakers'];
    // Timestamps are true by default in Laravel
}
