<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/daur.png") }}" />
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0f4c3a 0%, #1a7a5e 50%, #2d8f6f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Background animation */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 20% 50%, rgba(45, 143, 111, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(26, 122, 94, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(15, 76, 58, 0.3) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translate(-50px, -50px) rotate(0deg); }
            50% { transform: translate(50px, 50px) rotate(180deg); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(45, 143, 111, 0.2);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(45, 143, 111, 0.1), transparent);
            animation: shine 3s infinite;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2d8f6f, #1a7a5e);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(45, 143, 111, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); box-shadow: 0 10px 30px rgba(45, 143, 111, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(45, 143, 111, 0.4); }
        }

        .welcome-text {
            color: #2d8f6f;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .form-input {
            width: 100%;
            padding: 1rem 3rem 1rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            background: #fafbfc;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .form-input:focus {
            border-color: #2d8f6f;
            background: white;
            box-shadow: 0 0 0 4px rgba(45, 143, 111, 0.1);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #999;
            transition: opacity 0.3s ease;
        }

        .form-input:focus::placeholder {
            opacity: 0.5;
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: #2d8f6f;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 2rem;
        }

        .forgot-password a {
            color: #2d8f6f;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #1a7a5e;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #2d8f6f, #1a7a5e);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(45, 143, 111, 0.4);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
            color: #999;
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e1e5e9, transparent);
        }

        .divider span {
            background: white;
            padding: 0 1rem;
        }

        .signup-link {
            text-align: center;
            color: #666;
            font-size: 0.95rem;
        }

        .signup-link a {
            color: #2d8f6f;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #1a7a5e;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }

            .welcome-text {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">

            {{-- <div class="logo-circle">   </div> --}}
            <h1 class="welcome-text">Selamat Datang</h1>
            <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="form-group">
                <div class="input-wrapper">
                    <input type="email" name="email" class="form-input" placeholder="Masukkan email Anda" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <input type="password" name="password" class="form-input" placeholder="Masukkan password Anda" required>
                </div>
            </div>

            @if ($errors->any())
                <div style="color:red; margin-bottom: 1rem;">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif

            <button type="submit" class="login-btn">Masuk Sekarang</button>
        </form>


        {{-- <div class="divider">
            <span>atau</span>
        </div>

        <div class="signup-link">
            Belum punya akun? <a href="#" onclick="showAlert('Halaman daftar')">Daftar sekarang</a>
        </div> --}}
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = this.querySelector('input[type="email"]').value;
            const password = this.querySelector('input[type="password"]').value;

            if (email && password) {
                showAlert(`Login berhasil untuk email: ${email}`);
            } else {
                showAlert('Mohon lengkapi semua field!');
            }
        });

        function showAlert(message) {
            alert(message);
        }

        // Add floating animation to inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>