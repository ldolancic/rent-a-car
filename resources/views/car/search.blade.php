<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Rent a Car</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/css/ion.rangeSlider.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/css/ion.rangeSlider.skinFlat.css">
  <link rel="stylesheet" type="text/css" href="css/instantsearch-style.css">
  <link rel="stylesheet" href="/css/custom.css">
</head>
<body id="page-top">

<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="/">
        Rent a Car
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Home</a></li>
        <li><a href="/search">Car Search</a></li>
        <!-- Authentication Links -->
        <?php if(Auth::guest()): ?>

        <li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
        <?php else: ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <?php echo Auth::user()->first_name; echo Auth::user()->last_name; ?> <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
            <?php if(Auth::user() and Auth::user()->role == 'admin'): ?>
            <li><a href="/car/create"><i class="fa fa-plus"></i> Add a new
                car</a></li>
            <li><a href="/user"><i class="fa fa-user"></i> List users</a></li>
              <li><a href="/car"><i class="fa fa-car"></i> List cars</a></li>
            <?php endif ?>
            <?php if(Auth::user() and Auth::user()->role != 'admin'): ?>
            <li><a href="<?php echo '/user/' . Auth::user()->id . '/rent-history'?>"><i class="fa fa-history"></i>
             My Rent History</a></li>
              <li><a href="<?php echo '/user/' . Auth::user()->id . '/edit'?>"><i class="fa
                                        fa-pencil-square-o"></i> Edit my info</a></li>
            <?php endif ?>
            <li><a href="/logout"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>


    <div class="container search-input-container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-4">
          <input id="search-input" type="text" autocomplete="off" spellcheck="false" autocorrect="off"
                 placeholder="Search by brand, model, etc..."/>
          <div id="search-input-icon"></div>
        </div>
      </div>
    </div>
  <!-- /Header -->
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div id="facets"></div>
        </div>
        <div class="col-sm-8">
          <div id="stats"></div>
          <div id="hits"></div>
          <div id="pagination"></div>
        </div>
      </div>
    </div>

  <!-- Hit template -->
  <script type="text/template" id="hit-template">
    @{{#hits}}
    <div class="hit">
      <div class="hit-image">
        <a href="/car/@{{ id }}"><img src="/car_images/@{{ cover_photo.name }}"></a>
      </div>
      <div class="hit-content">
        <h3 class="hit-price">$@{{ price_per_day }}/day</h3>
        <h3 class="hit-name"><a href="/car/@{{ id }}">@{{ brand }} @{{ model }}</a></h3>
        <div class="hit-description">
          <div class="row">
            <div class="col-sm-4">
              <h4>Transmission</h4>
              <p>@{{ transmission }}</p>
            </div>
            <div class="col-sm-4">
              <h4>Vehicle Type</h4>
              <p>@{{ type }}</p>
            </div>
            <div class="col-sm-4">
              <h4>Fuel Type</h4>
              <p>@{{ fuel }}</p>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <h4>Doors</h4>
              <p>@{{ doors }}</p>
            </div>
            <div class="col-sm-4">
              <h4>Seats</h4>
              <p>@{{ seats }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @{{/hits}}
  </script>

  <!-- Stats template -->
  <script type="text/template" id="stats-template">
    @{{ nbHits }} Result@{{#nbHits_plural}}s@{{/nbHits_plural}} <span class="found-in">Found in @{{ processingTimeMS }}ms</span>
  </script>

  <!-- Facet template -->
  <script type="text/template" id="facet-template">
    <div class="facet">
      <h5>@{{ title }}</h5>
      <ul>
        @{{#values}}
        <li>
          <a href="" class="facet-link toggle-refine @{{#disjunctive}}facet-disjunctive@{{/disjunctive}} @{{#isRefined}}facet-refined@{{/isRefined}}" data-facet="@{{ facet }}" data-value="@{{ name }}">
            @{{ name }}<span class="facet-count">@{{ count }}</span>
          </a>
        </li>
        @{{/values}}
      </ul>
    </div>
  </script>

  <!-- Slider template -->
  <script type="text/template" id="slider-template">
    <div class="facet">
      <h5>@{{ title }}</h5>
      <input type="text" id="@{{ facet }}-slider" data-min="@{{ min }}" data-max="@{{ max }}" data-from="@{{ from }}" data-to="@{{ to }}"/>
    </div>
  </script>

  <!-- Pagination template -->
  <script type="text/template" id="pagination-template">
    <ul>
      <li @{{^prev_page}}class="disabled"@{{/prev_page}}><a href="#" @{{#prev_page}}class="go-to-page" data-page="@{{ prev_page }}"@{{/prev_page}}>&#60;</a></li>
      @{{#pages}}
      <li class="@{{#current}}active@{{/current}} @{{#disabled}}disabled@{{/disabled}}"><a href="#" @{{^disabled}} class="go-to-page" data-page="@{{ number }}" @{{/disabled}}>@{{ number }}</a></li>
      @{{/pages}}
      <li @{{^next_page}}class="disabled"@{{/next_page}}><a href="#" @{{#next_page}}class="go-to-page" data-page="@{{ next_page }}"@{{/next_page}}>&#62;</a></li>
    </ul>
  </script>

  <!-- No-Results template -->
  <script type="text/template" id="no-results-template">
    <div id="no-results-message">
      <p>We didnt find any results for the search <em>"@{{ query }}"</em>.</p>
      <ul>
        @{{#filters}}
        <li class="@{{ class }}" data-facet="@{{ facet }}" data-value="@{{ facet_value }}">
          @{{ label }}<span class="value">@{{ label_value }}</span><a class="remove"><img src="img/remove.svg"/></a>
        </li>
        @{{/filters}}
        <br>
        <a href="" class='clear-all'>Clear all</a>
      </ul>
    </div>
  </script>

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
          <i class="fa fa-facebook-official" aria-hidden="true"></i>
          <i class="fa fa-twitter-square" aria-hidden="true"></i>
          <i class="fa fa-google-plus-square" aria-hidden="true"></i>
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



  <!-- Javascript -->
  <script src="//cdn.jsdelivr.net/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="//cdn.jsdelivr.net/algoliasearch.helper/2/algoliasearch.helper.min.js"></script>
  <script src="//cdn.jsdelivr.net/hogan.js/3.0.2/hogan.min.common.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/js/ion.rangeSlider.min.js"></script>
  <script src="js/instantsearch-app.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- /Javascript -->

</body>
</html>
