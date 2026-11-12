@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Tambah User</h3>

  <div class="stat-box">
    <form action="{{ route('admin.users.store') }}" method="post" style="max-width:500px">
      @csrf
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
        <small class="text-muted">Minimal 8 karakter.</small>
      </div>
      <div class="form-group">
        <label>Role</label>
        <select name="role_id" class="form-control" required>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
          @endforeach
        </select>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Umur <small>(opsional)</small></label>
            <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" min="1" max="120">
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Alamat <small>(opsional)</small></label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-control">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
