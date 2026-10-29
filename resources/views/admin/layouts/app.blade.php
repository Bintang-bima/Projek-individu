<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard | One Movies</title>
  <link rel="stylesheet" href="{{ asset('template/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}">
  <style>
    body { background: #f4f6f9; font-family: 'Roboto Condensed', sans-serif; overflow-x: hidden; }
    .sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: 240px; background: #22254c; color: #fff; padding: 0; z-index: 100; }
    .sidebar .brand { display: block; padding: 20px 16px; font-size: 20px; font-weight: bold; color: #fff; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,.1); }
    .sidebar .brand span { color: #e05d46; }
    .sidebar a.menu { display: block; padding: 10px 16px; color: #c9cbe3; text-decoration: none; border-left: 3px solid transparent; }
    .sidebar a.menu:hover, .sidebar a.menu.active { background: rgba(255,255,255,.06); color: #fff; border-left-color: #e05d46; }
    .sidebar .section { padding: 12px 16px 4px; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; color: #73768f; }
    .content { margin-left: 240px; min-height: 100vh; }
    .topbar { background: #fff; padding: 14px 20px; border-bottom: 1px solid #e3e6f0; display: flex; justify-content: space-between; align-items: center; }
    .main { padding: 20px; }
    .panel-title-head { margin: 0 0 20px; font-weight: bold; }
    .stat-box { background: #fff; border-radius: 6px; padding: 20px; box-shadow: 0 1px 2px rgba(0,0,0,.05); }
    .stat-box h3 { margin: 0 0 4px; font-size: 28px; font-weight: bold; }
    .stat-box small { text-transform: uppercase; letter-spacing: 1px; color: #888; font-size: 11px; }
    .stat-box .accent { width: 42px; height: 3px; background: #e05d46; margin-bottom: 10px; }
    .table th { font-size: 12px; text-transform: uppercase; letter-spacing: .5px; }
  </style>
  @stack('style')
</head>
<body>

  <div class="sidebar">
    <a class="brand" href="{{ route('admin.dashboard') }}">One<span>Movies</span><small class="text-lowercase"> admin</small></a>
    <div class="section">Utama</div>
    <a class="menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</a>
    <div class="section">Data</div>
    <a class="menu {{ request()->routeIs('admin.films.*') ? 'active' : '' }}" href="{{ route('admin.films.index') }}"><i class="fa fa-film"></i>&nbsp; Films</a>
    <a class="menu {{ request()->routeIs('admin.genres.*') ? 'active' : '' }}" href="{{ route('admin.genres.index') }}"><i class="fa fa-tags"></i>&nbsp; Genres</a>
    <a class="menu {{ request()->routeIs('admin.casts.*') ? 'active' : '' }}" href="{{ route('admin.casts.index') }}"><i class="fa fa-group"></i>&nbsp; Casts</a>
    <a class="menu {{ request()->routeIs('admin.perans.*') ? 'active' : '' }}" href="{{ route('admin.perans.index') }}"><i class="fa fa-user-circle"></i>&nbsp; Perans</a>
    <a class="menu {{ request()->routeIs('admin.kritiks.*') ? 'active' : '' }}" href="{{ route('admin.kritiks.index') }}"><i class="fa fa-comments"></i>&nbsp; Kritiks</a>
    <div class="section">Lainnya</div>
    <a class="menu" href="{{ route('home') }}"><i class="fa fa-globe"></i>&nbsp; Lihat Website</a>
  </div>

  <div class="content">
    <div class="topbar">
      <div><strong>Admin Panel</strong></div>
      <div>
        {{ Auth::user()->name }} &nbsp;
        <form action="{{ route('logout') }}" method="post" style="display:inline">
          @csrf
          <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-sign-out"></i> Logout</button>
        </form>
      </div>
    </div>

    <div class="main">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul style="margin:0; padding-left:18px">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </div>
  </div>

<script src="{{ asset('template/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
</body>
</html>
