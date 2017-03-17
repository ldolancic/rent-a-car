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

            <a href="#first-content-box" class="text-center click-to-scroll-link-container"><div class="text-center
            click-to-scroll">Click to scroll</div><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="home-content-box" id="first-content-box">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <img
                            class="img-responsive pull-left placeholdit-home"
                            src="https://placeholdit.imgix.net/~text?txtsize=45&txt=350%C3%97350&w=350&h=250"
                            alt="Placeholder image"
                    >
                </div>
                <div class="col-sm-7">
                    <h3>Sample content</h3>
                    <p >@include('loremIpsum/lorem100')</p>
                </div>
            </div>
        </div>
    </div>

    <div class="home-content-box">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <h3>Sample content</h3>
                    <p >@include('loremIpsum/lorem100')</p>
                </div>
                <div class="col-sm-5">
                    <img
                            class="img-responsive pull-right placeholdit-home"
                            src="https://placeholdit.imgix.net/~text?txtsize=45&txt=350%C3%97350&w=350&h=250"
                            alt="Placeholder image">
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm">
        Launch Normal Form
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Modal title
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <form role="form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control"
                                   id="exampleInputEmail1" placeholder="Enter email"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control"
                                   id="exampleInputPassword1" placeholder="Password"/>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"/> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
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