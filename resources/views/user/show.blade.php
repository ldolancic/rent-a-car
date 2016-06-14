@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-bordered">
                    <tr>
                        <th>First name</th>
                        <td>{{ $user->first_name }}</td>
                    </tr>

                    <tr>
                        <th>Last name</th>
                        <td>{{ $user->last_name }}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>

                    <tr>
                        <th>Postal code</th>
                        <td>{{ $user->postal_code }}</td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role }}</td>
                    </tr>

                    <tr>
                        <th>Note</th>
                        <td>{{ $user->Note }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection