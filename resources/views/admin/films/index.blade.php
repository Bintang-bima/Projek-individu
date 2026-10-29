@extends('admin.layouts.app')

@section('content')
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
    <h3 class="panel-title-head" style="margin:0">Daftar Film</h3>
    <a href="{{ route('admin.films.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Film</a>
  </div>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead>
        <tr><th style="width:90px">Poster</th><th>Judul</th><th>Genre</th><th>Tahun</th><th style="width:170px">Aksi</th></tr>
      </thead>
      <tbody>
        @forelse ($films as $film)
          <tr>
            <td><img src="{{ asset($film->poster) }}" style="width:60px"></td>
            <td>{{ Str::limit($film->title, 40) }}</td>
            <td>{{ $film->genre?->name }}</td>
            <td>{{ $film->year }}</td>
            <td>
              <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.films.destroy', $film) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus film ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-muted">Belum ada film.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $films->links() }}</div>
@endsection
