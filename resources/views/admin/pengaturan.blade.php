@extends('admin.layout')

@section('page-title', 'Pengaturan Sistem')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Pengaturan Umum</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengaturan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" name="nama_aplikasi" value="Sistem Absensi Karyawan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk" value="{{ $settings['jam_masuk'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Pulang</label>
                            <input type="time" class="form-control" name="jam_pulang" value="{{ $settings['jam_pulang'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Toleransi Telat (menit)</label>
                            <input type="number" class="form-control" name="toleransi_telat" value="{{ $settings['toleransi_telat'] ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan Pengaturan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Pengaturan Notifikasi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notifikasi.update') }}">
                        @csrf
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="notif_email" id="notifEmail" checked>
                            <label class="form-check-label" for="notifEmail">Aktifkan notifikasi email</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="notif_izin" id="notifIzin" checked>
                            <label class="form-check-label" for="notifIzin">Notifikasi saat ada permohonan izin</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="notif_telat" id="notifTelat" checked>
                            <label class="form-check-label" for="notifTelat">Notifikasi keterlambatan</label>
                        </div>
                        <div class="mb-3">
                            <label for="emailAdmin" class="form-label">Email Admin</label>
                            <input type="email" name="email_admin" class="form-control" id="emailAdmin" value="admin@absensi.com">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection