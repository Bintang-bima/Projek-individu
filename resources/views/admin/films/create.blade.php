@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Tambah Film</h3>

  <div class="stat-box">
    <form action="{{ route('admin.films.store') }}" method="post" enctype="multipart/form-data" style="max-width:600px">
      @csrf
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Genre</label>
        <select name="genre_id" class="form-control" required>
          <option value="">-- Pilih Genre --</option>
          @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Tahun</label>
        <input type="number" name="year" value="{{ old('year', date('Y')) }}" class="form-control" min="1900" max="{{ date('Y') + 5 }}" required>
      </div>
      <div class="form-group">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control" rows="4" required>{{ old('sinopsis') }}</textarea>
      </div>
      <div class="form-group">
        <label>Poster (jpg/png/webp, maks 2MB)</label>
        <input type="file" name="poster" class="form-control" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
