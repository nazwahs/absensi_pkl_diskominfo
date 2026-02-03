@extends('admin.layout')

@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Kehadiran Hari Ini</h5>
                <div class="d-flex">
                    <div class="filter-section me-3">
                        <div class="input-group">
                            <input type="text" id="search-nama" class="form-control" placeholder="Cari nama...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="filter-section">
                        <select id="filter-bidang" class="form-select">
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
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="absensiTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>Bidang</th>
                                <th>Waktu Absen</th>
                                <th>Kedisiplinan</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($absensiToday as $absensi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absensi->nama_lengkap }}</td>
                                    <td>{{ $absensi->bidang }}</td>
                                    <td>
                                        <div>{{ $absensi->jam }}</div>
                                        <small class="text-muted">{{ $absensi->tanggal }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $jamAbsen = strtotime($absensi->jam);
                                            $jamBatasTime = strtotime($jamBatas);
                                        @endphp

                                        @if($jamAbsen > $jamBatasTime)
                                        <span class="badge badge-telat">
                                            Telat {{ floor(($jamAbsen - $jamBatasTime) / 60) }} menit
                                        </span>
                                        @else
                                        <span class="badge badge-hadir">Tepat waktu</span>
                                        @endif
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($absensi->alamat, 30) }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $absensi->foto) }}" class="foto-thumbnail" alt="Foto" onclick="showFoto('{{ asset('storage/' . $absensi->foto) }}')" style="cursor: pointer;">
                                    </td>
                                    <td> - </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Tidak ada data kehadiran hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fotoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-nama');
    const filterBidang = document.getElementById('filter-bidang');
    const tableRows = document.querySelectorAll('#absensiTable tbody tr');

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const bidangValue = filterBidang.value;

        tableRows.forEach(row => {
            const nama = row.children[1]?.innerText.toLowerCase();
            const bidang = row.children[2]?.innerText;

            let show = true;

            if (searchValue && !nama.includes(searchValue)) {
                show = false;
            }

            if (bidangValue && bidang !== bidangValue) {
                show = false;
            }

            row.style.display = show ? '' : 'none';
        });
    }

    searchInput.addEventListener('keyup', filterTable);
    filterBidang.addEventListener('change', filterTable);
});
</script>
@endsection