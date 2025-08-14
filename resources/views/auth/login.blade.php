<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - MeetingRoom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        overflow: hidden;
        position: relative;
    }

    /* Animated Background */
    .background-animation {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 8s ease-in-out infinite;
    }

    .shape:nth-child(1) {
        width: 150px;
        height: 150px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 200px;
        height: 200px;
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 10%;
        left: 50%;
        animation-delay: 4s;
    }

    .shape:nth-child(4) {
        width: 80px;
        height: 80px;
        top: 30%;
        right: 30%;
        animation-delay: 6s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.7;
        }

        50% {
            transform: translateY(-30px) rotate(180deg);
            opacity: 1;
        }
    }

    /* Main Container */
    .login-container {
        position: relative;
        z-index: 10;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 50px 40px;
        width: 100%;
        max-width: 450px;
        animation: slideUp 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 24px 24px 0 0;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Logo and Header */
    .login-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
        animation: logoFloat 3s ease-in-out infinite;
    }

    @keyframes logoFloat {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .login-subtitle {
        color: #718096;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 16px 20px 16px 50px;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #2d3748;
        outline: none;
        font-family: inherit;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: #cbd5e0;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 18px;
        transition: color 0.3s ease;
        z-index: 5;
    }

    .form-group:focus-within .input-icon {
        color: #667eea;
    }

    .form-group:focus-within .form-label {
        color: #667eea;
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        cursor: pointer;
        font-size: 18px;
        transition: color 0.3s ease;
        z-index: 5;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    /* Submit Button */
    .btn-login {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 10px;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-login:hover::before {
        left: 100%;
    }

    /* Links */
    .login-links {
        text-align: center;
        margin-top: 30px;
    }

    .login-links a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-links a:hover {
        color: #764ba2;
        transform: translateY(-1px);
    }

    .login-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .login-links a:hover::after {
        width: 100%;
    }

    /* Alerts */
    .alert {
        border-radius: 16px;
        border: none;
        padding: 16px 20px;
        margin-bottom: 25px;
        animation: alertSlide 0.5s ease-out;
    }

    @keyframes alertSlide {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .alert-success {
        background: linear-gradient(135deg, #48bb78, #38a169);
        color: white;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f56565, #e53e3e);
        color: white;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Loading State */
    .btn-login:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s linear infinite;
        margin-right: 10px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Form Validation */
    .form-control.is-invalid {
        border-color: #f56565;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            padding: 40px 30px;
            margin: 20px;
        }

        .login-title {
            font-size: 1.8rem;
        }

        .shape {
            display: none;
        }
    }

    /* Remember Me Checkbox */
    .remember-me {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        accent-color: #667eea;
    }

    .remember-me label {
        color: #4a5568;
        font-size: 14px;
        cursor: pointer;
        user-select: none;
    }

    /* Social Login Buttons */
    .social-login {
        margin-top: 25px;
        text-align: center;
    }

    .social-divider {
        position: relative;
        margin: 25px 0;
        text-align: center;
    }

    .social-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
    }

    .social-divider span {
        background: rgba(255, 255, 255, 0.95);
        padding: 0 20px;
        color: #718096;
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="background-animation">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-building"></i>
                </div>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Silakan masuk ke akun Anda</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Masukkan email Anda" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Masukkan kata sandi" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-text">Masuk</span>
                </button>
            </form>

            <div class="social-divider">
                <span>atau</span>
            </div>

            <div class="login-links">
                <p class="mb-2">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
                <p><a href="#" style="font-size: 14px;">Lupa kata sandi?</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form submission with loading state
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const btnText = loginBtn.querySelector('.btn-text');

        loginForm.addEventListener('submit', function(e) {
            loginBtn.disabled = true;
            btnText.innerHTML = '<span class="loading-spinner"></span>Sedang masuk...';

            // Re-enable button after 3 seconds if form hasn't been submitted
            setTimeout(() => {
                if (loginBtn.disabled) {
                    loginBtn.disabled = false;
                    btnText.innerHTML = 'Masuk';
                }
            }, 3000);
        });

        // Input validation feedback
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && !this.validity.valid) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') && this.validity.valid) {
                    this.classList.remove('is-invalid');
                }
            });
        });

        // Enhanced focus effects
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.style.animation = 'pulse 0.3s ease';
            });

            input.addEventListener('animationend', function() {
                this.parentElement.parentElement.style.animation = '';
            });
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.animation = 'alertSlide 0.5s ease-out reverse';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });

        // Keyboard navigation enhancement
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
                const nextInput = e.target.closest('.form-group')?.nextElementSibling?.querySelector(
                    '.form-control');
                if (nextInput) {
                    nextInput.focus();
                } else {
                    loginBtn.click();
                }
            }
        });

        // Add floating animation to logo on hover
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', function() {
            this.style.animation = 'logoFloat 0.5s ease-in-out';
        });

        logo.addEventListener('animationend', function() {
            this.style.animation = 'logoFloat 3s ease-in-out infinite';
        });
    });

    // Add pulse animation for form focus
    const style = document.createElement('style');
    style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.02); }
                100% { transform: scale(1); }
            }
        `;
    document.head.appendChild(style);
    </script>
</body>

</html>