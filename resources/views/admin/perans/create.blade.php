@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Tambah Peran</h3>

  <div class="stat-box">
    <form action="{{ route('admin.perans.store') }}" method="post" style="max-width:500px">
      @csrf
      <div class="form-group">
        <label>Nama Peran (actor)</label>
        <input type="text" name="actor" value="{{ old('actor') }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Cast</label>
        <select name="cast_id" class="form-control" required>
          <option value="">-- Pilih Cast --</option>
          @foreach ($casts as $cast)
            <option value="{{ $cast->id }}" {{ old('cast_id') == $cast->id ? 'selected' : '' }}>{{ $cast->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Film</label>
        <select name="film_id" class="form-control" required>
          <option value="">-- Pilih Film --</option>
          @foreach ($films as $film)
            <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>{{ $film->title }} ({{ $film->year }})</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="{{ route('admin.perans.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
