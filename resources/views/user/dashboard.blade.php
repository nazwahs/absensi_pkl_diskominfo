@extends('user.app')

@section('title', 'Absensi Hadir')

@section('content')

<style>
.video-container {
    position: relative;
    width: 100%;
    max-width: 400px;
    margin: 0 auto 20px;
    border-radius: 15px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    display: none;
}

#video {
    width: 100%;
    height: auto;
    display: block;
}

.camera-controls {
    display: none;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

.camera-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.camera-btn.primary {
    background: var(--primary);
    color: white;
}

.camera-btn.secondary {
    background: #6c757d;
    color: white;
}

.camera-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.start-camera-btn {
    width: 100%;
    padding: 18px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}

.start-camera-btn:hover {
    background: var(--primary-hover);
}

#previewContainer {
    display: none;
    text-align: center;
}

#previewImage {
    width: 100%;
    max-width: 400px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
</style>

<div class="main-card">
    <h5 class="mb-4">
        <i class="fas fa-user-check me-2"></i>Form Absensi Hadir
    </h5>

    @if($sudahAbsen)
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Anda sudah absen hari ini!</strong><br>
            <small>Terima kasih sudah absen pada {{ $absensiHariIni->jam }} WIB</small>
        </div>
    @else

    <form method="POST" action="{{ route('user.absensi.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="type" value="hadir">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <input type="hidden" name="foto" id="foto">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label">Bidang</label>
                <input type="text" class="form-control" value="{{ auth()->user()->bidang }}"readonly>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label">Alamat Lokasi</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="6" readonly required>Mendeteksi lokasi...</textarea>
                <small class="text-muted">Lokasi diambil otomatis dari GPS</small>
            </div>
        <div class="col-md-6">
            <label class="form-label">Foto Absensi</label>
            <button type="button" class="start-camera-btn" id="startCameraBtn">
                <i class="fas fa-camera"></i> Buka Kamera
            </button>
            <div class="video-container" id="videoContainer">
                <video id="video" autoplay playsinline></video>
            </div>
            <div class="camera-controls" id="cameraControls">
                <button type="button" class="camera-btn primary" id="captureBtn">
                    📸 Ambil Foto
                </button>
            </div>
            <div id="previewContainer" class="mt-3">
                <img id="previewImage">
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3" id="btnSubmit" disabled>
            <i class="fas fa-paper-plane me-2"></i>Kirim
        </button>
    </form>
    @endif
</div>

<script>
const startCameraBtn = document.getElementById('startCameraBtn');
const videoContainer = document.getElementById('videoContainer');
const video = document.getElementById('video');
const cameraControls = document.getElementById('cameraControls');
const captureBtn = document.getElementById('captureBtn');
const previewContainer = document.getElementById('previewContainer');
const previewImage = document.getElementById('previewImage');
const fotoBase64Input = document.getElementById('foto');

let stream = null;
let canvas = document.createElement('canvas');
let context = canvas.getContext('2d');

startCameraBtn.addEventListener('click', startCamera);
captureBtn.addEventListener('click', capturePhoto);

async function startCamera() {
    stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: 'user' },
        audio: false
    });

    video.srcObject = stream;
    videoContainer.style.display = 'block';
    cameraControls.style.display = 'flex';
    startCameraBtn.style.display = 'none';
}

function capturePhoto() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/jpeg', 0.8);
    fotoBase64Input.value = imageData;

    previewImage.src = imageData;
    previewContainer.style.display = 'block';

    videoContainer.style.display = 'none';
    cameraControls.style.display = 'none';

    stream.getTracks().forEach(track => track.stop());
}

document.addEventListener('DOMContentLoaded', function () {
    navigator.geolocation.getCurrentPosition(
        successLocation,
        () => alert('Lokasi wajib diaktifkan untuk absen'),
        { enableHighAccuracy: true, timeout: 10000 }
    );

    function successLocation(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        latitude.value = lat;
        longitude.value = lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
            .then(res => res.json())
            .then(data => {
                alamat.value = data.display_name ?? 'Alamat tidak ditemukan';
                btnSubmit.disabled = false;
            })
            .catch(() => {
                alamat.value = 'Lokasi tidak dapat dibaca';
                btnSubmit.disabled = false;
            });
    }
});
</script>
@endsection