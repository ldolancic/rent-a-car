<?php

namespace App\Http\Controllers;

use App\Events\CarTrackingAdded;
use App\Models\Car;
use App\Models\CarTracking;
use Illuminate\Http\Request;
use App\Models\Rent;

class CarTrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => [
            'rent'
        ]]);
    }

    public function show(Car $car)
    {
        $tracking = $car->carTrackings()->latest()->first();

        return view('carTracking.currentCarLocation', compact('tracking'));
    }

    public function store(Request $request)
    {
        $tracking = CarTracking::create($request->all());

        event(new CarTrackingAdded($tracking));

        return ['status' => 'success'];
    }

    public function rent(Rent $rent)
    {
        $trackings = CarTracking::where('rent_id', $rent->id)->get();

        return view('carTracking.index', compact('trackings'));
    }
}
