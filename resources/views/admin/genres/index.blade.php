@extends('admin.layouts.app')

@section('content')
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
    <h3 class="panel-title-head" style="margin:0">Daftar Genre</h3>
    <a href="{{ route('admin.genres.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Genre</a>
  </div>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead><tr><th>#</th><th>Nama</th><th>Jumlah Film</th><th style="width:170px">Aksi</th></tr></thead>
      <tbody>
        @forelse ($genres as $genre)
          <tr>
            <td>{{ $genre->id }}</td>
            <td>{{ $genre->name }}</td>
            <td>{{ $genre->films_count }}</td>
            <td>
              <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.genres.destroy', $genre) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus genre ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-muted">Belum ada genre.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $genres->links() }}</div>
@endsection
