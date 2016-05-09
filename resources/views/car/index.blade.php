@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($cars as $car)
                <div class="col-sm-4">
                    <div class="car-card" style="border: 1px solid #ebebeb;">
                        <a href="{{ route('car.show', ['id' => $car->id]) }}">
                            @if($car->coverPhoto())
                                <img src="/car_images/{{ $car->coverPhoto()->name }}"
                                     alt="Car image"
                                     class="img-responsive"
                                >
                            @else
                                <img src="http://placehold.it/400x250" class="img-responsive">
                            @endif
                        </a>
                        <a href="{{ route('car.show', ['id' => $car->id]) }}">
                            <div class="full-name">{{ $car->brand }} {{ $car->model }}</div>
                        </a>
                        <div class="doors"><label>Doors: </label> {{ $car->doors }}</div>
                        <div class="seats"><label>Seats: </label> {{ $car->seats }}</div>
                        <div class="price"><label>Price: </label> {{ $car->price_per_day }}$ / day</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
