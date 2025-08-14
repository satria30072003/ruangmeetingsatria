<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register - MeetingRoom</title>
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
        overflow-x: hidden;
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
        width: 120px;
        height: 120px;
        top: 15%;
        left: 15%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 180px;
        height: 180px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 90px;
        height: 90px;
        bottom: 15%;
        left: 60%;
        animation-delay: 4s;
    }

    .shape:nth-child(4) {
        width: 70px;
        height: 70px;
        top: 40%;
        right: 40%;
        animation-delay: 6s;
    }

    .shape:nth-child(5) {
        width: 110px;
        height: 110px;
        top: 5%;
        right: 5%;
        animation-delay: 1s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.7;
        }

        50% {
            transform: translateY(-40px) rotate(180deg);
            opacity: 1;
        }
    }

    /* Main Container */
    .register-container {
        position: relative;
        z-index: 10;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 50px 40px;
        width: 100%;
        max-width: 500px;
        animation: slideUp 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .register-card::before {
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
    .register-header {
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
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-10px) rotate(5deg);
        }
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .register-subtitle {
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

    /* Password Strength Indicator */
    .password-strength {
        margin-top: 8px;
        display: none;
    }

    .strength-bar {
        height: 4px;
        border-radius: 2px;
        background: #e2e8f0;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .strength-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-weak {
        background: #f56565;
    }

    .strength-medium {
        background: #ed8936;
    }

    .strength-strong {
        background: #48bb78;
    }

    .strength-text {
        font-size: 12px;
        color: #718096;
    }

    /* Submit Button */
    .btn-register {
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

    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    }

    .btn-register:active {
        transform: translateY(-1px);
    }

    .btn-register::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-register:hover::before {
        left: 100%;
    }

    /* Links */
    .register-links {
        text-align: center;
        margin-top: 30px;
    }

    .register-links a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .register-links a:hover {
        color: #764ba2;
        transform: translateY(-1px);
    }

    .register-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .register-links a:hover::after {
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

    /* Error Messages */
    .error-message {
        color: #f56565;
        font-size: 12px;
        margin-top: 5px;
        animation: errorSlide 0.3s ease-out;
    }

    @keyframes errorSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading State */
    .btn-register:disabled {
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

    .form-control.is-valid {
        border-color: #48bb78;
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

    /* Progress Steps */
    .form-progress {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .progress-step {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #e2e8f0;
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .progress-step.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        transform: scale(1.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .register-card {
            padding: 40px 30px;
            margin: 20px;
        }

        .register-title {
            font-size: 1.8rem;
        }

        .shape {
            display: none;
        }
    }

    /* Terms and Conditions */
    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        margin: 20px 0;
        gap: 10px;
    }

    .terms-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        accent-color: #667eea;
        flex-shrink: 0;
    }

    .terms-checkbox label {
        color: #4a5568;
        font-size: 14px;
        cursor: pointer;
        user-select: none;
        line-height: 1.4;
    }

    .terms-checkbox a {
        color: #667eea;
        text-decoration: none;
    }

    .terms-checkbox a:hover {
        text-decoration: underline;
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
            <div class="shape"></div>
        </div>
    </div>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="register-title">Join Us Today</h1>
                <p class="register-subtitle">Buat akun baru untuk memulai</p>
            </div>

            <div class="form-progress">
                <div class="progress-step active"></div>
                <div class="progress-step" id="step2"></div>
                <div class="progress-step" id="step3"></div>
                <div class="progress-step" id="step4"></div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="position-relative">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Masukkan nama lengkap" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan alamat email" required value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Buat kata sandi yang kuat" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Kekuatan kata sandi</div>
                    </div>
                    @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Ulangi kata sandi" required>
                        <i class="fas fa-eye password-toggle" id="togglePasswordConfirm"></i>
                    </div>
                    <div class="error-message" id="passwordMismatch" style="display: none;">
                        <i class="fas fa-exclamation-triangle me-1"></i>Kata sandi tidak cocok
                    </div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        Saya setuju dengan <a href="#" target="_blank">Syarat & Ketentuan</a>
                        dan <a href="#" target="_blank">Kebijakan Privasi</a>
                    </label>
                </div>

                <button type="submit" class="btn-register" id="registerBtn">
                    <span class="btn-text">Daftar Sekarang</span>
                </button>
            </form>

            <div class="register-links">
                <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const toggles = [{
                toggle: 'togglePassword',
                field: 'password'
            },
            {
                toggle: 'togglePasswordConfirm',
                field: 'password_confirmation'
            }
        ];

        toggles.forEach(item => {
            const toggle = document.getElementById(item.toggle);
            const field = document.getElementById(item.field);

            toggle.addEventListener('click', function() {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);

                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Password strength checker
        const passwordField = document.getElementById('password');
        const strengthIndicator = document.getElementById('passwordStrength');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');

        passwordField.addEventListener('input', function() {
            const password = this.value;
            if (password.length > 0) {
                strengthIndicator.style.display = 'block';
                const strength = calculatePasswordStrength(password);
                updateStrengthIndicator(strength);
            } else {
                strengthIndicator.style.display = 'none';
            }
        });

        function calculatePasswordStrength(password) {
            let score = 0;
            let feedback = [];

            // Length check
            if (password.length >= 8) score += 25;
            else feedback.push('minimal 8 karakter');

            // Uppercase check
            if (/[A-Z]/.test(password)) score += 25;
            else feedback.push('huruf besar');

            // Lowercase check
            if (/[a-z]/.test(password)) score += 25;
            else feedback.push('huruf kecil');

            // Number or special char check
            if (/[0-9]/.test(password) || /[^A-Za-z0-9]/.test(password)) score += 25;
            else feedback.push('angka atau simbol');

            return {
                score,
                feedback
            };
        }

        function updateStrengthIndicator(strength) {
            const {
                score,
                feedback
            } = strength;

            strengthFill.style.width = score + '%';

            if (score < 50) {
                strengthFill.className = 'strength-fill strength-weak';
                strengthText.textContent = 'Lemah - Tambahkan: ' + feedback.join(', ');
            } else if (score < 75) {
                strengthFill.className = 'strength-fill strength-medium';
                strengthText.textContent = 'Sedang - Tambahkan: ' + feedback.join(', ');
            } else {
                strengthFill.className = 'strength-fill strength-strong';
                strengthText.textContent = 'Kuat - Kata sandi aman!';
            }
        }

        // Password confirmation validation
        const confirmField = document.getElementById('password_confirmation');
        const mismatchError = document.getElementById('passwordMismatch');

        confirmField.addEventListener('input', function() {
            if (this.value && passwordField.value !== this.value) {
                mismatchError.style.display = 'block';
                this.classList.add('is-invalid');
            } else {
                mismatchError.style.display = 'none';
                this.classList.remove('is-invalid');
                if (this.value) this.classList.add('is-valid');
            }
        });

        // Form progress indicator
        const inputs = document.querySelectorAll('input[required]');
        const progressSteps = document.querySelectorAll('.progress-step');

        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                updateProgress();
            });
        });

        function updateProgress() {
            let filledFields = 0;
            inputs.forEach(input => {
                if (input.value.trim() && input.checkValidity()) {
                    filledFields++;
                }
            });

            progressSteps.forEach((step, index) => {
                if (index < filledFields) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }

        // Form submission with loading state
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');
        const btnText = registerBtn.querySelector('.btn-text');

        registerForm.addEventListener('submit', function(e) {
            // Validate password match
            if (passwordField.value !== confirmField.value) {
                e.preventDefault();
                confirmField.classList.add('is-invalid');
                mismatchError.style.display = 'block';
                return;
            }

            registerBtn.disabled = true;
            btnText.innerHTML = '<span class="loading-spinner"></span>Sedang mendaftar...';

            // Re-enable button after 5 seconds if form hasn't been submitted
            setTimeout(() => {
                if (registerBtn.disabled) {
                    registerBtn.disabled = false;
                    btnText.innerHTML = 'Daftar Sekarang';
                }
            }, 5000);
        });

        // Input validation feedback
        const allInputs = document.querySelectorAll('.form-control');
        allInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value && !this.validity.valid) {
                    this.classList.add('is-invalid');
                } else if (this.value && this.validity.valid) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') && this.validity.valid) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

        // Enhanced focus effects
        allInputs.forEach(input => {
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

        // Add floating animation to logo on hover
        const logo = document.querySelector('.logo');
        logo.addEventListener('mouseenter', function() {
            this.style.animation = 'logoFloat 0.5s ease-in-out';
        });

        logo.addEventListener('animationend', function() {
            this.style.animation = 'logoFloat 3s ease-in-out infinite';
        });

        // Real-time email validation
        const emailField = document.getElementById('email');
        emailField.addEventListener('input', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                this.classList.add('is-invalid');
            } else if (email) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
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