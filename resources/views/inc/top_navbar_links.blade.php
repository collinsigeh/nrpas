
<ul class="navbar-nav">
    @auth
      <li class="nav-item"><a class="nav-link my-custom-nav-link" href="{{ route('dashboard') }}">My Account</a></li>
      <li class="nav-item"><a class="nav-link my-custom-nav-link" href="{{ route('logout') }}">Logout</a></li>
    @else
      <li class="nav-item"><a class="nav-link my-custom-nav-link" href="{{ route('register') }}">New Account</a></li>
      <li class="nav-item"><a class="nav-link my-custom-nav-link" href="{{ route('login') }}">Login</a></li>
    @endauth
    <li class="nav-item"><a class="nav-link my-custom-nav-link" href="{{ route('page.help') }}">Help</a></li>
  </ul>