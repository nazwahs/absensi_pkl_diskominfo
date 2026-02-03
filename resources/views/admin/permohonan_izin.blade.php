@extends('admin.layout')

@section('page-title', 'Permohonan Izin')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Permohonan Izin / Sakit</h5>
        <span class="badge bg-warning text-dark">Pending Izin: {{ $countIzin }}</span>
        <span class="badge bg-danger ms-2">Pending Sakit: {{ $countSakit }}</span>
    </div>
    <div class="card-body">
        <table id="izinTable" class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Bidang</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permohonan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->bidang }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>
                        @if($p->jenis == 'izin')
                            <span class="badge bg-warning">Izin</span>
                        @elseif($p->jenis == 'sakit')
                            <span class="badge bg-danger">Sakit</span>
                        @else
                            <span class="badge bg-secondary">{{ $p->jenis }}</span>
                        @endif
                    </td>
                    <td>
                        @if (in_array($p->jenis, ['izin', 'sakit']))
                        -
                        @else
                        {{ Str::limit($p->alamat, 30) }}
                        @endif
                    </td>
                    <td>{{ $p->keterangan ?? '-' }}</td>
                    <td>
                        @if($p->status_izin == 'pending')
                            <form action="{{ route('admin.permohonan.setujui', $p->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" title="Setujui">
                                    ✔
                                </button>
                            </form>
                            <form action="{{ route('admin.permohonan.tolak', $p->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                    ✖
                                </button>
                            </form>
                        @elseif($p->status_izin == 'diterima')
                            <span class="badge bg-success">Sudah Disetujui</span>
                        @elseif($p->status_izin == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td class="text-center">Tidak ada data</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection