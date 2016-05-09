<?php

namespace App\Http\Controllers;

use App\Models\CarTracking;
use App\Models\Rent;
use Illuminate\Http\Request;
use App\Models\Car;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function create(Car $car)
    {
        return view('rent.create', compact('car'));
    }

    public function store(Car $car, Request $request)
    {
        $rent = new Rent($request->all());

        $rent->car()->associate($car);
        $rent->user()->associate(Auth::user());

        $rent->calculatePrice($car->price_per_day);

        // do advanced validation to check if the car has another
        // rent for our wanted date range
        if (!$rent->validateAvailability()) {
            dd('There is another rent for this car in the wanted date range.');
        }

        // if validation passed save the rent
        $rent->save();

        return redirect('/cars');
    }

    public function carTracking(Rent $rent)
    {
        $trackings = CarTracking::where('rent_id', $rent->id)->get();

        return $trackings->toArray();

        return view('rent.carTracking', compact('trackings'));
    }
}
