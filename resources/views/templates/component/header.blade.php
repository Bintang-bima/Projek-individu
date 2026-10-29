<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        @auth
          <li>
            Halo, <strong style="color:#e05d46">{{ auth()->user()->name }}</strong>
            @if (auth()->user()->isAdmin())
              | <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @endif
            <form action="{{ route('logout') }}" method="post" style="display:inline">
              @csrf
              <button type="submit" style="background:none; border:none; color:#fff; font-size:12px; padding:0; text-decoration:underline; cursor:pointer">| Logout</button>
            </form>
          </li>
        @else
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a>
        @endauth
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
