@extends('layouts.public')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
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

        L.marker(L.latLng( {{ $tracking->latitude }}, {{ $tracking->longitude }}), {
            title: '{{ $tracking->updated_at }}'
        }).addTo(map);

        var pusher = new Pusher('d245da5c0ddc9792bac7', {
            cluster: 'eu',
            encrypted: false,
            auth: {
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            }
        });

        var channel = pusher.subscribe('private-car-tracking-channel-1');

        channel.bind('CarTrackingAdded', function(data) {
            var latLng = L.latLng(data.tracking.latitude, data.tracking.longitude);

            L.marker(latLng, {title: data.tracking.updated_at}).addTo(map);

            map.setView(latLng, 13);
        });
    </script>
@endsection