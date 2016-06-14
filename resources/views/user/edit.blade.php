@extends('layouts.main')

@section('content')
    <div class="container">

        <h3>Edit user</h3>

        <div class="row">
        <form class="col-sm-4" method="post" action="/user/{{ $user->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ $user->first_name }}"
                       required
                       value="{{ $user->first_name }}"
                >
            </div>

            <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{
                $user->last_name }}"
                       required
                       value="{{ $user->last_name }}"
                >
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="{{
                $user->address }}"
                       required
                       value="{{ $user->address }}"
                >
            </div>

            <div class="form-group">
                <label>Post code</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="{{
                $user->postal_code }}"
                       value="{{ $user->postal_code }}"
                >
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="{{
                $user->email }}"
                       value="{{ $user->email }}"
                >
            </div>

            @if(Auth::user()->role == 'admin')

                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="admin"
                                @if($user->role == 'admin')
                                selected
                                @endif
                        >Admin</option>
                        <option value="regular"
                                @if($user->role == 'regular')
                                selected
                                @endif>Regular</option>
                    </select>
                </div>

            @endif

            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{
                $user->phone }}"
                       value="{{ $user->phone }}"
                >
            </div>

            <div class="form-group">
                <label>Note</label>
                <textarea class="form-control" name="note" id="note" cols="30" rows="10">{{ $user->note }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>

    </div>
@stop