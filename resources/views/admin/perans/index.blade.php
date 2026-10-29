@extends('admin.layouts.app')

@section('content')
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
    <h3 class="panel-title-head" style="margin:0">Daftar Peran</h3>
    <a href="{{ route('admin.perans.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Peran</a>
  </div>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead><tr><th>#</th><th>Actor (nama peran)</th><th>Cast</th><th>Film</th><th style="width:170px">Aksi</th></tr></thead>
      <tbody>
        @forelse ($perans as $peran)
          <tr>
            <td>{{ $peran->id }}</td>
            <td>{{ $peran->actor }}</td>
            <td>{{ $peran->cast?->name }}</td>
            <td>{{ Str::limit($peran->film?->title, 30) }}</td>
            <td>
              <a href="{{ route('admin.perans.edit', $peran) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.perans.destroy', $peran) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus peran ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-muted">Belum ada peran.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $perans->links() }}</div>
@endsection
