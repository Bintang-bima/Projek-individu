@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Tambah Cast</h3>

  <div class="stat-box">
    <form action="{{ route('admin.casts.store') }}" method="post" style="max-width:500px">
      @csrf
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Umur</label>
        <input type="number" name="age" value="{{ old('age') }}" class="form-control" min="0" max="150" required>
      </div>
      <div class="form-group">
        <label>Bio</label>
        <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
