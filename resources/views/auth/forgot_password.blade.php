<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Siprala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            --success-color: #2e7d32;
            --error-color: #c62828;
        }
        
        body {
            background-color: var(--bg-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, sans-serif;
            padding: 20px;
        }
        
        .forgot-container {
            width: 100%;
            max-width: 420px;
        }
        
        .forgot-card {
            background-color: var(--card-bg);
            border-radius: 14px;
            padding: 30px;
            border: 1px solid rgba(13, 39, 61, 0.3);
        }
        
        .logo-header {
            text-align: center;
            margin-bottom: 24px;
        }
        
        .logo-icon {
            width: 56px;
            height: 56px;
            background-color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            transition: transform 0.3s ease;
        }
        
        .logo-icon:hover {
            transform: scale(1.05);
        }
        
        .logo-icon i {
            color: var(--text-light);
            font-size: 24px;
        }
        
        .logo-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .logo-header p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0;
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 6px;
        }
        
        .form-control {
            background-color: var(--input-bg);
            border: 1.5px solid rgba(13, 39, 61, 0.25);
            border-radius: 8px;
            height: 42px;
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: none;
            background-color: var(--input-bg);
        }
        
        .btn-reset {
            background-color: var(--primary);
            color: var(--text-light);
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background-color 0.2s ease;
        }
        
        .btn-reset:hover {
            background-color: var(--primary-hover);
            color: var(--text-light);
        }
        
        .login-link {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid rgba(13, 39, 61, 0.25);
            text-align: center;
        }
        
        .login-link p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-muted);
        }
        
        .login-link a {
            color: var(--bg-dark);
            font-weight: 600;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            background-color: rgba(13, 39, 61, 0.1);
            border: 1px solid rgba(13, 39, 61, 0.2);
            color: var(--text-dark);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }
        
        .alert-success {
            background-color: rgba(46, 125, 50, 0.1);
            border-color: rgba(46, 125, 50, 0.3);
            color: var(--success-color);
        }
        
        .alert-error {
            background-color: rgba(198, 40, 40, 0.1);
            border-color: rgba(198, 40, 40, 0.3);
            color: var(--error-color);
        }
        
        .token-box {
            background-color: var(--input-bg);
            border: 1.5px solid rgba(13, 39, 61, 0.25);
            border-radius: 8px;
            padding: 12px;
            margin-top: 12px;
            word-break: break-all;
            font-family: monospace;
            font-size: 0.8rem;
            color: var(--text-dark);
        }
        
        .copy-btn {
            background-color: rgba(13, 39, 61, 0.1);
            border: 1px solid rgba(13, 39, 61, 0.25);
            color: var(--text-dark);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .copy-btn:hover {
            background-color: rgba(13, 39, 61, 0.2);
        }
        
        .input-group-text {
            background-color: var(--input-bg);
            border: 1.5px solid rgba(13, 39, 61, 0.25);
            border-right: none;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .form-control.with-icon {
            border-left: none;
        }
        
        .form-toggle {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(13, 39, 61, 0.2);
        }
        
        .form-toggle a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }
        
        .form-toggle a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .forgot-container {
                padding: 0 15px;
            }
            
            .forgot-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="logo-header">
                <div class="logo-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h3>Lupa Password</h3>
                <p>Reset password akun Anda</p>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                @if(session('reset_link'))
                    <div class="mb-3">
                        <p class="form-label mb-2">Link Reset Password:</p>
                        <div class="token-box">
                            {{ session('reset_link') }}
                            <button 
                                type="button"
                                class="copy-btn float-end"
                                onclick="copyToClipboard('{{ session('reset_link') }}')">
                                <i class="fas fa-copy me-1"></i>Copy
                            </button>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ session('reset_link') }}" class="btn btn-reset">
                            <i class="fas fa-external-link-alt me-2"></i>
                            Buka Link Reset
                        </a>
                    </div>
                @endif
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control with-icon"
                            id="username"
                            name="username"
                            placeholder="Masukkan username Anda"
                            value="{{ old('username') }}"
                            required>
                    </div>
                    <small class="text-muted">
                        Masukkan username yang terdaftar
                    </small>
                </div>

                <button type="submit" class="btn btn-reset">
                    <i class="fas fa-paper-plane me-2"></i>
                    Kirim Link Reset
                </button>

                <div class="login-link">
                    <p>
                        Ingat password?
                        <a href="{{ route('login') }}">Login disini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link berhasil disalin ke clipboard!');
            }, function(err) {
                console.error('Gagal menyalin: ', err);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            
            if (!username) {
                e.preventDefault();
                alert('Harap masukkan username');
            }
        });
    </script>
</body>
</html>