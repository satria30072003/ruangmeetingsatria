<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomSpace - Kelola Ruangan dengan Mudah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.6;
        overflow-x: hidden;
        background: #0a0a0a;
    }

    /* Header */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .nav-links {
        display: flex;
        list-style: none;
        gap: 2rem;
        margin: 0;
    }

    .nav-links a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-links a:hover {
        color: #667eea;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .cta-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        color: white;
    }

    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffffff" stroke-width="0.1" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }

    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-element {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        animation: float 20s infinite linear;
    }

    .floating-element:nth-child(1) {
        width: 300px;
        height: 300px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
        width: 200px;
        height: 200px;
        top: 60%;
        right: 10%;
        animation-delay: -7s;
    }

    .floating-element:nth-child(3) {
        width: 150px;
        height: 150px;
        bottom: 20%;
        left: 20%;
        animation-delay: -14s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        25% {
            transform: translateY(-20px) rotate(90deg);
        }

        50% {
            transform: translateY(-40px) rotate(180deg);
        }

        75% {
            transform: translateY(-20px) rotate(270deg);
        }
    }

    .hero-content {
        text-align: center;
        max-width: 800px;
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .hero-content h1 {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, #667eea 50%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        animation: fadeInUp 1s ease 0.2s both;
    }

    .hero-content p {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        animation: fadeInUp 1s ease 0.4s both;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 1s ease 0.6s both;
    }

    .btn-primary-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-outline-hero {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-outline-hero:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        transform: translateY(-3px);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Features Section */
    .features {
        padding: 6rem 0;
        background: #fff;
        position: relative;
    }

    .features::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to bottom, #16213e, #fff);
    }

    .section-title {
        font-size: 3rem;
        font-weight: 800;
        text-align: center;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #333 0%, #667eea 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 1.2rem;
        text-align: center;
        color: #666;
        margin-bottom: 4rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .room-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
        height: 100%;
    }

    .room-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .room-card .card-img-top {
        height: 250px;
        object-fit: cover;
        border-radius: 0;
        transition: transform 0.3s ease;
    }

    .room-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .room-card .card-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .room-card .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .room-card .card-text {
        color: #666;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        line-height: 1.8;
    }

    .room-card .card-text i {
        color: #667eea;
        margin-right: 0.5rem;
        width: 20px;
    }

    .btn-book {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        margin-top: auto;
    }

    .btn-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Stats Section */
    .stats {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 4rem 0;
        color: white;
    }

    .stat-item {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        display: block;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Footer */
    .footer {
        background: #0a0a0a;
        color: #fff;
        padding: 3rem 0 1rem;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        text-align: center;
    }

    .footer-section h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 2rem;
        padding-top: 2rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Scroll Reveal */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease;
    }

    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav {
            padding: 1rem;
        }

        .nav-links {
            display: none;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-cta {
            flex-direction: column;
            align-items: center;
        }

        .section-title {
            font-size: 2rem;
        }
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="logo">RoomSpace</div>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#features">Ruangan</a></li>
                <li><a href="#stats">Statistik</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
            <a href="{{ route('login') }}" class="cta-button">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        <div class="hero-content">
            <h1>Selamat datang di RoomSpace</h1>
            <p>Temukan ruangan yang sempurna untuk kebutuhan meeting, workshop, atau acara Anda</p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats" id="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item scroll-reveal">
                        <span class="stat-number" data-count="150">0</span>
                        <span class="stat-label">Ruangan Tersedia</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item scroll-reveal">
                        <span class="stat-number" data-count="2500">0</span>
                        <span class="stat-label">Reservasi Berhasil</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item scroll-reveal">
                        <span class="stat-number" data-count="98">0</span>
                        <span class="stat-label">% Kepuasan User</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item scroll-reveal">
                        <span class="stat-number" data-count="24">0</span>
                        <span class="stat-label">Jam Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title scroll-reveal">Pilih Ruangan Impian Anda</h2>
            <p class="section-subtitle scroll-reveal">Temukan ruangan yang sempurna untuk kebutuhan
                meeting, workshop,
                atau acara Anda dengan fasilitas terlengkap</p>

            <div class="row">
                @foreach($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card room-card scroll-reveal">
                        @if($room->images->first())
                        <img src="{{ asset('uploads/' . $room->images->first()->image_path) }}" class="card-img-top"
                            alt="{{ $room->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt"></i> {{ $room->location }}<br>
                                <i class="fas fa-users"></i> Kapasitas: {{ $room->capacity }} orang<br>
                                <i class="fas fa-info-circle"></i> Deskripsi: {{ $room->description }}<br>
                            <div class="mt-3">
                                @if ($room->status == 1)
                                <i class="fas fa-toggle-on text-success"></i> Status: Tersedia
                                @else
                                <i class="fas fa-toggle-off text-danger"></i> Status: Tidak Tersedia
                                @endif
                            </div>
                            </p>
                            <a href="{{ route('reservasi.create', ['room_id' => $room->id]) }}" class="btn-book">
                                <i class="fas fa-calendar-plus"></i> Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-section">
                <h3>RoomSpace</h3>
                <p>Platform reservasi ruang meeting yang modern, fleksibel, dan mudah digunakan. Kelola
                    ruangan Anda
                    dengan teknologi terdepan.</p>

                <div class="mt-4">
                    <i class="fas fa-envelope"></i> info@roomspace.com<br>
                    <i class="fas fa-phone"></i> +62 812-3456-7890<br>
                    <i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} RoomSpace. All rights reserved. Made with <i class="fas fa-heart"
                style="color: #667eea;"></i> in Indonesia
        </div>
    </footer>

    <script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 100) {
            header.style.background = 'rgba(10, 10, 10, 0.98)';
            header.style.backdropFilter = 'blur(20px)';
        } else {
            header.style.background = 'rgba(10, 10, 10, 0.95)';
        }
    });

    // Reveal animation
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

    // Counter animation
    const counters = document.querySelectorAll('.stat-number');
    const animateCounters = () => {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const count = parseInt(counter.innerText);
            const increment = target / 100;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(animateCounters, 20);
            } else {
                counter.innerText = target;
            }
        });
    };

    // Start counter animation when stats section is visible
    const statsSection = document.querySelector('.stats');
    if (statsSection) {
        const statsObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });
        statsObserver.observe(statsSection);
    }

    // Floating element parallax
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        document.querySelectorAll('.floating-element').forEach((el, index) => {
            const speed = 0.5 + (index * 0.1);
            el.style.transform =
                `translateY(${scrolled * -speed}px) rotate(${scrolled * 0.05}deg)`;
        });
    });

    // Add some interactive effects
    document.querySelectorAll('.room-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    </script>
</body>

</html>