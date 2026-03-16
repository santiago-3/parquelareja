<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceItem extends Model
{
    protected $table = 'lareja_web_price_item';
    
    // As per schema: No timestamps
    public $timestamps = false;

    protected $fillable = [
        'id',
        'denomination',
        'price'
    ];
}
