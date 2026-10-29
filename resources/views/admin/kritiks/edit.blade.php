@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Edit Kritik #{{ $kritik->id }}</h3>

  <div class="stat-box">
    <form action="{{ route('admin.kritiks.update', $kritik) }}" method="post" style="max-width:600px">
      @csrf @method('PUT')
      <div class="form-group">
        <label>User</label>
        <input type="text" class="form-control" value="{{ $kritik->film->title }} &mdash; {{ $kritik->user?->name }}" disabled>
        <small class="text-muted">User & film tidak dapat diubah.</small>
      </div>
      <div class="form-group">
        <label>Rating (1-5)</label>
        <input type="number" name="rating" value="{{ old('rating', $kritik->rating) }}" class="form-control" min="1" max="5" required>
      </div>
      <div class="form-group">
        <label>Komentar</label>
        <textarea name="comment" class="form-control" rows="4" required>{{ old('comment', $kritik->comment) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
      <a href="{{ route('admin.kritiks.index') }}" class="btn btn-default">Batal</a>
    </form>
  </div>
@endsection
