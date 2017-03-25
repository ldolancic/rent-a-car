@extends('layouts.public')

@section('content')
    <div class="container">

        <h3>Create a car</h3>

        <form method="post" action="{{ route('car.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Brand name</label>
                    <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Model name</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Model name" required>
                </div>

                <div class="form-group">
                    <label>Transmission type</label>
                    <select name="transmission" id="transmission" class="form-control">
                        <option value="manual" selected>Manual</option>
                        <option value="automatic">Automatic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Car type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="sedan" selected>Sedan</option>
                        <option value="MPV">MPV</option>
                        <option value="SUV">SUV</option>
                        <option value="luxury">Luxury</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fuel type</label>
                    <select name="fuel" id="fuel" class="form-control">
                        <option value="diesel" selected>Diesel</option>
                        <option value="petrol">Petrol</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Number of seats</label>
                    <input type="number" class="form-control" id="seats" name="seats" min="2" max="10" value="5">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Number of doors</label>
                    <input type="number" class="form-control" id="doors" name="doors" min="2" max="7" value="5">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Price per day</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" min="1.0" step="0.1"
                           value="1.0">
                </div>

                <div class="form-group">
                    <label>Additional details</label>
                    <textarea name="additional_details" cols="30" rows="10" class="form-control"></textarea>
                </div>

            </div>
            </div><!-- ending row -->

            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="photo">Cover photo</label>
                        <input type="file" name="cover_photo" id="photo" class="file">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
@stop