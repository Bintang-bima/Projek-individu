<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        @auth
          <li style="display:flex; align-items:center; gap:10px">
            <span style="font-size:12px">
              Halo, <strong style="color:#e05d46">{{ auth()->user()->name }}</strong>
            </span>
            <a href="{{ route('profile.edit') }}" style="font-size:12px">Profil Saya</a>
            @if (auth()->user()->isAdmin())
              <a href="{{ route('admin.dashboard') }}" style="font-size:12px">Dashboard Admin</a>
            @endif
            <form action="{{ route('logout') }}" method="post" style="display:inline; margin-left:4px">
              @csrf
              <button type="submit"
                      style="background:#e05d46; color:#fff; border:none; border-radius:3px; padding:4px 12px; font-size:12px; cursor:pointer">
                <i class="fa fa-sign-out"></i> Logout
              </button>
            </form>
          </li>
        @else
          <li>
            <a href="#" data-toggle="modal" data-target="#myModal">Login</a>
            / <a href="#" onclick="openRegisterForm(); return false;">Daftar</a>
          </li>
        @endauth
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>
