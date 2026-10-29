@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Dashboard</h3>

  <div class="row" style="margin:0">
    <div class="col-md-3">
      <div class="stat-box">
        <div class="accent"></div><small>Total Film</small>
        <h3>{{ $stats['films'] }}</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-box">
        <div class="accent"></div><small>Genre</small>
        <h3>{{ $stats['genres'] }}</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-box">
        <div class="accent"></div><small>Cast</small>
        <h3>{{ $stats['casts'] }}</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-box">
        <div class="accent"></div><small>Total User</small>
        <h3>{{ $stats['users'] }}</h3>
      </div>
    </div>
  </div>

  <div class="row" style="margin:16px 0 0">
    <div class="col-md-6">
      <div class="stat-box" style="margin-bottom:16px">
        <div class="accent"></div><small>Rating Rata-rata</small>
        <h3>{{ $stats['rating_avg'] }} / 5</h3>
      </div>
    </div>
    <div class="col-md-6">
      <div class="stat-box" style="margin-bottom:16px">
        <div class="accent"></div><small>Total Kritik</small>
        <h3>{{ $stats['kritiks'] }}</h3>
      </div>
    </div>
  </div>

  <div class="row" style="margin:0">
    <div class="col-md-6" style="padding-left:0">
      <div class="stat-box" style="padding:0">
        <div style="padding:16px"><strong><i class="fa fa-film"></i> 5 Film Terbaru</strong>
          <span class="pull-right"><a href="{{ route('admin.films.index') }}">Kelola &rarr;</a></span>
        </div>
        <table class="table" style="margin:0">
          <thead><tr><th>Judul</th><th>Genre</th><th>Tahun</th></tr></thead>
          <tbody>
            @forelse ($latestFilms as $film)
              <tr>
                <td>{{ Str::limit($film->title, 30) }}</td>
                <td>{{ $film->genre?->name }}</td>
                <td>{{ $film->year }}</td>
              </tr>
            @empty
              <tr><td colspan="3" class="text-muted">Belum ada film.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-6" style="padding-right:0">
      <div class="stat-box" style="padding:0">
        <div style="padding:16px"><strong><i class="fa fa-comments"></i> 5 Kritik Terbaru</strong>
          <span class="pull-right"><a href="{{ route('admin.kritiks.index') }}">Kelola &rarr;</a></span>
        </div>
        <table class="table" style="margin:0">
          <thead><tr><th>User</th><th>Film</th><th>Rating</th></tr></thead>
          <tbody>
            @forelse ($latestKritiks as $kritik)
              <tr>
                <td>{{ $kritik->user?->name }}</td>
                <td>{{ Str::limit($kritik->film?->title, 20) }}</td>
                <td>{{ str_repeat('★', $kritik->rating) }}</td>
              </tr>
            @empty
              <tr><td colspan="3" class="text-muted">Belum ada kritik.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
