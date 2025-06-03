<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/img/daur.png") }}" />
    <title>DLHKP - Kota Kediri</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* Styling Peta */
#map {
    height: 600px;
}

.info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: rgba(255,255,255,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    border-radius: 5px;
}
.info h4 {
    margin: 0 0 5px;
    color: #777;
}

/* LEGEND untuk peta */
.map-legend {
    line-height: 18px;
    color: #555;
}
.map-legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.7;
}

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
            min-height: 100vh;
            color: #2e7d32;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            border-radius: 12px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.1);
            border-left: 4px solid #4caf50;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }


        .logo-icon {
            width: 130px;
            height: 40px;
            background: #4caf50;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #2e7d32;
        }

        .tagline {
            font-size: 12px;
            color: #66bb6a;
            margin-top: 2px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-link {
            color: #4caf50;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 14px;
            position: relative;
        }

        .nav-link:hover {
            background: #4caf50;
            color: white;
            transform: translateY(-1px);
        }

        .nav-link.active {
            background: #2e7d32;
            color: white;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #4caf50;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active::after {
            width: 100%;
            background: #2e7d32;
        }

        .main-content {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.1);
        }

        .page-content {
            display: none;
        }

        .page-content.active {
            display: block;
        }

        .hero-section {
            text-align: center;
            padding: 40px 0;
            background: linear-gradient(135deg, #f1f8e9, #e8f5e8);
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .hero-title {
            font-size: 32px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 15px;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #4caf50;
            margin-bottom: 20px;
        }

        .hero-description {
            font-size: 16px;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .feature-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.1);
            border-left: 4px solid #4caf50;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: #4caf50;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .feature-description {
            color: #666;
            line-height: 1.5;
        }

        .content-section {
            margin: 30px 0;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e8f5e8;
        }

        .section-content {
            color: #666;
            line-height: 1.6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .info-card {
            background: #f1f8e9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #4caf50;
        }

        .info-title {
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .contact-form {
            background: #f1f8e9;
            padding: 30px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2e7d32;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #c8e6c9;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #4caf50;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-button {
            background: #4caf50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-button:hover {
            background: #2e7d32;
        }

        .regulation-list {
            list-style: none;
            padding: 0;
        }

        .regulation-item {
            background: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(46, 125, 50, 0.1);
            border-left: 4px solid #4caf50;
        }

        .regulation-title {
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 5px;
        }

        .regulation-description {
            color: #666;
            font-size: 14px;
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .facility-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.1);
            border-top: 4px solid #4caf50;
        }

        .facility-image {
    margin-top: 10px;
}

.facility-img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

        .facility-name {
            font-size: 18px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .facility-type {
            background: #e8f5e8;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 10px;
        }

        .facility-info {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .page-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f1f8e9;
            border-radius: 8px;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .control-label {
            font-weight: 600;
            color: #2e7d32;
            font-size: 14px;
        }

        .control-select {
            padding: 10px 12px;
            border: 2px solid #c8e6c9;
            border-radius: 6px;
            font-size: 14px;
            background: white;
            color: #2e7d32;
            transition: border-color 0.3s ease;
        }

        .control-select:focus {
            outline: none;
            border-color: #4caf50;
        }

        .chart-section {
            margin-top: 30px;
        }

        .chart-title {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #2e7d32;
            margin-bottom: 20px;
            padding: 15px;
            background: #f1f8e9;
            border-radius: 8px;
        }

        .chart-container {
            position: relative;
            height: 400px;
            background: white;
            justify-content: center;
        align-items: center;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(46, 125, 50, 0.1);
            margin-bottom: 20px;
        }

        .legend {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: #f1f8e9;
            border-radius: 6px;
            font-size: 14px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-text {
            color: #2e7d32;
            font-weight: 500;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .stat-card {
            background: #4caf50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .main-content {
                padding: 20px;
            }

            .nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .chart-container {
                height: 300px;
                padding: 15px;
            }

            .page-title {
                font-size: 24px;
            }
        }

        .loading {
            display: none;
            text-align: center;
            padding: 30px;
            color: #4caf50;
        }

        .spinner {
            border: 2px solid #c8e6c9;
            border-top: 2px solid #4caf50;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <nav class="nav">
                <div class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" class="logo-icon" alt="Logo SIPSN">

                </div>
                <div class="nav-links">
                    <a href="#" class="nav-link active" data-page="beranda">Beranda</a>
                    <a href="#" class="nav-link" data-page="data-sampah">Data Sampah</a>
                    <a href="#" class="nav-link" data-page="peta">Peta</a>
                    <a href="#" class="nav-link" data-page="fasilitas">Fasilitas</a>
                    <a href="#" class="nav-link" data-page="kontak">Kontak</a>
                    <a href="{{ url('/login') }}" class="nav-link">Login</a>
                </div>
            </nav>
        </header>

        <main class="main-content">
            <!-- Halaman Beranda -->
            <div id="beranda" class="page-content active">
                <div class="hero-section">
                    <h1 class="hero-title">Selamat Datang</h1>
                    <p class="hero-subtitle">Sistem Informasi Pengelolaan Sampah Kota Kediri</p>
                    <p class="hero-description">Platform terintegrasi untuk monitoring dan pengelolaan data sampah di seluruh kota kediri. Berkomitmen untuk Indonesia yang lebih bersih dan berkelanjutan melalui pengelolaan sampah yang efektif.</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3 class="feature-title">Data Komprehensif</h3>
                        <p class="feature-description">Akses data lengkap komposisi sampah dari berbagai daerah di Indonesia dengan visualisasi yang mudah dipahami.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📋</div>
                        <h3 class="feature-title">Regulasi Terkini</h3>
                        <p class="feature-description">Informasi terbaru mengenai peraturan dan kebijakan pengelolaan sampah nasional dan daerah.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🏭</div>
                        <h3 class="feature-title">Peta Fasilitas</h3>
                        <p class="feature-description">Lokasi dan informasi fasilitas pengelolaan sampah seperti TPA, TPS, dan bank sampah di seluruh Indonesia.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🤝</div>
                        <h3 class="feature-title">Kolaborasi</h3>
                        <p class="feature-description">Platform untuk berkolaborasi dengan stakeholder dalam upaya pengelolaan sampah yang lebih baik.</p>
                    </div>
                </div>
            </div>

            <!-- Halaman Data Sampah -->
            <div id="data-sampah" class="page-content">
                <h1 class="page-title">Reduksi Sampah</h1>

                <div class="controls">
                    <div class="control-group">
                        <label class="control-label">Tahun</label>
                        <select class="control-select" id="yearSelect" onchange="applyFilters()">
                            <option value="2025" {{ $tahun == 2025 ? 'selected' : '' }}>2025</option>
                            <option value="2024" {{ $tahun == 2024 ? 'selected' : '' }}>2024</option>
                            <option value="2023" {{ $tahun == 2023 ? 'selected' : '' }}>2023</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="control-label">TPS</label>
                        <select class="control-select" id="tpsSelect" onchange="applyFilters()">
                            <option value="">Semua TPS</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->name }}" {{ $tps == $location->name ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Memuat data...</p>
                </div>

                <div class="chart-section">
                    <h2 class="chart-title">Reduksi Sampah Berdasarkan TPS</h2>

                    {{-- <div class="chart-container">
                        <canvas id="wasteChart"></canvas>
                    </div> --}}
                    <div class="chart-container">
                        <canvas id="wasteChart"></canvas>
                    </div>
                    <div class="chart-container">

                    </div>

                    <div class="legend" id="chartLegend"></div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value" id="totalWaste">100%</div>
                            <div class="stat-label">Total Sampah</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value" id="organicWaste">57.8%</div>
                            <div class="stat-label">Sampah Organik</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value" id="plasticWaste">17.4%</div>
                            <div class="stat-label">Sampah Plastik</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value" id="paperWaste">10.7%</div>
                            <div class="stat-label">Sampah Kertas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Halaman Regulasi -->
            <div id="peta" class="page-content">
                <h1 class="page-title">Peta Tempat Pembuangan Sampah</h1>

                <div class="content-section">
                    <h2 class="section-title">Tempat Pembuangan Sampah</h2>
                    <ul class="regulation-list">
                        <div class="card-body">

                        <div id="map"></div>
                        <!-- Make sure you put this AFTER Leaflet's CSS -->
                        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                        </div>

                    </ul>
                </div>


            </div>

            <!-- Halaman Fasilitas -->
            <div id="fasilitas" class="page-content">
                <h1 class="page-title">Fasilitas Pengelolaan Sampah</h1>

                <div class="content-section">
                    <h2 class="section-title">Jenis Fasilitas</h2>
                    <div class="facility-grid">
                        @foreach ($spt as $tp)
                            <div class="facility-card">
                                <h3 class="facility-name">{{ $tp->location->name }}</h3>
                                <span class="facility-type">Tempat Pengumpulan Sampah</span>
                                <div class="facility-info">
                                    <p><strong>Jam Operasional:</strong> {{ $tp->jam_operasional }}</p>
                                    <p><strong>Kapasitas:</strong> {{ $tp->kapasitas_tps }} ton/hari</p>
                                    <p><strong>Fasilitas:</strong> {{ $tp->fasilitas }}</p>
                                    <p><strong>Foto Lokasi:</strong> </p>
                                </div>

                                @if($tp->foto_lokasi)
                                <div class="facility-image">
                                    <img src="{{ asset('storage/' . $tp->foto_lokasi) }}" class="img-thumbnail facility-img">
                                </div>
                            @endif

                            </div>
                        @endforeach
                    </div>


                </div>

                <div class="content-section">
                    <h2 class="section-title">Statistik Fasilitas</h2>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">1,247</div>
                            <div class="stat-label">Total TPA/TPS</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">8,935</div>
                            <div class="stat-label">Bank Sampah</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">156</div>
                            <div class="stat-label">Fasilitas Pengolahan</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">89</div>
                            <div class="stat-label">TPST Regional</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Halaman Kontak -->
            <div id="kontak" class="page-content">
                <h1 class="page-title">Hubungi Kami</h1>

                <div class="content-section">
                    <h2 class="section-title">Informasi Kontak</h2>
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-title">Alamat Kantor</div>
                            <p>Kementerian Lingkungan Hidup dan Kehutanan<br>
                            Gedung Manggala Wanabakti Blok VII Lantai 6<br>
                            Jl. Gatot Subroto, Jakarta Pusat 10270</p>
                        </div>
                        <div class="info-card">
                            <div class="info-title">Kontak</div>
                            <p><strong>Telepon:</strong> (021) 5720227<br>
                            <strong>Email:</strong> info@sipsn.menlhk.go.id<br>
                            <strong>Website:</strong> www.sipsn.menlhk.go.id</p>
                        </div>
                        <div class="info-card">
                            <div class="info-title">Jam Operasional</div>
                            <p><strong>Senin - Jumat:</strong> 08:00 - 16:00 WIB<br>
                            <strong>Sabtu - Minggu:</strong> Tutup<br>
                            <strong>Layanan Online:</strong> 24/7</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h2 class="section-title">Kirim Pesan</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-input" id="fullName" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" id="email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Institusi/Organisasi</label>
                            <input type="text" class="form-input" id="organization">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subjek</label>
                            <input type="text" class="form-input" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pesan</label>
                            <textarea class="form-textarea" id="message" required></textarea>
                        </div>
                        <button type="submit" class="form-button">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data dan variabel global
const labels = @json($reduksiData->pluck('name'));
const values = @json($reduksiData->pluck('reduksi_kg'));
const colors = generateGreenColors(labels.length);

let chart; // Variabel global untuk chart
let map; // Variabel global untuk map

// Inisialisasi chart
function initChart() {
    const ctx = document.getElementById('wasteChart');
    if (ctx) {
        chart = new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' kg';
                            }
                        }
                    }
                },
                elements: {
                    arc: {
                        cutout: '50%'
                    }
                }
            }
        });
    }
}

// Inisialisasi peta
function initMap() {
    const mapContainer = document.getElementById('map');
    if (mapContainer && typeof L !== 'undefined') {
        // Hapus map yang sudah ada jika ada
        if (map) {
            map.remove();
        }

        // Inisialisasi peta baru-7.8274268,112.0290482
        map = L.map('map').setView([-7.8274268, 112.0290482], 12.5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Tampilkan marker dari database
        @foreach ($locations as $location)
        var marker = L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map);
        marker.bindTooltip(
            "{{ $location->name ?: 'Lokasi Tanpa Nama' }}",
            { permanent: true, direction: 'top', className: 'my-labels' }
        );
        marker.bindPopup(`
            <div class="p-2">
                <h5>{{ $location->name ?: 'Lokasi Tanpa Nama' }}</h5>
                <div class="text-muted small">
                    Latitude: {{ $location->latitude }}<br>
                    Longitude: {{ $location->longitude }}
                </div>
                <div class="text-muted small">
                    @if($location->tps && $location->tps->foto_lokasi)
                        <img src="{{ asset('storage/' . $location->tps->foto_lokasi) }}" class="img-thumbnail" style="width: 80px;">
                    @else
                        <span>Tidak ada foto</span>
                    @endif
                </div>
                <div class="mt-1 small">
                    <i class="bx bx-calendar"></i> {{ $location->created_at->format('d M Y') }}
                </div>
            </div>
        `);
        @endforeach

        // Jika ada lokasi, set view ke lokasi pertama
        @if ($locations->isNotEmpty())
            map.setView([{{ $locations[5]->latitude }}, {{ $locations[5]->longitude }}], 13);
        @endif

        // Refresh ukuran map setelah container terlihat
        setTimeout(() => {
            if (map) {
                map.invalidateSize();
            }
        }, 250);
    }
}

// Generate warna hijau
function generateGreenColors(count) {
    const colors = [];
    for (let i = 0; i < count; i++) {
        const hue = Math.floor(Math.random() * 60) + 90;
        const saturation = Math.floor(Math.random() * 30) + 60;
        const lightness = Math.floor(Math.random() * 20) + 40;
        colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
    }
    return colors;
}

// Update legend
function updateLegend() {
    const legendContainer = document.getElementById('chartLegend');
    if (legendContainer && labels && values) {
        legendContainer.innerHTML = '';
        labels.forEach((label, index) => {
            const legendItem = document.createElement('div');
            legendItem.className = 'legend-item';
            legendItem.innerHTML = `
                <div class="legend-color" style="background-color: ${colors[index]}"></div>
                <span class="legend-label">${label}: ${values[index]} kg</span>
            `;
            legendContainer.appendChild(legendItem);
        });
    }
}

// Filter data
function applyFilters() {
    const year = document.getElementById('yearSelect').value;
    const tps = document.getElementById('tpsSelect').value;
    let url = `?tahun=${year}`;
    if (tps !== '') {
        url += `&tps=${encodeURIComponent(tps)}`;
    }
    // Tambahkan parameter page untuk mempertahankan halaman yang aktif
    url += `&page=data-sampah`;
    window.location.href = url;
}

// Update statistik
function updateStats() {
    // Hitung total dari data yang ada
    const total = values.reduce((sum, val) => sum + parseFloat(val), 0);

    // Update total waste
    const totalWasteElement = document.getElementById('totalWaste');
    if (totalWasteElement) {
        totalWasteElement.textContent = total.toFixed(1) + ' kg';
    }

    // Untuk statistik lainnya, kita bisa menghitung persentase
    // atau menggunakan data statis jika tidak ada data spesifik
    const organicWasteElement = document.getElementById('organicWaste');
    const plasticWasteElement = document.getElementById('plasticWaste');
    const paperWasteElement = document.getElementById('paperWaste');

    if (organicWasteElement) organicWasteElement.textContent = '57.8%';
    if (plasticWasteElement) plasticWasteElement.textContent = '17.4%';
    if (paperWasteElement) paperWasteElement.textContent = '10.7%';
}

// Loading functions
function showLoading() {
    const loadingElement = document.getElementById('loading');
    const chartSection = document.querySelector('.chart-section');
    if (loadingElement) loadingElement.style.display = 'block';
    if (chartSection) chartSection.style.opacity = '0.5';
}

function hideLoading() {
    const loadingElement = document.getElementById('loading');
    const chartSection = document.querySelector('.chart-section');
    if (loadingElement) loadingElement.style.display = 'none';
    if (chartSection) chartSection.style.opacity = '1';
}

function updateData() {
    showLoading();
    setTimeout(() => {
        if (chart) {
            chart.update('active');
        }
        updateLegend();
        updateStats();
        hideLoading();
    }, 800);
}

// Fungsi untuk mengupdate URL
function updateUrl(pageId) {
    const url = new URL(window.location);

    if (pageId === 'beranda') {
        // Untuk halaman beranda, hapus semua parameter
        url.search = '';
    } else {
        // Untuk halaman lain, set parameter page
        url.searchParams.set('page', pageId);

        // Hapus parameter yang tidak relevan untuk halaman selain data-sampah
        if (pageId !== 'data-sampah') {
            url.searchParams.delete('tahun');
            url.searchParams.delete('tps');
        }
    }

    // Update URL tanpa reload halaman
    window.history.pushState({}, '', url);
}

// Fungsi untuk mendapatkan parameter URL
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

// Inisialisasi halaman dan navigasi
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menampilkan halaman tertentu
    function showPage(pageId) {
        // Sembunyikan semua halaman
        document.querySelectorAll('.page-content').forEach(page => {
            page.classList.remove('active');
        });

        // Tampilkan halaman yang dipilih
        const targetPage = document.getElementById(pageId);
        if (targetPage) {
            targetPage.classList.add('active');
        }

        // Update status aktif di navbar
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            if(link.getAttribute('data-page') === pageId) {
                link.classList.add('active');
            }
        });

        // Inisialisasi komponen berdasarkan halaman yang aktif
        setTimeout(() => {
            if (pageId === 'data-sampah') {
                // Inisialisasi chart untuk halaman data-sampah
                if (document.getElementById('wasteChart')) {
                    initChart();
                    updateLegend();
                    updateStats();
                }
            } else if (pageId === 'peta' || pageId === 'lokasi') {
                // Inisialisasi map untuk halaman peta/lokasi
                if (document.getElementById('map')) {
                    initMap();
                }
            }
        }, 100);
    }

    // Event listener untuk navigasi
    document.querySelectorAll('.nav-link[data-page]').forEach(link => {
        link.addEventListener('click', function(e) {
            // Abaikan link login
            if(this.getAttribute('href') !== '{{ url("/login") }}') {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                showPage(page);
                updateUrl(page);
            }
        });
    });

    // Cek apakah ada parameter page dari URL
    const pageParam = getUrlParameter('page');
    let initialPage = 'beranda'; // default page

    // Jika ada parameter page, gunakan itu
    if (pageParam && pageParam !== '') {
        initialPage = pageParam;
    }

    // Inisialisasi halaman
    showPage(initialPage);
});

// Contact form functionality
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = {
                name: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                organization: document.getElementById('organization').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };

            // Simulate form submission
            alert('Terima kasih! Pesan Anda telah dikirim. Tim kami akan segera menghubungi Anda.');

            // Reset form
            contactForm.reset();
        });
    }

    // Window resize handler untuk map
    window.addEventListener('resize', function() {
        if (map) {
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }
    });
});
        </script>


</body>
</html>