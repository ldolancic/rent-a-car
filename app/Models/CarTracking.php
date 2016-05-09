<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarTracking extends Model
{
    public function rent()
    {
        return $this->belongsTo('App\Models\Rent');
    }
}
