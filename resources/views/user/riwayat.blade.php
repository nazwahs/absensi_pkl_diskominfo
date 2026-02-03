@extends('user.app')

@section('title', 'Riwayat Absensi')

@section('content')
<style>
.table thead {
    background: var(--surface);
}

.table th {
    color: var(--text-dark);
    font-weight: 600;
    border-bottom: none;
}

.table td {
    color: var(--text-dark);
    vertical-align: middle;
}

.badge-hadir {
    background: rgba(40, 167, 69, 0.15);
    color: #1e7e34;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
}

.badge-izin {
    background: rgba(255, 193, 7, 0.18);
    color: #856404;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
}

.badge-sakit {
    background: rgba(220, 53, 69, 0.15);
    color: #842029;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
}

.btn-outline-primary {
    border-color: var(--primary);
    color: var(--primary);
    border-radius: 8px;
}

.btn-outline-primary:hover {
    background: var(--primary);
    color: var(--text-light);
}
</style>
<div class="main-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold text-dark mb-0">
            <i class="fa-solid fa-user-clock me-2"></i>Riwayat Absensi
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </td>
                    <td>{{ $item->jam }}</td>
                    <td>
                        @if (in_array($item->status_hadir, ['hadir', 'terlambat']))
                        <span class="badge badge-hadir">Hadir</span>
                        @elseif ($item->status_hadir === 'alpa')
                        <span class="badge bg-danger">Alpa</span>
                        @elseif ($item->jenis === 'izin')
                        <span class="badge badge-izin">
                            Izin
                            @if ($item->status_izin === 'pending')
                            (Menunggu)
                            @elseif ($item->status_izin === 'diterima')
                            (Disetujui)
                            @elseif ($item->status_izin === 'ditolak')
                            (Ditolak)
                            @endif
                        </span>
                        @elseif ($item->jenis === 'sakit')
                        <span class="badge badge-sakit">
                            Sakit
                            @if ($item->status_izin === 'pending')
                            (Menunggu)
                            @elseif ($item->status_izin === 'diterima')
                            (Disetujui)
                            @elseif ($item->status_izin === 'ditolak')
                            (Ditolak)
                            @endif
                        </span>
                        @else
                        <span class="badge bg-secondary">Alpa</span>
                        @endif
                    </td>
                    <td>
                        @if (in_array($item->jenis, ['izin', 'sakit']))
                        {{ $item->keterangan ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->foto)
                        <button
                            class="btn btn-sm btn-outline-primary"
                            onclick="showFoto('{{ asset('storage/' . $item->foto) }}')"
                            title="Lihat Foto">
                            <i class="fa-solid fa-camera-retro"></i>
                        </button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada riwayat absensi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="fotoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalFoto" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
<script>
function showFoto(url) {
    document.getElementById('modalFoto').src = url;
    new bootstrap.Modal(document.getElementById('fotoModal')).show();
}
</script>
@endsection