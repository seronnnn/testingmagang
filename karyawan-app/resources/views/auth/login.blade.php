<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Karyawan App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f, #2c5282, #4299e1);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .login-header {
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            padding: 40px;
            text-align: center;
        }
        .login-body { padding: 40px; }
        .btn-login { background: linear-gradient(135deg, #1e3a5f, #2c5282); border: none; }
        .btn-login:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card">
                <div class="login-header">
                    <i class="bi bi-people-fill text-white" style="font-size:3rem"></i>
                    <h4 class="text-white mt-2 mb-0">Karyawan App</h4>
                    <p class="text-white-50 mb-0">Sistem Manajemen Karyawan</p>
                </div>
                <div class="login-body">
                    <h5 class="mb-4 fw-bold text-center">Masuk ke Akun Anda</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="passwordInput"
                                    class="form-control" placeholder="Masukkan password" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword()">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-login w-100 py-2 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>
                    </form>

                    <div class="mt-4 p-3 bg-light rounded">
                        <small class="text-muted d-block mb-1"><strong>Demo akun:</strong></small>
                        <small class="text-muted d-block">👑 Admin: admin@karyawan.com / password</small>
                        <small class="text-muted d-block">👤 Member: member@karyawan.com / password</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
</body>
</html>