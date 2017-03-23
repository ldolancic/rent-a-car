@extends('layouts.main')

@section('content')
    <div class="container">

        <h3>Edit a car</h3>


        <form method="post" action="{{ route('car.update', ['id' => $car->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-sm-6">
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
                        <label>Transmission type</label>
                        <select name="transmission" id="transmission" class="form-control">
                            <option value="manual" @if($car->transmission == 'manual') selected @endif>Manual</option>
                            <option value="automatic" @if($car->transmission == 'automatic') selected @endif>Automatic</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Car type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="sedan" @if($car->type == 'sedan') selected @endif>Sedan</option>
                            <option value="MPV" @if($car->type == 'MPV') selected @endif>MPV</option>
                            <option value="SUV" @if($car->type == 'SUV') selected @endif>SUV</option>
                            <option value="luxury" @if($car->type == 'luxury') selected @endif>Luxury</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fuel type</label>
                        <select name="fuel" id="fuel" class="form-control">
                            <option value="diesel" @if($car->fuel == 'diesel') selected @endif>Diesel</option>
                            <option value="petrol" @if($car->type == 'petrol') selected @endif>Petrol</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Number of seats</label>
                        <input type="number" class="form-control" id="seats" name="seats"
                               min="2"
                               max="10"
                               value="{{ $car->seats }}"
                        >
                    </div>
                </div>

                <div class="col-sm-6">

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

                    <div class="form-group">
                        <label>Additional details</label>
                        <textarea name="additional_details" cols="30" rows="10" class="form-control">{{ $car->additional_details }}</textarea>
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