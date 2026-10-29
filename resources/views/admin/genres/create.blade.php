@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Tambah Genre</h3>

  <div class="stat-box">
    <form action="{{ route('admin.genres.store') }}" method="post" style="max-width:500px">
      @csrf
      <div class="form-group">
        <label>Nama Genre</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
