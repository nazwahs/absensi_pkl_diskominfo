<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0D273D;
            --primary: #3E6985;
            --primary-hover: #2A495E;
            --surface: #c1d7e9;
            --card-soft: #8AA7BC; 
            --card: #FFFFFF;    
            --input-bg: #CDD7DF;
            --text-dark: #1C2B36;
            --text-muted: #4A5D6C;
            --text-light: #FFFFFF;
        }

        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: var(--primary-hover);
            padding-top: 70px;
        }

        .navbar {
            background: var(--surface);
            box-shadow: 0 4px 12px rgba(13, 39, 61, 0.35);
        }

        .navbar-brand img {
            height: 38px;
        }

        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 8px;
            transition: 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.47);
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.47);
        }

        .main-card {
            background: var(--card);
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            margin-bottom: 50px;
        }

        .welcome-section {
            background: var(--card);
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            margin-bottom: 32px;
            border-left: 4px solid var(--surface);
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(62,105,133,0.25);
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 10px;
            padding: 10px 28px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .foto-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
            display: none;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            color: var(--text-light);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" height="42">
                <span class="fw-bold ms-2 text-dark">SIPRALA</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-left gap-2">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('user/dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                            <i class="fa-solid fa-user-check"></i> Hadir
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('user/izin-sakit') ? 'active' : '' }}" href="{{ route('user.izin-sakit') }}">
                            <i class="fa-solid fa-hospital-user"></i> Izin / Sakit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1 {{ Request::is('user/riwayat') ? 'active' : '' }}" href="{{ route('user.riwayat') }}">
                            <i class="fa-solid fa-user-clock"></i> Riwayat
                        </a>
                    </li>
                    <li class="nav-item mx-2 d-none d-lg-block">
                        <div style="width:1px;height:30px;background:rgba(255,255,255,.3)"></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3E6985&color=ffffff" width="36" height="36" class="rounded-circle me-2">
                            <span class="fw-semibold d-none d-md-inline">
                                {{ auth()->user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li class="dropdown-header text-center">
                                <strong>{{ auth()->user()->name }}</strong>
                                <div class="small text-muted">{{ auth()->user()->role }}</div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-3">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
    <div class="container mt-4">
        <div class="welcome-section">
            <h5 class="fw-semibold mb-1 text-dark" id="greeting"></h5>
            <div class="d-flex gap-4 text-muted">
                <div>
                    <i class="fas fa-calendar-day"></i>
                    <span id="currentDate"></span>
                </div>
                <div>
                    <i class="fas fa-clock"></i>
                    <span id="currentTime"></span>
                </div>
            </div>
        </div>       
        @yield('content')        
        <div class="footer mt-4">
            © 2026 Sistem Absensi Digital
        </div>
    </div>    
    <div class="modal fade" id="fotoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const hour = now.getHours();
            let greeting = 'Selamat pagi';
            if (hour >= 12 && hour < 15) {
                greeting = 'Selamat siang';
            } else if (hour >= 15 && hour < 18) {
                greeting = 'Selamat sore';
            } else if (hour >= 18 || hour < 4) {
                greeting = 'Selamat malam';
            }

            $('#greeting').text(
                greeting + ', {{ auth()->user()->name }}'
            );

            $('#currentDate').text(
                now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })
            );

            $('#currentTime').text(
                now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                })
            );
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>
</html>