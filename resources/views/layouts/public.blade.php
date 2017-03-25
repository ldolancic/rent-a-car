<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rent a Car</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/custom.css">

    @yield('styles')

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Bootstrap JavaScript and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript" src="/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/vue.js"></script>

    <script>
        // smooth scroll
        $(function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>

    <script>
        // push footer to bottom
        $(document).ready(function() {
            var docHeight = $(window).height();
            var footerHeight = $('footer').height();
            var footerTop = $('footer').position().top + footerHeight;

            if (footerTop < docHeight) {
                $('footer').css('margin-top', (docHeight - footerTop) + 'px');
            }
        });
    </script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('scripts')
</head>
<body id="page-top">

    @include('layouts.partials.navbar')

    @yield('content')

    <footer>
        <div class="container main-content">
            <div class="row">
                <div class="col-sm-7">
                    <h3>Rent a Car</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus accusantium aliquam aut blanditiis debitis dolore expedita explicabo fugiat in minus necessitatibus, porro quaerat repudiandae sequi tenetur unde voluptate voluptatum.
                    </p>
                </div>

                <div class="col-sm-2 col-sm-offset-1">
                    <div class="links-header">Useful links</div>
                    <ul class="links">
                        <li><a href="/search">Car Search</a></li>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <a href="#page-top" class="go-to-top">Go to the top <i class="fa fa-arrow-up"
                                                                       aria-hidden="true"></i></a>
                    <div class="social-media-links">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="copyright">Rent a Car &copy; Luka Dolančić</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
