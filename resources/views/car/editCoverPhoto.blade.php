@extends('layouts.main')

@section('content')
    <div class="container">
        <form action="/car/{{ $car->id }}/store-cover-photo" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="photo">Upload a cover photo</label>
            <input type="file" name="photo" id="photo">

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection