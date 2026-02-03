<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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
        
        .alert {
            background-color: rgba(13, 39, 61, 0.1);
            border: 1px solid rgba(13, 39, 61, 0.2);
            color: var(--text-dark);
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 16px;
            font-size: 0.9rem;
        }
        
        .alert-error {
            background-color: rgba(198, 40, 40, 0.1);
            border-color: rgba(198, 40, 40, 0.3);
            color: var(--error-color);
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
                    <i class="fas fa-lock"></i>
                </div>
                <h3>Reset Password</h3>
                <p>Masukkan password baru Anda</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>            
                        <input type="text" class="form-control with-icon" id="username" name="username" value="{{ old('username') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control with-icon" id="password" name="password" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control with-icon" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-reset">
                    <i class="fas fa-save me-2"></i>Simpan Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>