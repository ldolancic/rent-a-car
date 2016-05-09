@extends('layouts.main')

@section('content')
    <div class="container">

        <h3>Create a car</h3>

        <div class="row">
        <form class="col-sm-4" method="post" action="{{ route('car.update', ['id' => $car->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Brand name</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand name"
                       required
                       value="{{ $car->brand }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Model name</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model name"
                       required
                       value="{{ $car->model }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Number of seats</label>
                <input type="number" class="form-control" id="seats" name="seats"
                       min="2"
                       max="10"
                       value="{{ $car->seats }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Number of doors</label>
                <input type="number" class="form-control" id="doors" name="doors"
                       min="2"
                       max="7"
                       value="{{ $car->doors }}"
                >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price per hour</label>
                <input type="number" class="form-control" id="price_per_day" name="price_per_day"
                       min="1.0"
                       step="0.1"
                       value="{{ $car->price_per_day }}"
                >
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>

    </div>
@stop