@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="backgrounded-content text-center">
                <h2>RENT A CAR</h2>
                <p>&quot;Rent a Car&quot; is a web based system for a fictional car rental company. This project is
                    done as a part of my final thesis at the Faculty of electrical engineering, computer science
                    and information technology in Osijek.</p>
            </div>

            <div class="btn-container text-center">
                <a class="btn btn-huge btn-primary" href="/search">Search our cars <i class="fa fa-search"
                                                                       aria-hidden="true"></i></a>
            </div>

            <a href="#naslov-container" class="text-center click-to-scroll-link-container"><div class="text-center
            click-to-scroll">Click to scroll</div><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="container" id="naslov-container">
        <h3 style="height: 1000px;">Naslov</h3>
    </div>

    <script>
        function calculateJumbotronHeight()
        {
            var windowHeight = $(window).height();
            var navbarHeight = $('.navbar').height();
            var offset = 60;

            if ($(window).width() > 769) {
                var offset = 95;
            }

            $('.jumbotron').height(windowHeight - navbarHeight - offset);
        }

        function positionClickToScroll(resized)
        {
            var docHeight = $(window).height();
            var linkHeight = $('.click-to-scroll-link-container').height();
            var linkTop = $('.click-to-scroll-link-container').position().top + linkHeight;
            var offset = 0;

            if ($(window).width() > 768) {
                offset = 0;
            }

            if (linkTop < docHeight) {
                $('.click-to-scroll-link-container').css('margin-top', (docHeight - linkTop + offset) + 'px');
            }
        }

        calculateJumbotronHeight();
        positionClickToScroll();

        $(window).on('resize',function() {
            calculateJumbotronHeight();
            positionClickToScroll();
        })
    </script>
@endsection