@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Edit User: {{ $user->name }}</h3>

  <div class="stat-box">
    <form action="{{ route('admin.users.update', $user) }}" method="post" style="max-width:500px">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Role</label>
        <select name="role_id" class="form-control" required>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
          @endforeach
        </select>
        @if ($user->id === auth()->id())
          <small class="text-danger">Hati-hati: mengubah role akun sendiri bisa mengunci akses admin.</small>
        @endif
      </div>
      <div class="form-group">
        <label>Password Baru <small>(opsional)</small></label>
        <input type="password" name="password" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti password.</small>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
