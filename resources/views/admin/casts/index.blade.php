@extends('admin.layouts.app')

@section('content')
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
    <h3 class="panel-title-head" style="margin:0">Daftar Cast</h3>
    <a href="{{ route('admin.casts.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Cast</a>
  </div>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead><tr><th>#</th><th>Nama</th><th>Umur</th><th>Jumlah Peran</th><th style="width:170px">Aksi</th></tr></thead>
      <tbody>
        @forelse ($casts as $cast)
          <tr>
            <td>{{ $cast->id }}</td>
            <td>{{ $cast->name }}</td>
            <td>{{ $cast->age }}</td>
            <td>{{ $cast->perans_count }}</td>
            <td>
              <a href="{{ route('admin.casts.edit', $cast) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.casts.destroy', $cast) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus cast ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-muted">Belum ada cast.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $casts->links() }}</div>
@endsection
