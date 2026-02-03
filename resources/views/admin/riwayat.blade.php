@extends('admin.layout')

@section('page-title', 'Riwayat Absensi')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="filter-section">
            <form method="GET" action="{{ route('admin.riwayat') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Filter Periode:</label>
                    <select name="filter" class="form-select" onchange="this.form.submit()">
                        <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cari Nama:</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Bidang:</label>
                    <select name="bidang" class="form-select">
                        <option value="">Semua Bidang</option>
                        <option value="Sekretariat">Sekretariat</option>
                        <option value="Bidang Pengelolaan">Bidang Pengelolaan</option>
                        <option value="BPIKP">BPIKP</option>
                        <option value="UPT">UPT</option>
                        <option value="IT">IT</option>
                        <option value="Bidang Aplikasi Informatika">Bidang Aplikasi Informatika</option>
                        <option value="Persandian">Persandian</option>
                        <option value="Statistik">Statistik</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn bg-primary-subtle me-2">Filter</button>
                    <a href="{{ route('admin.riwayat') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5>Riwayat Absensi</h5>
    </div>
    <div class="card-body">
        <table id="riwayatTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Bidang</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->nama_lengkap }}</td>
                    <td>{{ $r->bidang }}</td>
                    <td>{{ $r->tanggal }}</td>
                    <td>{{ $r->jam }}</td>
                    <td>
                        @if ($r->status_hadir === 'hadir')
                            <span class="badge bg-success">Hadir</span>
                        @elseif ($r->status_hadir === 'terlambat')
                            <span class="badge bg-danger">Terlambat</span>
                        @elseif ($r->status_hadir === 'alpa')
                            <span class="badge bg-secondary">Alpa</span>
                        @elseif (in_array($r->jenis, ['izin', 'sakit']))
                            <span class="badge bg-warning">
                                {{ ucfirst($r->jenis) }}
                                ({{ ucfirst($r->status_izin) }})
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($r->alamat, 20) }}</td>
                    <td>{{ $r->foto ? 'Ada' : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td class="text-center">Tidak ada data riwayat absensi</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $riwayat->links() }}
        </div>
    </div>
</div>
@endsection