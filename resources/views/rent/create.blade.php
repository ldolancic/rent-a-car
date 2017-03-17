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

                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="additional_driver">
                            Additional driver</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="baby_seat">
                            Baby seat</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="child_seat">
                            Child seat</label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="full_protection">
                            Full protection</label>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(function() {

            days = 1;

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

                days = picker.endDate.diff(picker.startDate, 'days') + 1;

                $('#calculated_price').html(calculatePrice());
            });

            $('.checkbox input[type="checkbox"]').click(function() {
                $('#calculated_price').html(calculatePrice());
            });

            function calculatePrice()
            {
                var additionalDriver = $('input[name="additional_driver"]').is(':checked');
                var babySeat = $('input[name="baby_seat"]').is(':checked');
                var childSeat = $('input[name="child_seat"]').is(':checked');
                var fullProtection = $('input[name="full_protection"]').is(':checked');

                var price =
                        additionalDriver * 3 * days +
                        fullProtection * 3 * days +
                        babySeat * 2 * days +
                        childSeat * 2 * days +
                        days * pricePerDay;

                return price;
            }

        });
    </script>
@endsection