<nav class="navbar navbar-dark navbar-expand-md">
  <div class="container">
    <a class="navbar-brand" href="/">Wayfinder</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-content">
      @auth
        <ul class="navbar-nav mr-auto">
          <li class="nav-item {{ request()->is("events*") ? 'active' : null }}">
            <a class="nav-link" href="{{ route('events.index') }}">Events</a>
          </li>
          <li class="nav-item {{ request()->is("locations*") ? 'active' : null }}">
            <a class="nav-link" href="{{ route('locations.index') }}">Locations</a>
          </li>
          <li class="nav-item {{ request()->is("uploads*") ? 'active' : null }}">
            <a class="nav-link" href="{{ route('uploads.index') }}">Uploads</a>
          </li>
          <li class="nav-item {{ request()->is("users*") ? 'active' : null }}">
            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
          </li>
        </ul>
      @endauth

      <ul class="navbar-nav ml-auto my-2 my-lg-0">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
          @endif
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endguest
      </ul>
    </div>
  </div>
</nav>
