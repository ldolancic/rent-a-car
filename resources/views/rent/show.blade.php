@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-bordered">
                    <tr>
                        <th>User</th>
                        <td>{{ $rent->user->first_name }} {{ $rent->user->last_name }}</td>
                    </tr>

                    <tr>
                        <th>User email</th>
                        <td>{{ $rent->user->email }}</td>
                    </tr>

                    <tr>
                        <th>User phone</th>
                        <td>{{ $rent->user->phone }}</td>
                    </tr>

                    <tr>
                        <th>Car</th>
                        <td>{{ $rent->car->brand }} {{ $rent->car->model }}</td>
                    </tr>

                    <tr>
                        <th>Starting time</th>
                        <td>{{ $rent->starting_time->toDateString() }}</td>
                    </tr>

                    <tr>
                        <th>Ending time</th>
                        <td>{{ $rent->ending_time->toDateString() }}</td>
                    </tr>

                    <tr>
                        <th>Price</th>
                        <td>{{ $rent->price }}$</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>{{ $rent->status }}</td>
                    </tr>

                    <tr>
                        <th>Additional driver</th>
                        <td>
                            @if($rent->additional_driver)
                                yes
                            @else
                                no
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Baby seat</th>
                        <td>
                            @if($rent->baby_seat)
                                yes
                            @else
                                no
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Child seat</th>
                        <td>
                            @if($rent->child_seat)
                                yes
                            @else
                                no
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Full protection</th>
                        <td>
                            @if($rent->full_protection)
                                yes
                            @else
                                no
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Rent request sent at:</th>
                        <td>{{ $rent->created_at->toDateTimeString() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if(Auth::user() AND Auth::user()->role == 'admin')
            <a href="/rent/{{ $rent->id }}/edit" class="btn btn-primary">Edit rent info</a>
        @endif
    </div>
@endsection