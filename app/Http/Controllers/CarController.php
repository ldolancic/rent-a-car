<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;

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

    public function update(Request $request, Car $car)
    {
        $car->update($request->all());

        $car->photoUpload($request, 'cover_photo');

        return redirect('/car/' . $car->id);
    }

    public function store(CarRequest $request)
    {
        $car = Car::create($request->all());

        $car->photoUpload($request, 'cover_photo');

        return redirect('/car/' . $car->id);
    }

    public function uploadPhoto(Request $request, Car $car)
    {
        $photo = $car->photoUpload($request, 'additional_photo');

        return [
            'photo_id' => $photo->id,
            'photo_name' => $photo->name
        ];
    }

    public function deletePhoto(CarPhoto $carPhoto)
    {
        $carId = $carPhoto->car->id;

        $carPhoto->delete();

        return redirect('/car/'. $carId);
    }
}
