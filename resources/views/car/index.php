<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Rent And Drive</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/css/ion.rangeSlider.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/css/ion.rangeSlider.skinFlat.css">
  <link rel="stylesheet" type="text/css" href="css/instantsearch-style.css">
</head>
<body>


  <!-- Header -->
  <header>
    <input id="search-input" type="text" autocomplete="off" spellcheck="false" autocorrect="off" placeholder="Search by name, brand, description..."/>
    <div id="search-input-icon"></div>
  </header>
  <!-- /Header -->


  <!-- Main -->
  <main>
    <!-- Left Column -->
    <div id="left-column">
      <div id="facets"></div>
    </div>

    <!-- Right Column -->
    <div id="right-column">
      <div id="stats"></div>
      <div id="hits"></div>
      <div id="pagination"></div>
    </div>
  </main>
  <!-- /Main -->

  <!-- Hit template -->
  <script type="text/template" id="hit-template">
    {{#hits}}
    <div class="hit">
      <div class="hit-image">
        <img src="/car_images/{{ cover_photo.name }}">
      </div>
      <div class="hit-content">
        <h3 class="hit-price">${{ price_per_day }}</h3>
        <h2 class="hit-name">{{{ _highlightResult.name.value }}}</h2>
        <p class="hit-description">{{{ _highlightResult.description.value }}}</p>
      </div>
    </div>
    {{/hits}}
  </script>

  <!-- Stats template -->
  <script type="text/template" id="stats-template">
    {{ nbHits }} Result{{#nbHits_plural}}s{{/nbHits_plural}} <span class="found-in">Found in {{ processingTimeMS }}ms</span>
  </script>

  <!-- Facet template -->
  <script type="text/template" id="facet-template">
    <div class="facet">
      <h5>{{ title }}</h5>
      <ul>
        {{#values}}
        <li>
          <a href="" class="facet-link toggle-refine {{#disjunctive}}facet-disjunctive{{/disjunctive}} {{#isRefined}}facet-refined{{/isRefined}}" data-facet="{{ facet }}" data-value="{{ name }}">
            {{ name }}<span class="facet-count">{{ count }}</span>
          </a>
        </li>
        {{/values}}
      </ul>
    </div>
  </script>

  <!-- Slider template -->
  <script type="text/template" id="slider-template">
    <div class="facet">
      <h5>{{ title }}</h5>
      <input type="text" id="{{ facet }}-slider" data-min="{{ min }}" data-max="{{ max }}" data-from="{{ from }}" data-to="{{ to }}"/>
    </div>
  </script>

  <!-- Pagination template -->
  <script type="text/template" id="pagination-template">
    <ul>
      <li {{^prev_page}}class="disabled"{{/prev_page}}><a href="#" {{#prev_page}}class="go-to-page" data-page="{{ prev_page }}"{{/prev_page}}>&#60;</a></li>
      {{#pages}}
      <li class="{{#current}}active{{/current}} {{#disabled}}disabled{{/disabled}}"><a href="#" {{^disabled}} class="go-to-page" data-page="{{ number }}" {{/disabled}}>{{ number }}</a></li>
      {{/pages}}
      <li {{^next_page}}class="disabled"{{/next_page}}><a href="#" {{#next_page}}class="go-to-page" data-page="{{ next_page }}"{{/next_page}}>&#62;</a></li>
    </ul>
  </script>

  <!-- No-Results template -->
  <script type="text/template" id="no-results-template">
    <div id="no-results-message">
      <p>We didnt find any results for the search <em>"{{ query }}"</em>.</p>
      <ul>
        {{#filters}}
        <li class="{{ class }}" data-facet="{{ facet }}" data-value="{{ facet_value }}">
          {{ label }}<span class="value">{{ label_value }}</span><a class="remove"><img src="img/remove.svg"/></a>
        </li>
        {{/filters}}
        <br>
        <a href="" class='clear-all'>Clear all</a>
      </ul>
    </div>
  </script>



  <!-- Javascript -->
  <script src="//cdn.jsdelivr.net/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="//cdn.jsdelivr.net/algoliasearch.helper/2/algoliasearch.helper.min.js"></script>
  <script src="//cdn.jsdelivr.net/hogan.js/3.0.2/hogan.min.common.js"></script>
  <script src="//cdn.jsdelivr.net/jquery.ion.rangeslider/2.0.12/js/ion.rangeSlider.min.js"></script>
  <script src="js/instantsearch-app.js"></script>
  <!-- /Javascript -->

</body>
</html>
