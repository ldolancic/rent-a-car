<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Rent extends Model
{
    protected $fillable = [
        'starting_time', 'ending_time'
    ];

    protected $dates = [
        'starting_time', 'ending_time'
    ];

    public function car()
    {
        return $this->belongsTo('App\Models\Car');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function carTrackings()
    {
        return $this->hasMany('App\Models\CarTracking');
    }

    public function setStartingTimeAttribute($date)
    {
        $this->attributes['starting_time'] = Carbon::parse($date);
    }

    public function setEndingTimeAttribute($date)
    {
        $this->attributes['ending_time'] = Carbon::parse($date);
    }

    public function calculatePrice($pricePerDay)
    {
        $this->price = ($this->starting_time->diffInDays($this->ending_time) + 1) * $pricePerDay;
    }

    public function validateAvailability()
    {
        // checks if there are any rents taking place
        // in our needed period for this particular car
        $data = self::where(function ($query) {

                $query->whereBetween('starting_time', array($this->starting_time, $this->ending_time))
                ->orWhere(function ($query) {
                    $query->whereBetween('ending_time', array($this->starting_time, $this->ending_time));
                });

            })
            ->where('car_id', $this->car->id)
            ->get();

        // if there are no rents validation passes
        if ($data->isEmpty()) {
            return true;
        }

        // otherwise validation does not pass
        return false;
    }
}
