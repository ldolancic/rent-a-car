<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarPhoto extends Model
{
    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }
}
