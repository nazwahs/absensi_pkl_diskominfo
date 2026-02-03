<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siprala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0F1A2B;  
            --card-bg: #BDC4D4;    
            --primary: #52677D;  
            --primary-hover: #1C2E4A; 
            --input-bg: #D1CFC9;  
            --text-dark: #1C2E4A;   
            --text-muted: #52677D;
            --text-light: #FFFFFF;
        }

        body {
            background-color: var(--bg-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, sans-serif;
            padding: 20px;
            margin: 0;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            height: 90vh;
            max-height: 700px;
        }

        .register-card {
            background-color: var(--card-bg);
            border-radius: 18px;
            border: 1px solid rgba(15, 26, 43, 0.3);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card-header {
            padding: 25px 30px 15px 30px;
            flex-shrink: 0;
            background-color: var(--card-bg);
            z-index: 10;
            border-bottom: 1px solid rgba(15, 26, 43, 0.15);
        }

        .logo-header {
            text-align: center;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .logo-icon i {
            color: var(--text-light);
            font-size: 30px;
        }

        .logo-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.8rem;
        }

        .logo-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.4;
        }

        .form-scrollable-area {
            flex: 1;
            overflow-y: auto;
            padding: 0 30px 30px 30px;
        }

        .form-scrollable-area::-webkit-scrollbar {
            width: 6px;
        }

        .form-scrollable-area::-webkit-scrollbar-track {
            background: rgba(13, 39, 61, 0.1);
            border-radius: 3px;
        }

        .form-scrollable-area::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: block;
        }

        .form-control,
        .form-select {
            background-color: var(--input-bg);
            border: 2px solid rgba(15, 26, 43, 0.25);
            border-radius: 10px;
            height: 48px;
            font-size: 0.95rem;
            color: var(--text-dark);
            padding: 12px 15px;
            width: 100%;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(82, 103, 125, 0.15);
            background-color: var(--input-bg);
            outline: none;
        }

        .btn-register {
            background-color: var(--primary);
            color: var(--text-light);
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .btn-register:hover {
            background-color: var(--primary-hover);
            color: var(--text-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(15, 26, 43, 0.2);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            padding-top: 15px;
            border-top: 1px solid rgba(15, 26, 43, 0.1);
        }

        .login-link p {
            margin: 0;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .login-link a:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        #strength, #match {
            font-size: 0.85rem;
            display: block;
            margin-top: 5px;
            font-weight: 500;
        }

        ::placeholder {
            color: rgba(28, 46, 74, 0.6);
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="card-header">
                <div class="logo-header">
                    <div class="logo-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3>Daftar Akun</h3>
                    <p>Sistem Informasi Catatan Kehadiran</p>
                </div>
            </div>        
            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif           
            <div class="form-scrollable-area">
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf 
                    <div class="form-fields">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" placeholder="08*********" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Bidang</label>
                            <select name="bidang" class="form-select" required>
                                <option value="" selected disabled>Pilih Bidang</option>
                                <option value="Sekretariat">Sekretariat</option>
                                <option value="Pengelolaan Informasi dan Komunikasi Publik">Pengelolaan Informasi dan Komunikasi Publik</option>
                                <option value="Aplikasi Informatika">Aplikasi Informatika</option>
                                <option value="Infrastruktur Teknologi">Infrastruktur Teknologi</option>
                                <option value="Persandian dan Statistik">Persandian dan Statistik</option>
                                <option value="UPT Radio dan Televisi">UPT Radio dan Televisi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan password minimal 8 karakter">
                            <small id="strength" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Ulangi password">
                            <small id="match" class="text-muted"></small>
                        </div>                       
                        <button type="submit" class="btn-register">
                            <i class="fas fa-user-plus"></i>
                            Daftar Sekarang
                        </button>
                        <div class="login-link">
                            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const strengthText = document.getElementById('strength');
        const matchText = document.getElementById('match');

        password.addEventListener('input', () => {
            const value = password.value;
            if (value.length === 0) {
                strengthText.textContent = '';
            } else if (value.length < 8) {
                strengthText.textContent = 'Password lemah (minimal 8 karakter)';
                strengthText.style.color = '#dc3545';
            } else if (value.length < 12) {
                strengthText.textContent = 'Password cukup';
                strengthText.style.color = '#ffc107';
            } else {
                strengthText.textContent = 'Password kuat';
                strengthText.style.color = '#198754';
            }
        });
        
        confirmPassword.addEventListener('input', () => {
            const value = confirmPassword.value;
            if (value.length === 0) {
                matchText.textContent = '';
            } else if (value === password.value) {
                matchText.textContent = '✓ Password cocok';
                matchText.style.color = '#198754';
            } else {
                matchText.textContent = '✗ Password tidak cocok';
                matchText.style.color = '#dc3545';
            }
        });
    </script>
</body>
</html>