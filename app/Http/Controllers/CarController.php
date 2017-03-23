<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;
use App\Models\CarPhoto;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => [
            'show',
            'search'
        ]]);
    }

    public function index()
    {
        $cars = Car::all();

        return view('car.index', compact('cars'));
    }

    public function create()
    {
        return view('car.create');
    }

    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('car.edit', compact('car'));
    }


    public function rentHistory(Car $car)
    {
        $rents = $car->rents()->with(['car', 'user'])->get();

        return view('car.rentHistory', compact(['rents', 'car']));
    }

    public function search()
    {
        return view('car.search');
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->update($request->all());

        $car->photoUpload($request, 'cover_photo', true);

        $car->pushToIndex();

        return redirect('/car/' . $car->id);
    }

    public function store(CarRequest $request)
    {
        $car = Car::create($request->all());

        $car->photoUpload($request, 'cover_photo', true);

        $car->pushToIndex();

        return redirect('/car/' . $car->id);
    }

    public function uploadPhoto(Request $request, Car $car)
    {
        $car->photoUpload($request, 'photo', false);

        return 'success';
    }

    public function deletePhoto(CarPhoto $carPhoto)
    {
        $carId = $carPhoto->car->id;

        $carPhoto->delete();

        return redirect('/car/'. $carId);
    }

}
