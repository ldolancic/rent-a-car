<?php

namespace App\Http\Controllers;

use App\Models\CarTracking;
use App\Models\Rent;
use Illuminate\Http\Request;
use App\Models\Car;

use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => [
            'carTracking',
            'edit',
            'update'
        ]]);

        $this->middleware('auth', ['only' => [
            'create',
            'store'
        ]]);
    }

    public function show(Rent $rent)
    {
        $this->authorize('rentAccess', $rent);

        return view('rent.show', compact('rent'));
    }

    public function edit(Rent $rent)
    {
        return view('rent.edit', compact('rent'));
    }

    public function create(Car $car)
    {
        return view('rent.create', compact('car'));
    }

    public function store(Car $car, Request $request)
    {
        $data = $request->all();

        foreach ($data as $item => $value) {
            if ($value === "on") {
                $data[$item] = true;
            }
        }

        $rent = new Rent($data);

        $rent->car()->associate($car);
        $rent->user()->associate(Auth::user());

        $rent->calculatePrice($car->price_per_day);

        // manual validation for rent dates
        if (!$rent->dateRangeAvailable()) {
            return response('There is another rent for this car in the wanted date range.', '451');
        }

        $rent->save();

        return redirect('/rent/' . $rent->id);
    }

    public function update(Rent $rent, Request $request)
    {
        $data = $this->processInput($request->all());

        $rent->update($data);
        $rent->status = $data['status'];

        $car = $rent->car;

        $rent->calculatePrice($car->price_per_day);

        // manual validation for rent dates
        if (!$rent->dateRangeAvailable()) {
            return response('There is another rent for this car in the wanted date range.', '451');
        }

        $rent->save();

        return redirect('/rent/' . $rent->id);
    }

    public function showCarTracking(Rent $rent)
    {
        $trackings = CarTracking::where('rent_id', $rent->id)->get();

        return view('carTracking.index', compact('trackings'));
    }

    private function processInput($data)
    {
        $data['additional_driver'] = !isset($data['additional_driver']) ? false : true;
        $data['baby_seat'] = !isset($data['baby_seat']) ? false : true;
        $data['child_seat'] = !isset($data['child_seat']) ? false : true;
        $data['full_protection'] = !isset($data['full_protection']) ? false : true;

        return $data;
    }
}
