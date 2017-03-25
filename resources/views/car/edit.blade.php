@extends('layouts.main')

@section('scripts')
    <script src="/js/dropzone.js"></script>
    <script src="https://unpkg.com/masonry-layout@4.1.1/dist/masonry.pkgd.min.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/dropzone.css">
    <style>
        .grid { width: 60%; }
        .grid-sizer,
        .grid-item { width: 50%; }
    </style>
@endsection

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

        <br>

        <h3>Additional car images</h3>

        <p>Car images added here show up on a single-car public page in a grid.</p>

        <div class="grid" id="images-grid" style="margin-bottom: 20px; float: left;">

            <div class="grid-sizer"></div>

            @foreach($car->nonCoverPhotos() as $photo)
                <div class="grid-item grid-image">
                    <img src="/car_images/{{ $photo->name }}"
                         class="img-responsive"
                    >
                    <a href="#" delete-link="/car/photo/{{ $photo->id }}" class="delete-image">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            @endforeach
        </div>

        <form action="/car/{{ $car->id }}/upload-photo"
              method="POST"
              class="dropzone"
              id="dropzone"
              style="width: 35%; float: right;"
        >
            {{ csrf_field() }}
        </form>

        <script>

            function generateNew(photoId, photoName)
            {
                return '<div class="grid-item grid-image">' +
                '<img src="/car_images/' + photoName + '"' +
                'class="img-responsive">' +
                '<a href="#" delete-link="/car/photo/' + photoId + '" class="delete-image">' +
                '<i class="fa fa-times" aria-hidden="true"></i></a></div>';
            }

            var $grid = new Masonry('.grid', {
                // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.grid-item',
                // use element for option
                columnWidth: '.grid-sizer',
                percentPosition: true,
            });

            Dropzone.options.dropzone = {
                paramName: "additional_photo", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                init: function() {
                    this.on("success", function(file, response) {
                        var newPhoto = $(generateNew(response.photo_id, response.photo_name));
                        $('#images-grid').append(newPhoto);

                        $grid.appended(newPhoto);
                        $grid.layout();

                        // blasphemy, I know :/
                        // strange bug, won't refresh the layout right away
                        setTimeout(function(){
                            $grid.layout();
                        }, 100);
                    });
                }
            };

            $('#images-grid').on('click', '.delete-image', function(event){
                event.preventDefault();

                var deleteUrl = $(this).attr('delete-link');
                var clickedBtn = this;

                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token' : '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $(clickedBtn).parent().fadeOut(300, function() {
                            $(this).remove();
                            $grid.layout();
                        });
                    }
                });
            });
        </script>

    </div>
@stop