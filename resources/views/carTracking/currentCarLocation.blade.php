@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <link rel="stylesheet" href="/css/leaflet-routing-machine.css" />
@endsection

@section('scripts')
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script src="/js/leaflet-routing-machine.js"></script>
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div id="map" style="height: 600px"></div>
    </div>

    <script>
        var map = L.map('map').setView([{{ $tracking->latitude }}, {{ $tracking->longitude }}], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 17,
            minZoom: 2,
        }).addTo(map);


        L.Routing.control({
            waypoints: [
                    L.latLng( {{ $tracking->latitude }}, {{ $tracking->longitude }})
            ]
        }).addTo(map);
    </script>

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('d245da5c0ddc9792bac7', {
            cluster: 'eu',
            encrypted: true
        });

        var channel = pusher.subscribe('my-channel');

        channel.bind('my-event', function(data) {
            alert(data.message);
        });
    </script>
@endsection