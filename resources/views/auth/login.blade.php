@extends('templates.index')

@section('content')
<div class="container">
  <br />
  <div class="agileits-single-top">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li class="active">Login</li>
    </ol>
  </div>
</div>

<div class="container" style="padding-bottom:60px">
  <div class="col-md-6 col-md-offset-3" style="background:#fff; box-shadow:0 1px 4px rgba(0,0,0,.1); padding:30px">
    <h3 style="margin-top:0">Login ke Akun Anda</h3>

    @if ($errors->any())
      <div class="alert alert-danger" style="padding:6px 12px; font-size:13px">
        <ul style="margin:0; padding-left:16px">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('login.attempt') }}" method="post">
      @csrf
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember"> Ingat saya</label>
      </div>
      <button type="submit" class="btn btn-primary btn-block" style="background:#22254c; border-color:#22254c">Login</button>
    </form>

    <p style="margin-top:16px; font-size:13px">
      Belum punya akun?
      <a href="#" onclick="openRegisterForm(); return false;">Daftar di sini</a> (buka form <em>Create an account</em> di atas)<br>
      <a href="{{ route('home') }}">Kembali ke halaman utama</a>
    </p>

    <p class="text-muted" style="font-size:12px">Akun admin Anda: <code>admin@gmail.com</code> / <code>123456</code></p>
  </div>
</div>
@endsection
