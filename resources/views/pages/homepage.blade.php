@extends('layouts.main')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="backgrounded-content text-center">
                <h2>RENT A CAR</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur doloremque esse est mollitia nam necessitatibus quas quos sint unde vero. Accusantium aliquid corporis deleniti error est excepturi, illo nam optio suscipit voluptatem? Commodi cumque debitis doloremque dolores eligendi eveniet excepturi maiores nemo non nostrum quasi reiciendis repellendus suscipit, unde voluptatibus!</p>
            </div>

            <a href="#header1" class="text-center click-to-scroll-link-container"><div class="text-center
            click-to-scroll">Click to scroll</div><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="container" id="naslov-container">
        <h3 id="header1" style="height: 1000px;">Naslov</h3>
    </div>

    <script>
        var windowHeight = $(window).height();
        var navbarHeight = $('.navbar').height();

        $('.jumbotron').height(windowHeight - navbarHeight - 95);

        $(window).on('resize',function() {
            var windowHeight = $(window).height();
            var navbarHeight = $('.navbar').height();

            $('.jumbotron').height(windowHeight - navbarHeight - 95);
        });
    </script>
@endsection