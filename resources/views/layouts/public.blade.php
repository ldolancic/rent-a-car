<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rent a Car</title>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ mix('css/public.css') }}" rel="stylesheet">

    @yield('styles')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script type="text/javascript" src="{{ mix('js/libs.js') }}"></script>

    @yield('scripts')
</head>
<body id="page-top">

    @include('layouts.partials.public.navbar')

    @yield('content')

    @include('layouts.partials.public.footer')

</body>
</html>
