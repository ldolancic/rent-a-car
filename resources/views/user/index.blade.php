@extends('layouts.public')

@section('content')
    <div class="container">

        <p>List of all the users</p>

        <table id="datatable" class="table table-striped table-bordered dataTable no-footer">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td><a href="/user/{{ $user->id }}/rent-history">view rent history</a></td>
                    <td><a href="/user/{{ $user->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            edit user info</a></td>
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