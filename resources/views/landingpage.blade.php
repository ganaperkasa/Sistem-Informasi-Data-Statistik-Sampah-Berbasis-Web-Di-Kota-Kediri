<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPSN - Komposisi Sampah</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
                    <a href="#beranda" class="nav-link" data-page="beranda">Beranda</a>
                    <a href="#data-sampah" class="nav-link " data-page="data-sampah">Data Sampah</a>
                    <a href="#regulasi" class="nav-link" data-page="regulasi">Regulasi</a>
                    <a href="#fasilitas" class="nav-link" data-page="fasilitas">Fasilitas</a>
                    <a href="#kontak" class="nav-link" data-page="kontak">Kontak</a>
                    <a href="{{ url('/login') }}" class="nav-link">Login</a>
                </div>
            </nav>
        </header>

        <main class="main-content">
            <!-- Halaman Beranda -->
            <div id="beranda" class="page-content">
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
            <div id="data-sampah" class="page-content active">
                <h1 class="page-title">Komposisi Sampah</h1>

                <div class="controls">
                    <div class="control-group">
                        <label class="control-label">Tahun</label>
                        <select class="control-select" id="yearSelect">
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Provinsi</label>
                        <select class="control-select" id="provinceSelect">
                            <option value="jawa-timur">Jawa Timur</option>
                            <option value="jakarta">DKI Jakarta</option>
                            <option value="jawa-barat">Jawa Barat</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Kabupaten/Kota</label>
                        <select class="control-select" id="citySelect">
                            <option value="">Pilih Kota</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="malang">Malang</option>
                            <option value="kediri">Kediri</option>
                        </select>
                    </div>
                </div>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Memuat data...</p>
                </div>

                <div class="chart-section">
                    <h2 class="chart-title">Komposisi Sampah Berdasarkan Jenis</h2>

                    <div class="chart-container">
                        <canvas id="wasteChart"></canvas>
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
            <div id="regulasi" class="page-content">
                <h1 class="page-title">Regulasi Pengelolaan Sampah</h1>

                <div class="content-section">
                    <h2 class="section-title">Peraturan Nasional</h2>
                    <ul class="regulation-list">
                        <li class="regulation-item">
                            <div class="regulation-title">UU No. 18 Tahun 2008</div>
                            <div class="regulation-description">Undang-Undang tentang Pengelolaan Sampah yang menjadi dasar hukum pengelolaan sampah di Indonesia.</div>
                        </li>
                        <li class="regulation-item">
                            <div class="regulation-title">PP No. 27 Tahun 2020</div>
                            <div class="regulation-description">Peraturan Pemerintah tentang Pengelolaan Sampah Spesifik, termasuk sampah elektronik dan B3.</div>
                        </li>
                        <li class="regulation-item">
                            <div class="regulation-title">Permen LHK No. 13 Tahun 2012</div>
                            <div class="regulation-description">Pedoman Pelaksanaan Reduce, Reuse, dan Recycle melalui Bank Sampah.</div>
                        </li>
                        <li class="regulation-item">
                            <div class="regulation-title">Permen LHK No. 75 Tahun 2019</div>
                            <div class="regulation-description">Peta Jalan Pengurangan Sampah Oleh Produsen untuk mendukung ekonomi sirkular.</div>
                        </li>
                    </ul>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Kebijakan Terkini</h2>
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-title">Target Pengurangan Sampah</div>
                            <p>Pemerintah menargetkan pengurangan sampah sebesar 30% dan penanganan sampah 70% pada tahun 2025.</p>
                        </div>
                        <div class="info-card">
                            <div class="info-title">Program Ekonomi Sirkular</div>
                            <p>Implementasi konsep ekonomi sirkular dalam pengelolaan sampah untuk menciptakan nilai tambah.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Halaman Fasilitas -->
            <div id="fasilitas" class="page-content">
                <h1 class="page-title">Fasilitas Pengelolaan Sampah</h1>

                <div class="content-section">
                    <h2 class="section-title">Jenis Fasilitas</h2>
                    <div class="facility-grid">
                        <div class="facility-card">
                            <h3 class="facility-name">TPA Regional Surabaya</h3>
                            <span class="facility-type">Tempat Pemrosesan Akhir</span>
                            <div class="facility-info">
                                <p><strong>Lokasi:</strong> Benowo, Surabaya</p>
                                <p><strong>Kapasitas:</strong> 1,500 ton/hari</p>
                                <p><strong>Status:</strong> Operasional</p>
                            </div>
                        </div>
                        <div class="facility-card">
                            <h3 class="facility-name">Bank Sampah Malang Raya</h3>
                            <span class="facility-type">Bank Sampah</span>
                            <div class="facility-info">
                                <p><strong>Lokasi:</strong> Kota Malang</p>
                                <p><strong>Jenis Layanan:</strong> Pengumpulan & Pemilahan</p>
                                <p><strong>Nasabah:</strong> 2,500+ rumah tangga</p>
                            </div>
                        </div>
                        <div class="facility-card">
                            <h3 class="facility-name">TPST Kediri</h3>
                            <span class="facility-type">Tempat Pengolahan Sampah Terpadu</span>
                            <div class="facility-info">
                                <p><strong>Lokasi:</strong> Kediri</p>
                                <p><strong>Teknologi:</strong> Composting & RDF</p>
                                <p><strong>Kapasitas:</strong> 200 ton/hari</p>
                            </div>
                        </div>
                        <div class="facility-card">
                            <h3 class="facility-name">MRF Jakarta Utara</h3>
                            <span class="facility-type">Material Recovery Facility</span>
                            <div class="facility-info">
                                <p><strong>Lokasi:</strong> Jakarta Utara</p>
                                <p><strong>Fokus:</strong> Pemilahan Sampah Daur Ulang</p>
                                <p><strong>Kapasitas:</strong> 300 ton/hari</p>
                            </div>
                        </div>
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

    <script>
        // Data sampah dengan warna hijau yang beragam
        const wasteData = {
            labels: ['Sisa Makanan', 'Kayu/Ranting', 'Kertas/Karton', 'Plastik', 'Logam', 'Kain', 'Karet/Kulit', 'Kaca', 'Lainnya'],
            data: [45.27, 12.53, 10.65, 17.38, 1.92, 2.36, 1.52, 1.73, 6.64],
            colors: [
                '#2e7d32', // Dark green
                '#388e3c', // Medium dark green
                '#43a047', // Medium green
                '#4caf50', // Main green
                '#66bb6a', // Light green
                '#81c784', // Lighter green
                '#a5d6a7', // Very light green
                '#c8e6c9', // Pale green
                '#e8f5e8'  // Very pale green
            ]
        };

        let chart;

        function initChart() {
            const ctx = document.getElementById('wasteChart').getContext('2d');

            chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: wasteData.labels,
                    datasets: [{
                        data: wasteData.data,
                        backgroundColor: wasteData.colors,
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverBorderWidth: 3
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
                            backgroundColor: 'rgba(46, 125, 50, 0.9)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#4caf50',
                            borderWidth: 1,
                            cornerRadius: 6,
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + '%';
                                }
                            }
                        }
                    },
                    cutout: '50%',
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }

        function updateLegend() {
            const legendContainer = document.getElementById('chartLegend');
            legendContainer.innerHTML = '';

            wasteData.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.className = 'legend-item';
                legendItem.innerHTML = `
                    <div class="legend-color" style="background-color: ${wasteData.colors[index]}"></div>
                    <span class="legend-text">${label}: ${wasteData.data[index]}%</span>
                `;
                legendContainer.appendChild(legendItem);
            });
        }

        function updateStats() {
            const organicWaste = wasteData.data[0] + wasteData.data[1];
            document.getElementById('organicWaste').textContent = organicWaste.toFixed(1) + '%';
            document.getElementById('plasticWaste').textContent = wasteData.data[3] + '%';
            document.getElementById('paperWaste').textContent = wasteData.data[2] + '%';
        }

        function showLoading() {
            document.getElementById('loading').style.display = 'block';
            document.querySelector('.chart-section').style.opacity = '0.5';
        }

        function hideLoading() {
            document.getElementById('loading').style.display = 'none';
            document.querySelector('.chart-section').style.opacity = '1';
        }

        function updateData() {
            showLoading();

            setTimeout(() => {
                chart.update('active');
                updateLegend();
                updateStats();
                hideLoading();
            }, 800);
        }

        // Event listeners
        document.getElementById('yearSelect').addEventListener('change', updateData);
        document.getElementById('provinceSelect').addEventListener('change', updateData);
        document.getElementById('citySelect').addEventListener('change', updateData);

        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        // Abaikan link tanpa atribut data-page (seperti login)
        if (!this.hasAttribute('data-page')) {
            return;
        }

        e.preventDefault(); // Mencegah perilaku default hanya untuk navigasi internal

        // Navigasi antar halaman
        const page = this.getAttribute('data-page');
        document.querySelectorAll('.page-content').forEach(content => {
            content.classList.remove('active');
        });
        document.getElementById(page).classList.add('active');
    });
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
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
            updateLegend();
            updateStats();
        });
    </script>
</body>
</html>