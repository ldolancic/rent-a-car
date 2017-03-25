@extends('layouts.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <form action="/rent/{{ $rent->id }}" method="POST">
                    <input type="hidden" name="_method" value="PATCH">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Starting time</label>
                        <input type="date" name="starting_time" id="starting_time" class="form-control" value="{{ $rent->starting_time->toDateString() }}">
                    </div>

                    <div class="form-group">
                        <label>Ending time</label>
                        <input type="date" name="ending_time" id="ending_time" class="form-control" value="{{
                        $rent->ending_time->toDateString() }}">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="additional_driver"
                                @if($rent->additional_driver)
                                    checked
                                @endif
                            >
                            Additional driver</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="baby_seat"
                               @if($rent->baby_seat)
                                   checked
                                @endif
                            >
                            Baby seat</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="child_seat"
                                   @if($rent->child_seat)
                                   checked
                                    @endif
                            >
                            Child seat</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="full_protection"
                                   @if($rent->full_protection)
                                   checked
                                    @endif
                            >
                            Full protection</label>
                    </div>

                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="pending"
                                @if($rent->status == 'pending')
                                    selected
                                @endif
                            >
                                Pending
                            </option>

                            <option value="canceled"
                                    @if($rent->status == 'canceled')
                                    selected
                                    @endif
                            >
                                Canceled
                            </option>

                            <option value="confirmed"
                                    @if($rent->status == 'confirmed')
                                    selected
                                    @endif
                            >
                                Confirmed
                            </option>

                            <option value="in_progress"
                                    @if($rent->status == 'in_progress')
                                    selected
                                    @endif
                            >
                                In progress
                            </option>

                            <option value="finished"
                                    @if($rent->status == 'finished')
                                    selected
                                    @endif
                            >
                                Finished
                            </option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>
@endsection