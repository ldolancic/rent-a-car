@extends('layouts.public')

@section('content')
    <div class="container">

        <p>Rent history for {{ $car->brand }} {{ $car->model }}</p>

        <table id="datatable" class="table table-striped table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>User</th>
                    <th>User rent history</th>
                    <th>Starting time</th>
                    <th>Ending time</th>
                    <th>Price</th>
                    <th>Status</th>
                    @if(Auth::user() and Auth::user()->role == 'admin')
                        <th>Car tracking</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($rents as $rent)
                    <tr>
                        <td>{{ $rent->user->first_name }} {{ $rent->user->last_name }}</td>
                        <td><a href="/user/{{ $rent->user->id }}/rent-history">View users rent history</a></td>
                        <td>{{ $rent->starting_time->toDateString() }}</td>
                        <td>{{ $rent->ending_time->toDateString() }}</td>
                        <td>{{ $rent->price }}</td>
                        <td>{{ $rent->status }}</td>
                        @if(Auth::user() and Auth::user()->role == 'admin')
                            <td><a href="/rent/{{ $rent->id }}/car-tracking">Track the route</a></td>
                        @endif
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