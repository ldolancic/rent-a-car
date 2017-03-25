@extends('layouts.main')

@section('scripts')
    <script src="https://unpkg.com/masonry-layout@4.1.1/dist/masonry.pkgd.min.js"></script>
@endsection

@section('styles')
    <style>
        .grid { width: 100%; }
        .grid-sizer,
        .grid-item { width: 33%; margin-bottom: 10px; }
        .gutter-sizer { width: 0.33%; }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                @if( $car->coverPhoto() )
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="/car_images/{{ $car->coverPhoto()->name }}" alt="{{ $car->brand }} {{ $car->model }} cover photo" class="img-responsive">
                        </div>
                    </div>
                @endif

                <div class="row">
                    <br>

                    <div class="col-sm-6">
                        <dt>Brand name</dt>
                        <dd>{{ $car->brand }}</dd>
                    </div>

                    <div class="col-sm-6">
                        <dt>Model name</dt>
                        <dd>{{ $car->model }}</dd>
                    </div>
                    </div><!-- ending row -->


                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">

                            <dt>Number of seats</dt>
                            <dd>{{ $car->seats }}</dd>
                        </div>

                        <div class="col-sm-6">

                            <dt>Number of doors</dt>
                            <dd>{{ $car->doors }}</dd>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <dl class="col-sm-6">

                            <dt>Price per hour</dt>
                            <dd>{{ $car->price_per_day }} $</dd>

                        </dl>

                        <dl class="col-sm-6">
                            <dt>Transmission</dt>
                            <dd>{{ $car->transmission }}</dd>
                        </dl>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <dl class="col-sm-6">

                            <dt>Vehicle type</dt>
                            <dd>{{ $car->type }}</dd>

                        </dl>

                        <dl class="col-sm-6">

                            <dt>Fuel type</dt>
                            <dd>{{ $car->fuel }}</dd>

                        </dl>
                    </div>

                    @if(Auth::user() and Auth::user()->role == 'regular')

                        <div class="row">
                            <div class="col-sm-6">
                                <a href="/rent/{{ $car->id }}/create" class="btn btn-success">Rent this car</a>
                            </div>
                        </div>
                    @elseif(!Auth::user())
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="/rent/{{ $car->id }}/create" class="btn btn-success">Log in to rent this
                                    car</a>
                            </div>
                        </div>
                    @elseif(Auth::user() and Auth::user()->role == 'admin')
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="/car/{{ $car->id }}/rent-history" class="btn btn-primary">View rent history</a>
                            </div>

                            <div class="col-sm-6">
                                <a href="/car/{{ $car->id }}/edit" class="btn btn-danger">Edit car info</a>
                            </div>
                        </div>
                    @endif
            </div><!-- ending col-sm-6 whole left side -->

            <div class="col-sm-6">

                @if($car->additional_details)
                    <h3>Additional details</h3>
                    <p>{!! nl2br($car->additional_details) !!}</p>
                @endif

            </div><!-- ending col-sm-6 whole right side -->
        </div>

        <div class="row">
            <div class="col-sm-12">

                <br><br>
            <h2>Gallery</h2>

            <div class="grid" id="images-grid">

                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>

                @foreach($car->nonCoverPhotos() as $photo)
                    <div class="grid-item grid-image">
                        <img src="/car_images/{{ $photo->name }}"
                             class="img-responsive"
                        >
                    </div>
                @endforeach
            </div>

            <script>
                var $grid = new Masonry('.grid', {
                    // set itemSelector so .grid-sizer is not used in layout
                    itemSelector: '.grid-item',
                    // use element for option
                    columnWidth: '.grid-sizer',
                    gutter: '.gutter-sizer',
                    percentPosition: true,
                });

                setTimeout(function() {
                    $grid.layout();
                }, 100);
            </script>
            </div>
        </div>
    </div>
@stop