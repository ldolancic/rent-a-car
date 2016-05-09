@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>

            <div class="col-sm-3">
                <label>Price of rent: </label> <span id="calculated_price">{{ $car->price_per_day }}</span> $
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <form action="/rent/{{ $car->id }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="starting_time" id="starting_time">
                    <input type="hidden" name="ending_time" id="ending_time">
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(function() {

            var pricePerDay = {{ $car->price_per_day }};

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            cb(moment(), moment());
            $('#starting_time').val(moment().format('YYYY-MM-DD'));
            $('#ending_time').val(moment().format('YYYY-MM-DD'));

            $('#reportrange').daterangepicker({
                'startDate': moment(),
                'endDate': moment(),
                'minDate': moment(),
                'maxDate': moment().add(3, 'months'),
                'dateLimit': {days: 20}
            }, cb);

            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                $('#starting_time').val(picker.startDate.format('YYYY-MM-DD'));
                $('#ending_time').val(picker.endDate.format('YYYY-MM-DD'));

                var days = picker.endDate.diff(picker.startDate, 'days') + 1;
                var priceOfRent = days * pricePerDay;

                $('#calculated_price').html(priceOfRent);
            });

        });
    </script>
@endsection