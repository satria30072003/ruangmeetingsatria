@extends('layouts.app')

@section('content')
<div class="container-fluid py-5"
    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    <div class="container">
        {{-- Header Section --}}
        <div class="text-center mb-5">
            <div class="stats-header animate__animated animate__fadeInDown">
                <h1 class="display-4 fw-bold text-white mb-2">
                    📊 Statistik Penggunaan Ruangan
                </h1>
                <p class="lead text-white-50 mb-0">
                    {{ \Carbon\Carbon::now()->format('F Y') }}
                </p>
                <div class="header-decoration mt-3">
                    <div class="decoration-line"></div>
                </div>
            </div>
        </div>

        {{-- Main Chart Card --}}
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="chart-card animate__animated animate__fadeInUp">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-chart-bar me-2"></i>
                                    Grafik Penggunaan Ruangan
                                </h5>
                            </div>
                            <div class="col-auto">
                                <div class="chart-controls">
                                    <button class="btn btn-outline-primary btn-sm me-2" onclick="downloadChart()">
                                        <i class="fas fa-download me-1"></i>Download
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="refreshChart()">
                                        <i class="fas fa-sync-alt me-1"></i>Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="roomUsageChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Summary Cards --}}
        <div class="row mt-5" id="summaryCards">
            <!-- Cards will be generated dynamically -->
        </div>
    </div>
</div>

{{-- Hidden Data --}}
<input type="hidden" id="roomNames" value='@json($roomNames)'>
<input type="hidden" id="roomCounts" value='@json($roomCounts)'>
@endsection

@section('styles')
<style>
/* Import fonts and animations */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

/* Global Styles */
body {
    font-family: 'Poppins', sans-serif;
}

/* Header Styles */
.stats-header {
    position: relative;
    z-index: 2;
}

.header-decoration {
    display: flex;
    justify-content: center;
    align-items: center;
}

.decoration-line {
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, transparent, #fff, transparent);
    border-radius: 2px;
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    from {
        opacity: 0.5;
    }

    to {
        opacity: 1;
    }
}

/* Chart Card Styles */
.chart-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 1.5rem 2rem;
    border: none;
}

.card-title {
    font-weight: 600;
    font-size: 1.2rem;
}

.card-body {
    padding: 2rem;
}

/* Chart Container */
.chart-container {
    position: relative;
    height: 400px;
    background: rgba(248, 249, 250, 0.5);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
}

/* Button Styles */
.chart-controls .btn {
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.chart-controls .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

/* Summary Cards */
.summary-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.summary-icon {
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

.summary-number {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.summary-label {
    color: #6c757d;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chart-container {
        height: 300px;
        padding: 15px;
    }

    .card-header {
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .display-4 {
        font-size: 2rem;
    }

    .chart-controls {
        margin-top: 1rem;
    }
}

/* Loading Animation */
.chart-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    color: #6c757d;
}

.loading-spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #4facfe;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin-right: 1rem;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
// Get data from hidden inputs
const roomNames = JSON.parse(document.getElementById("roomNames").value);
const roomCounts = JSON.parse(document.getElementById("roomCounts").value);

// Generate beautiful colors
const generateColors = (count) => {
    const colors = [
        'rgba(78, 172, 254, 0.8)',
        'rgba(0, 242, 254, 0.8)',
        'rgba(255, 107, 107, 0.8)',
        'rgba(255, 205, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(199, 199, 199, 0.8)'
    ];

    const borderColors = colors.map(color => color.replace('0.8', '1'));

    return {
        background: colors.slice(0, count),
        border: borderColors.slice(0, count)
    };
};

const colors = generateColors(roomNames.length);

// Create Chart
const ctx = document.getElementById("roomUsageChart").getContext('2d');
const roomUsageChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: roomNames,
        datasets: [{
            label: 'Jumlah Penggunaan',
            data: roomCounts,
            backgroundColor: colors.background,
            borderColor: colors.border,
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: {
                        family: 'Poppins',
                        size: 14,
                        weight: '500'
                    },
                    color: '#2c3e50',
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: {
                    family: 'Poppins',
                    size: 14,
                    weight: '600'
                },
                bodyFont: {
                    family: 'Poppins',
                    size: 13
                },
                cornerRadius: 8,
                displayColors: true,
                callbacks: {
                    title: function(context) {
                        return 'Ruangan: ' + context[0].label;
                    },
                    label: function(context) {
                        return 'Penggunaan: ' + context.parsed.y + ' kali';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0,
                    font: {
                        family: 'Poppins',
                        size: 12
                    },
                    color: '#6c757d'
                },
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)',
                    drawBorder: false
                }
            },
            x: {
                ticks: {
                    font: {
                        family: 'Poppins',
                        size: 12,
                        weight: '500'
                    },
                    color: '#2c3e50',
                    maxRotation: 45
                },
                grid: {
                    display: false
                }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart'
        }
    }
});

// Generate Summary Cards
function generateSummaryCards() {
    const totalUsage = roomCounts.reduce((a, b) => a + b, 0);
    const avgUsage = Math.round(totalUsage / roomNames.length);
    const maxUsage = Math.max(...roomCounts);
    const mostUsedRoom = roomNames[roomCounts.indexOf(maxUsage)];

    const summaryData = [{
            icon: '📊',
            number: totalUsage,
            label: 'Total Penggunaan',
            color: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
        },
        {
            icon: '📈',
            number: avgUsage,
            label: 'Rata-rata Penggunaan',
            color: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'
        },
        {
            icon: '🏆',
            number: maxUsage,
            label: 'Penggunaan Tertinggi',
            color: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'
        },
        {
            icon: '🏢',
            number: roomNames.length,
            label: 'Total Ruangan',
            color: 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)'
        }
    ];

    const summaryContainer = document.getElementById('summaryCards');
    summaryContainer.innerHTML = '';

    summaryData.forEach((item, index) => {
        const cardHtml = `
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="summary-card animate__animated animate__fadeInUp" style="animation-delay: ${index * 0.1}s">
                    <div class="summary-icon" style="background: ${item.color}">
                        ${item.icon}
                    </div>
                    <div class="summary-number">${item.number}</div>
                    <div class="summary-label">${item.label}</div>
                </div>
            </div>
        `;
        summaryContainer.innerHTML += cardHtml;
    });
}

// Chart Functions
function downloadChart() {
    const link = document.createElement('a');
    link.download = `statistik-ruangan-${new Date().getTime()}.png`;
    link.href = roomUsageChart.toBase64Image();
    link.click();
}

function refreshChart() {
    roomUsageChart.update('active');

    // Add refresh animation
    const chartContainer = document.querySelector('.chart-container');
    chartContainer.style.opacity = '0.5';
    setTimeout(() => {
        chartContainer.style.opacity = '1';
    }, 300);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    generateSummaryCards();

    // Add entrance animations
    setTimeout(() => {
        document.querySelector('.chart-card').style.opacity = '1';
    }, 200);
});

// Add some interactive hover effects
document.addEventListener('mouseover', function(e) {
    if (e.target.closest('.summary-card')) {
        e.target.closest('.summary-card').style.transform = 'translateY(-8px) scale(1.02)';
    }
});

document.addEventListener('mouseout', function(e) {
    if (e.target.closest('.summary-card')) {
        e.target.closest('.summary-card').style.transform = 'translateY(0) scale(1)';
    }
});
</script>
@endsection