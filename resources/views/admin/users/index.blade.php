@extends('admin.layouts.app')

@section('content')
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px">
    <h3 class="panel-title-head" style="margin:0">Daftar User</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah User</a>
  </div>

  <div class="stat-box" style="padding:0">
    <table class="table" style="margin:0">
      <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Umur</th><th>Jml Kritik</th><th style="width:170px">Aksi</th></tr></thead>
      <tbody>
        @forelse ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              <span class="label {{ $user->role?->name === 'admin' ? 'label-danger' : 'label-default' }}">{{ $user->role?->name }}</span>
            </td>
            <td>{{ $user->profile?->umur }}</td>
            <td>{{ $user->kritiks_count }}</td>
            <td>
              <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
              <form action="{{ route('admin.users.destroy', $user) }}" method="post" style="display:inline" onsubmit="return confirm('Hapus user ini beserta seluruh kritiknya?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-xs" {{ $user->id === auth()->id() ? 'disabled title="Tidak bisa menghapus akun sendiri"' : '' }}><i class="fa fa-trash"></i> Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-muted">Belum ada user.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center" style="margin-top:16px">{{ $users->links() }}</div>
@endsection
