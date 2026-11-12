@extends('templates.index')

@section('content')
<div class="container">
  <br />
  <div class="agileits-single-top">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li class="active">Profil Saya</li>
    </ol>
  </div>
</div>

<div class="container" style="padding-bottom:60px">
  @if (session('success'))
    <div class="col-md-6" style="margin-bottom:12px">
      <div style="background:#dff0d8; border:1px solid #d6e9c6; color:#3c763d; padding:10px 15px">
        {{ session('success') }}
      </div>
    </div>
  @endif
  @if (session('error'))
    <div class="col-md-6" style="margin-bottom:12px">
      <div style="background:#f2dede; border:1px solid #ebccd1; color:#a94442; padding:10px 15px">
        {{ session('error') }}
      </div>
    </div>
  @endif

  <div class="col-md-8" style="background:#fff; box-shadow:0 1px 4px rgba(0,0,0,.1); padding:30px">
    <h3 style="margin-top:0">Profil Saya</h3>

    @if ($errors->any())
      <div class="alert alert-danger" style="padding:6px 12px; font-size:13px">
        <ul style="margin:0; padding-left:16px">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">
      {{-- Form profil --}}
      <div class="col-md-7">
        <h4 style="font-size:15px; color:#888">DATA PRIBADI</h4>
        <form action="{{ route('profile.update') }}" method="post">
          @csrf @method('PUT')
          <div class="form-group">
            <label>Email</label>
            <input type="email" value="{{ $user->email }}" class="form-control" disabled>
            <small class="text-muted">Email tidak dapat diubah.</small>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Umur</label>
                <input type="number" name="umur" value="{{ old('umur', $user->profile->umur ?: '') }}" class="form-control" min="1" max="120" required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $user->profile->alamat) }}" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->profile->bio) }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="background:#22254c; border-color:#22254c">
            <i class="fa fa-save"></i> Simpan Profil
          </button>
        </form>

        <hr style="margin:26px 0">

        {{-- Form ganti password --}}
        <h4 style="font-size:15px; color:#888">GANTI PASSWORD</h4>
        <form action="{{ route('profile.password') }}" method="post">
          @csrf @method('PUT')
          <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" name="current_password" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required>
            <small class="text-muted">Minimal 8 karakter.</small>
          </div>
          <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-warning">
            <i class="fa fa-key"></i> Ubah Password
          </button>
        </form>
      </div>

      {{-- Info akun --}}
      <div class="col-md-5" style="border-left:1px solid #eee; padding-left:30px">
        <h4 style="font-size:15px; color:#888">INFO AKUN</h4>
        <p style="font-size:13px">
          <strong>Nama:</strong> {{ $user->name }}<br>
          <strong>Email:</strong> {{ $user->email }}<br>
          <strong>Role:</strong> {{ $user->role?->name ?? '-' }}<br>
          <strong>Bergabung:</strong> {{ $user->created_at->format('d M Y') }}<br>
          <strong>Jumlah kritik:</strong> {{ $user->kritiks()->count() }}
        </p>
        <a href="{{ route('home') }}" class="btn btn-default btn-sm">&larr; Kembali ke beranda</a>
      </div>
    </div>
  </div>
</div>
@endsection
