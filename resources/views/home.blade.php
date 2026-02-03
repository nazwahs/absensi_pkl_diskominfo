<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPRALA - Sistem Informasi Praktek Kerja Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Raleway:wght@700;800;900&family=Poppins:wght@700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --midnight-blue: #1C2E4A;
            --dusty-blue: #52677D;
            --ivory: #BDC4D4;
            --deep-navy: #0F1A2B;
            --buttercream: #D1CFC9;

            --bg-dark: var(--deep-navy);
            --surface: var(--dusty-blue);
            --card: #ffffff;

            --text-light: #ffffff;
            --text-muted: var(--ivory);
            --text-dark: #1C2B36;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(180deg, var(--deep-navy), var(--midnight-blue));
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(82, 103, 125, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 6px 30px rgba(0,0,0,.35);
            border-bottom: 1px solid rgba(255,255,255,.08);
            font-family: 'Raleway', sans-serif;
        }

        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #ffffff, var(--buttercream));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            color: #ffffff;
            font-weight: 700;
            transition: all .3s ease;
        }

        .nav-link:hover {
            color: var(--buttercream);
            transform: translateY(-2px);
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        .hero-section {
            max-width: 1200px;
            width: 100%;
            padding: 0 20px;
        }

        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffffff, var(--ivory));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-subtitle {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: var(--ivory);
            margin-bottom: 30px;
        }

        .hero-description {
            font-size: 1.15rem;
            line-height: 1.7;
            color: var(--buttercream);
            max-width: 620px;
            align-items: center;
        }

        .highlight-text {
            color: #ffffff;
            font-weight: 700;
        }

        .action-btn {
            padding: 16px 40px;
            font-size: 1.05rem;
            font-weight: 700;
            border-radius: 14px;
            transition: all .35s ease;
            text-decoration: none;
            display: inline-block;
            font-family: 'Raleway', sans-serif;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--midnight-blue), var(--dusty-blue));
            color: #ffffff;
            box-shadow: 0 12px 30px rgba(0,0,0,.35);
        }

        .btn-primary-custom:hover {
            transform: translateY(-4px);
            background: linear-gradient(135deg, var(--dusty-blue), var(--midnight-blue));
        }

        .btn-outline-custom {
            border: 2px solid var(--ivory);
            color: var(--ivory);
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: rgba(255,255,255,.08);
            color: #ffffff;
            transform: translateY(-4px);
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--ivory), transparent);
            margin: 45px 0;
        }

        .footer {
            background: var(--midnight-blue);
            padding: 30px 0;
            border-top: 1px solid rgba(255,255,255,.08);
            color: var(--ivory);
            align-items: center;
        }

        .footer h5 {
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
            color: #ffffff;
        }

        .footer a {
            color: var(--ivory);
        }

        .footer a:hover {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.7rem;
            }
            .hero-subtitle {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Logo"height="42">
                <span class="fw-bold ms-2">SIPRALA</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Logout</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="container">
            <div class="hero-section">
                <h1 class="hero-title">SIPRALA</h1>
                <h2 class="hero-subtitle">Selamat Datang di SIPRALA<br><span style="font-size: 1.5rem;">Sistem Informasi Praktek Kerja Lapangan</span></h2>
                <div class="divider"></div>             
                <p class="hero-description">
                    <span class="highlight-text">Platform digital revolusioner untuk transformasi monitoring PKL.</span> 
                    Sistem absensi real-time berbasis GPS dengan pelacakan progres terintegrasi dan laporan otomatis yang dirancang khusus untuk optimalisasi program magang.
                </p>               
                <div class="action-buttons">
                    @guest
                    <a href="{{ route('register') }}" class="action-btn btn-primary-custom">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="action-btn btn-outline-custom">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    @else
                    <a href="{{ route('user.dashboard') }}" class="action-btn btn-primary-custom">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('user.riwayat') }}" class="action-btn btn-outline-custom">
                        <i class="fas fa-history me-2"></i>Riwayat Absensi
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 text-md-start">
                    <h5 class="mb-3">SIPRALA</h5>
                    <p class="mb-0">Sistem Informasi Praktek Kerja Lapang - Platform digital untuk monitoring dan evaluasi kegiatan PKL.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="mb-3">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a></li>
                        @auth
                        <li class="mb-2"><a href="{{ route('user.dashboard') }}" class="text-white text-decoration-none">Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="divider" style="margin: 30px 0 center;"></div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy;2026 SIPRALA. Bidang Infrastruktur Teknologi </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>