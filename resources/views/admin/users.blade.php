@extends('admin.layout')

@section('title', 'Data Siswa')

@section('content')
<div class="main-card">
    <style>
    .text-custom {
        color: #ffffff;
        font-weight: bold;
    }
</style>
<h5 class="mb-4 text-custom">
    <i class="fa-solid fa-users me-2"></i>Siswa Terdaftar
</h5>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email ?? $user->username }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge bg-dark">Admin</span>
                        @else
                            <span class="badge bg-primary">User</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
