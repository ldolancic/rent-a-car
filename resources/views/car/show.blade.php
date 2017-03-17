@extends('layouts.main')

@section('scripts')
    <script src="/js/dropzone.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/dropzone.css">
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
                                <a href="/login" class="btn btn-success">Log in to rent this
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
                <div class="row">
                    <div id="car-images-grid" class="grid">
                        @foreach($car->nonCoverPhotos() as $photo)
                            <div class="col-sm-6 grid-image">
                                <img src="/car_images/{{ $photo->name }}"
                                     class="img-responsive"
                                     style="margin-bottom: 20px;"
                                >
                                <a href="/car/photo/{{ $photo->id }}" class="delete-image">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($car->additional_details)
                    <div class="row">
                        <p>{!! nl2br($car->additional_details) !!}</p>
                    </div>
                @endif

                <div class="row">
                    @if(Auth::user() and Auth::user()->role == 'admin')
                        <form action="/car/{{ $car->id }}/upload-photo"
                              method="POST"
                              class="dropzone"
                              id="dropzone">
                            {{ csrf_field() }}
                        </form>

                        <script>
                            Dropzone.options.dropzone = {
                                paramName: "photo", // The name that will be used to transfer the file
                                maxFilesize: 2 // MB
                            };
                        </script>
                    @endif
                </div>
            </div><!-- ending col-sm-6 whole right side -->
        </div>
    </div>
@stop