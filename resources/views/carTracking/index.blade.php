@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <link rel="stylesheet" href="/css/leaflet-routing-machine.css" />
@endsection

@section('scripts')
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script src="/js/leaflet-routing-machine.js"></script>
@endsection

@section('content')
    <div class="container">
        <div id="map" style="height: 600px"></div>
    </div>


    <script>


        var map = L.map('map').setView([45.554474, 18.695107], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 17,
            minZoom: 2,
        }).addTo(map);


        L.Routing.control({
            waypoints: [
                @foreach($trackings as $tracking)
                    L.latLng( {{ $tracking->latitude }}, {{ $tracking->longitude }}),
                @endforeach
            ]
        }).addTo(map);
    </script>
@endsection