<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarTracking extends Model
{
    protected $fillable = [
        'rent_id', 'car_id', 'latitude', 'longitude'
    ];

    protected $visible = [
        'latitude', 'longitude'
    ];

    public function rent()
    {
        return $this->belongsTo('App\Models\Rent');
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }
}
