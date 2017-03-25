@extends('layouts.public')

@section('content')
    <div class="container">

        <p>List of all the cars</p>

        <table id="datatable" class="table table-striped table-bordered dataTable no-footer">
            <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td><a href="/car/{{ $car->id }}/rent-history">view rent history</a></td>
                    <td><a href="/car/{{ $car->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            edit car info
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#datatable').dataTable();
        });
    </script>
@endsection