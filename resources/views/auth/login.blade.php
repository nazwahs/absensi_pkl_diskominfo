<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siprala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0F1A2B;   
            --card-bg: #BDC4D4;
            --primary: #52677D;    
            --light-bg: #D1CFC9; 
            --text-dark: #1C2E4A;   
            --text-muted: #52677D;
            --text-light: #FFFFFF;
        }
        
        body {
            background-color: var(--bg-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        
        .login-card {
            position: relative;
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid rgba(15, 26, 43, 0.3);
            box-shadow: 0 15px 30px rgba(15, 26, 43, 0.35);
        }
        
        .logo-header {
            text-align: center;
            margin-bottom: 26px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }
        
        .logo-icon i {
            font-size: 24px;
            color: var(--text-light);
        }
        
        .logo-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 1.5rem;
        }
        
        .logo-header p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        
        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }
        
        .form-control {
            background-color: var(--light-bg);
            border: 1.5px solid rgba(15, 26, 43, 0.25);
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--text-dark);
            font-size: 0.9rem;
            height: 42px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(82, 103, 125, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary);
            border: none;
            color: var(--text-light);
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            margin-top: 10px;
            cursor: pointer;
        }
        
        .btn-login:hover {
            background-color: #1C2E4A;
            color: #ffffff;
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid rgba(15, 26, 43, 0.25);
        }
        
        .register-link p {
            color: var(--text-muted);
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert-danger {
            background-color: #F8D7DA;
            border: 1px solid #DC3545;
            color: #842029;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 0.9rem;
        }
        
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .toggle-password:hover {
            color: var(--primary);
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-check {
            margin-top: 14px;
        }
        
        .form-check-input {
            background-color: var(--light-bg);
            border: 1.5px solid rgba(15, 26, 43, 0.3);
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-left: 6px;
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 0 15px;
            }
            
            .login-card {
                padding: 24px 20px;
            }
            
            .logo-header h3 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-header">
                <div class="logo-icon">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <h3>Masuk ke Akun</h3>
                <p>Sistem Informasi Catatan Kehadiran</p>
            </div>           
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif            
            @if(session('success'))
                <div class="alert alert-success" style="background: rgba(21, 128, 61, 0.1); border-color: rgba(21, 128, 61, 0.3); color: #57a472;">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif           
            <form method="POST" action="{{ route('login') }}">
                @csrf                
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(30, 41, 59, 0.8); border: 1.5px solid rgba(255, 255, 255, 0.2); border-right: none; color: var(--text-light);">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required style="border-left: none;">
                    </div>
                </div>               
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <div class="input-group">
                            <span class="input-group-text" style="background: rgba(30, 41, 59, 0.8); border: 1.5px solid rgba(255, 255, 255, 0.2); border-right: none; color: var(--text-light);">
                                <i class="fa-solid fa-lock-open"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required style="border-left: none;">
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>          
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.forgot') }}" style="color: var(--accent-blue); text-decoration: none; font-size: 0.85rem;">
                            Lupa password?
                        </a>
                    </div>
                </div>               
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>                
                <div class="register-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
                </div>
            </form>
        </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.querySelector('.toggle-password i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
        
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                if (e.target.id === 'username' || e.target.id === 'password') {
                    e.preventDefault();
                    document.querySelector('form').submit();
                }
            }
        });
        
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('Harap isi semua field yang diperlukan');
            }
        });
    </script>
</body>
</html>