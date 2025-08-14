<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Ruang Meeting - Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-bg: #1a1d29;
        --card-bg: rgba(255, 255, 255, 0.95);
        --text-light: #6c757d;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background: rgba(26, 29, 41, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: #fff !important;
        text-decoration: none;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8) !important;
        margin: 0 10px;
        padding: 8px 16px !important;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff !important;
        transform: translateY(-2px);
    }

    .container {
        max-width: 1200px;
    }

    .hero-section {
        text-align: center;
        padding: 3rem 0;
        color: white;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 2rem;
        margin: 1rem 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
    }

    .icon-reservations {
        background: var(--primary-gradient);
    }

    .icon-rooms {
        background: var(--secondary-gradient);
    }

    .icon-users {
        background: var(--success-gradient);
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        color: var(--text-light);
        font-weight: 500;
    }

    .feature-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 2rem;
        margin: 1rem 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        text-align: center;
    }

    .feature-card:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin: 0 auto 1.5rem;
    }

    .btn-modern {
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-modern {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary-modern {
        background: var(--secondary-gradient);
        color: white;
    }

    .btn-secondary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
    }

    footer {
        background: rgba(26, 29, 41, 0.95) !important;
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.8);
        margin-top: 25rem !important;
    }

    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-element {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
        top: 20%;
        left: 10%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        top: 60%;
        right: 10%;
        width: 80px;
        height: 80px;
        animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
        bottom: 20%;
        left: 20%;
        width: 40px;
        height: 40px;
        animation-delay: 4s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .quick-actions {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .quick-action-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        margin: 10px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .quick-action-btn:hover {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .stats-card,
        .feature-card {
            margin: 0.5rem 0;
        }
    }
    </style>

    @yield('styles')
</head>

<body>
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark px-4 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-building me-2"></i>MeetingRoom
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('rooms.index') }}" class="nav-link">
                            <i class="fa fa-door-open me-2"></i> Ruangan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservasi.index') }}" class="nav-link">
                            <i class="fa fa-door-open me-2"></i> Reservasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <i class="fa fa-door-open me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link"
                                style="padding: 0; border: none; background: none;">
                                <i class="fas fa-chart-bar me-1"></i>Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 100px;">
        @yield('content')
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions d-none d-md-block">
        <button class="quick-action-btn" style="background: var(--primary-gradient);" title="Buat Reservasi Cepat">
            <i class="fas fa-plus"></i>
        </button>
        <button class="quick-action-btn" style="background: var(--secondary-gradient);" title="Bantuan">
            <i class="fas fa-question"></i>
        </button>
    </div>

    <footer class="text-center py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start">
                    <small>&copy; 2024 Reservasi Ruang Meeting. All rights reserved.</small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <a href="#" class="text-decoration-none me-3" style="color: rgba(255,255,255,0.8);">Privacy
                            Policy</a>
                        <a href="#" class="text-decoration-none" style="color: rgba(255,255,255,0.8);">Terms of
                            Service</a>
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
    // Add smooth scrolling and interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats numbers on scroll
        const statsNumbers = document.querySelectorAll('.stats-number');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.textContent);
                    animateNumber(entry.target, target);
                }
            });
        });

        statsNumbers.forEach(num => observer.observe(num));

        function animateNumber(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 30);
        }

        // Add click effects to cards
        document.querySelectorAll('.stats-card, .feature-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-5px)';
                }, 100);
            });
        });

        // Quick action button effects
        document.querySelectorAll('.quick-action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Add ripple effect
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255,255,255,0.5);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: 100px;
                        height: 100px;
                        left: 50%;
                        top: 50%;
                        margin-left: -50px;
                        margin-top: -50px;
                    `;
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
    document.head.appendChild(style);
    </script>
    @yield('scripts')
</body>


</html>