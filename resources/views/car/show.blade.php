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
                @else
                    <a href="/car/{{ $car->id }}/edit-cover-photo" class="btn btn-primary">Add Cover Photo</a>
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
                        <dl class="col-sm-12">

                            <hr>

                            <dt>Price per hour</dt>
                            <dd>{{ $car->price_per_day }} $</dd>

                            <hr>
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
                    @endif
            </div><!-- ending col-sm-6 whole left side -->

            <div class="col-sm-6">
                <div class="row">
                    <div id="car-images-grid" class="grid">
                        @foreach($car->nonCoverPhotos() as $photo)
                            <div class="col-sm-4">
                                <img src="/car_images/{{ $photo->name }}"
                                     class=""
                                     style="width: 100%; height: 90px; margin-bottom: 20px;"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    @if(Auth::user() and Auth::user()->role == 'admin')
                        <form action="/car/{{ $car->id }}/upload-image"
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