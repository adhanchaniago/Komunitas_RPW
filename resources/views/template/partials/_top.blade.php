      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="navbar-toggler-icon"></span>
        </button> <a class="navbar-brand" href="{{ route('home') }}"><img class="bg-light" src="{{ asset('logo.png') }}" width="70" height="40" style="border-radius: 50%;" alt=""></a>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i>Home <span class="sr-only">(current)</span></a>
            </li>
            @auth
            @if(Auth::user()->role == 'member')
            <li class="nav-item active">
               <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-fire ml-4"></i> Hot Post <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active mr-5">
               <a class="nav-link" href="{{ route('home.newPost') }}"><i  class="fa fa-lemon ml-3"></i> New Post <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <form class="form-inline my-2 my-lg-0 mr-auto ml-0" action="">
                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Search"> 
                <button class="btn btn-primary my-2 my-sm-0" type="submit">
                  Search
                </button>
              </form>
            </li>
            @endif
            @endauth
          </ul>
          @auth
          <ul class="navbar-nav ml-md-auto">
            <li class="nav-item mr-4">
              <a class="nav-link" href="{{ route('posts.create',Auth::user()->username) }}"><i class="fas fa-pen" style="font-size: 24px;"></i></a>
            </li>
            <li class="nav-item dropdown">
                <div class="top-right links">
                    <a class="nav-link dropdown-toggle" href="{{ route('home') }}" id="navbarDropdownMenuLink" data-toggle="dropdown">
                      {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('users.show',Auth::user()->username) }}">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    </div>
                </div>
            </li>
            @else
            @if (Route::has('login'))
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @endif
            &nbsp;<span class="my-auto my-lg-0" style="color: #fff;">|</span>&nbsp;
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
            @endauth
          </ul>
        </div>
      </nav>