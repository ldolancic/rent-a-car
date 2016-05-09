@extends('layouts.main')

@section('content')
    <div class="container">

        <h3>Create a car</h3>

        <div class="row">
        <form class="col-sm-4" method="post" action="{{ route('car.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Brand name</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Model name</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Number of seats</label>
                <input type="number" class="form-control" id="seats" name="seats" min="2" max="10" value="5">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Number of doors</label>
                <input type="number" class="form-control" id="doors" name="doors" min="2" max="7" value="5">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price per day</label>
                <input type="number" class="form-control" id="price_per_day" name="price_per_day" min="1.0" step="0.1"
                       value="1.0">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>

    </div>

    <pre>
        {{ var_dump($errors->all()) }}
    </pre>
@stop