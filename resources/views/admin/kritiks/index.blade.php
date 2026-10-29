@extends('admin.layouts.app')

@section('content')
  <h3 class="panel-title-head">Daftar Kritik</h3>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead><tr><th>#</th><th>User</th><th>Film</th><th>Rating</th><th>Komentar</th><th style="width:170px">Aksi</th></tr></thead>
      <tbody>
        @forelse ($kritiks as $kritik)
          <tr>
            <td>{{ $kritik->id }}</td>
            <td>{{ $kritik->user?->name }}</td>
            <td>{{ Str::limit($kritik->film?->title, 25) }}</td>
            <td>{{ str_repeat('★', $kritik->rating) }}</td>
            <td>{{ Str::limit($kritik->comment, 50) }}</td>
            <td>
              <a href="{{ route('admin.kritiks.edit', $kritik) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.kritiks.destroy', $kritik) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus kritik ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-muted">Belum ada kritik.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $kritiks->links() }}</div>
@endsection
