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
            <a class="navbar-brand" href="{{ url('/') }}">
                Rent a Car
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/search') }}">Car Search</a></li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user() and Auth::user()->role == 'admin')
                                <li><a href="{{ url('/car/create') }}"><i class="fa fa-plus"></i> Add a new
                                        car</a></li>
                                <li><a href="{{ url('/user') }}"><i class="fa fa-user"></i> List users</a></li>
                                <li><a href="{{ url('/car') }}"><i class="fa fa-car"></i> List cars</a></li>
                            @endif
                            @if(Auth::user() and Auth::user()->role != 'admin')
                                <li><a href="{{ url('/user/' . Auth::user()->id . '/rent-history') }}"><i class="fa fa-history"></i> My Rent History</a></li>
                                <li><a href="{{ url('/user/' . Auth::user()->id . '/edit') }}"><i class="fa
                                        fa-pencil-square-o"></i> Edit my info</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>