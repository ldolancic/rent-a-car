@extends('layouts.main')

@section('content')
    <div class="container">

        <p>Rent history for {{ $car->brand }} {{ $car->model }}</p>

        <table id="datatable" class="table table-striped table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>User</th>
                    <th>User ID</th>
                    <th>Starting time</th>
                    <th>Ending time</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rents as $rent)
                    <tr>
                        <td>{{ $rent->user->first_name }} {{ $rent->user->last_name }}</td>
                        <td>{{ $rent->user->id }}</td>
                        <td>{{ $rent->starting_time->toDateString() }}</td>
                        <td>{{ $rent->ending_time->toDateString() }}</td>
                        <td>{{ $rent->price }}</td>
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