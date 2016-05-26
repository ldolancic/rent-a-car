<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return view('car.index');
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

    public function update(CarRequest $request, Car $car)
    {
        $car->update($request->all());

        return redirect('/car/' . $car->id . '/edit-cover-photo');
    }

    public function store(CarRequest $request)
    {
        $car = Car::create($request->all());

        return redirect('/car/' . $car->id . '/edit-cover-photo');
    }

    public function editCoverPhoto(Car $car)
    {
        return view('car.editCoverPhoto', compact('car'));
    }

    public function storeCoverPhoto(Request $request, Car $car)
    {
        $car->processImageUpload($request, true);

        return redirect('/car/' . $car->id);
    }

    public function uploadImage(Request $request, Car $car)
    {
        $car->processImageUpload($request, false);

        return 'success';
    }

}
