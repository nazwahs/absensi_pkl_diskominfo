@extends('user.app')

@section('title', 'Absensi Izin/Sakit')

@section('content')
<div class="main-card">
    <h5 class="mb-4"><i class="fas fa-file-contract me-2"></i>Form Izin / Sakit</h5>    
    @if($sudahIzinSakit)
    <div class="alert alert-warning">
        <i class="fas fa-clock me-2"></i>
        <strong>Permohonan izin/sakit Anda sedang menunggu persetujuan admin</strong>
    </div>   
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>Jenis</h6>
                    @if($permohonanHariIni->jenis == 'izin')
                    <span>Izin</span>
                    @elseif($permohonanHariIni->jenis == 'sakit')
                    <span>Sakit</span>
                    @else
                    <span class="badge badge-secondary">Belum ditentukan</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>Waktu Pengajuan</h6>
                    <p class="mb-0">{{ $permohonanHariIni->jam }} WIB</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6>Status</h6>
                    @if($permohonanHariIni->status_izin == 'pending')
                        <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                    @elseif($permohonanHariIni->status_izin == 'diterima')
                        <span class="badge bg-success">Diterima</span>
                    @elseif($permohonanHariIni->status_izin == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-secondary">{{ $permohonanHariIni->status }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>  
    <div class="mt-3">
        <h6>Keterangan:</h6>
        <p>{{ $permohonanHariIni->keterangan }}</p>
    </div>
    @else
    @if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{ route('user.absensi.store') }}"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="izin">       
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Bidang</label>
                <input type="text" class="form-control" value="{{ auth()->user()->bidang }}"readonly>
            </div>
        </div>        
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Pilih Jenis</label>
                <select class="form-select" name="jenis" required>
                    <option value=""selected disabled>-- Pilih Jenis --</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
            </div> 
                    <div class="col-md-6">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto" accept="image/*" required>
                        <small class="text-muted">
                            Upload foto izin / surat dokter
                        </small>
                    </div> 
                            </div> 
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" rows="4" placeholder="Masukkan alasan izin/sakit..." required></textarea>
        </div> 
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane me-2"></i>Kirim
        </button>
    </form>
    @endif
</div>
@endsection