<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark elegant-color-dark">
    <div class="container">
            @if(Auth::user())
                <a class="navbar-brand" href="/home">Whiteboard</a>
            @else
                <a class="navbar-brand" href="/">Whiteboard</a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="/modules">Modules <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="/posts">Posts</a>
                @if(Auth::guest())

                @elseif(Auth::user()->isLecturer == 1)
                  <a class="nav-item nav-link" href="/posts/create">Create Post</a>
                @endif
              </div>
              <div class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/home">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
              </div>
            </div>
    </div>
</nav>