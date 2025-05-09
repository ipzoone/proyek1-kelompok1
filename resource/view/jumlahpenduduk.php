<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jumlah Penduduk - Desa Pamayahan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/profildesa.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/script.js"></script>
</head>
<body>
<div class="bg-head">
    <img
      src="https://1.bp.blogspot.com/-2qXJ0Sm155w/Wg6R6IeIBhI/AAAAAAAAFDc/3CSakAHZ7NEU5X-byzmTFKlIzhobVpkYACLcBGAs/s1600/Indramayu.png"
      alt="Logo"
    />
    <div class="text-container">
      <h1>DESA PAMAYAHAN</h1>
      <p>Kec. Lohbener, Kab. Indramayu, Prov. Jawa Barat</p>
    </div>
  </div>

  <header>
    <nav>
      <button class="hamburger">☰</button>
      <div class="nav-links">
        <div class="nav-kiri">
          <div class="home-icons">
            <a href="home.php">
              <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/home.png" alt="home" />
            </a>
          </div>
          <div class="dropdown">
            <div class="profil-desa">
              <a href="#" class="dropdown-btn">Profil Desa <i class="bi bi-caret-down-fill"></i></a>
            </div>
            <div class="dropdown-content">
              <a href="sejarahdesa.php">Sejarah Desa</a>
              <a href="jumlahpenduduk.php">Jumlah Penduduk</a>
              <a href="fasilitasdesa.php">Fasilitas Desa</a>
            </div>
          </div>
          <div class="dropdown">
            <div class="program-desa">
              <a href="#" class="dropdown-btn">Program Desa <i class="bi bi-caret-down-fill"></i></a>
            </div>
            <div class="dropdown-content">
              <a href="program-pertanian.php">Program Pertanian</a>
              <a href="program-pendidikan.php">Program Pendidikan</a>
              <a href="program-kesehatan.php">Program Kesehatan</a>
             </div>
            </div>
          <a href="artikel.php">Artikel</a>
          <a href="agenda.php">Agenda</a>
        </div>
        <div class="nav-kanan">
      <?php if (isset($_SESSION['is_logged_in'])): ?>
        <div class="pojok-kanan">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center text-white text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
              <?= htmlspecialchars($_SESSION['nama']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li><a class="dropdown-item" href="setting.php">Pengaturan</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
     <?php else: ?>
        <div class="login-btn">
          <a href="layanan_mandiri.php">Layanan Mandiri</a>
          <a href="admin.php">Login Admin</a>
       </div>
     <?php endif; ?>
        </div>
      </div>
    </nav>
  </header>
 <section>
  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold text-primary">Data Kependudukan Desa Pamayahan</h2>
        <p class="text-muted">Informasi statistik penduduk Desa Pamayahan, Kecamatan Lohbener, Kabupaten Indramayu</p>
      </div>
    </div>

    <!-- Ringkasan Jumlah Penduduk -->
    <div class="row mb-5">
      <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white h-100">
          <div class="card-body text-center">
            <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
            <h3 class="mt-3">5,230</h3>
            <p class="mb-0">Total Penduduk</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card bg-info text-white h-100">
          <div class="card-body text-center">
            <i class="bi bi-gender-male" style="font-size: 3rem;"></i>
            <h3 class="mt-3">2,615</h3>
            <p class="mb-0">Laki-laki</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card bg-danger text-white h-100">
          <div class="card-body text-center">
            <i class="bi bi-gender-female" style="font-size: 3rem;"></i>
            <h3 class="mt-3">2,615</h3>
            <p class="mb-0">Perempuan</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card bg-success text-white h-100">
          <div class="card-body text-center">
            <i class="bi bi-house-fill" style="font-size: 3rem;"></i>
            <h3 class="mt-3">1,245</h3>
            <p class="mb-0">Jumlah KK</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik Penduduk -->
    <div class="row mb-5">
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-pie-chart-fill me-2"></i> Komposisi Penduduk Berdasarkan Usia</h5>
          </div>
          <div class="card-body">
            <canvas id="chartUsia"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-bar-chart-fill me-2"></i> Komposisi Penduduk Berdasarkan Pendidikan</h5>
          </div>
          <div class="card-body">
            <canvas id="chartPendidikan"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-briefcase-fill me-2"></i> Komposisi Penduduk Berdasarkan Pekerjaan</h5>
          </div>
          <div class="card-body">
            <canvas id="chartPekerjaan"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i> Pertumbuhan Penduduk (5 Tahun Terakhir)</h5>
          </div>
          <div class="card-body">
            <canvas id="chartPertumbuhan"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabel Data Penduduk Per Dusun -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-table me-2"></i> Data Penduduk Per Dusun</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nama Dusun</th>
                    <th>Jumlah KK</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Dusun Pamayahan I</td>
                    <td>425</td>
                    <td>890</td>
                    <td>910</td>
                    <td>1,800</td>
                  </tr>
                  <tr>
                    <td>Dusun Pamayahan II</td>
                    <td>380</td>
                    <td>780</td>
                    <td>795</td>
                    <td>1,575</td>
                  </tr>
                  <tr>
                    <td>Dusun Pamayahan III</td>
                    <td>440</td>
                    <td>945</td>
                    <td>910</td>
                    <td>1,855</td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>1,245</strong></td>
                    <td><strong>2,615</strong></td>
                    <td><strong>2,615</strong></td>
                    <td><strong>5,230</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="row">
      <div class="col-12">
        <div class="card bg-light">
          <div class="card-body p-4">
            <h5 class="card-title"><i class="bi bi-info-circle me-2"></i>Informasi</h5>
            <p>Data kependudukan ini diperbarui setiap 6 bulan sekali. Pembaruan terakhir dilakukan pada tanggal 1 Januari 2025.</p>
            <p>Untuk informasi lebih lanjut atau permintaan data kependudukan lainnya, silakan hubungi kantor desa pada jam kerja.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer>
  <p>&copy; 2025 Desa Pamayahan</p>
</footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Data untuk grafik usia
    const ctxUsia = document.getElementById('chartUsia').getContext('2d');
    const chartUsia = new Chart(ctxUsia, {
      type: 'pie',
      data: {
        labels: ['0-14 tahun', '15-64 tahun', '65+ tahun'],
        datasets: [{
          data: [30, 60, 10],
          backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
          title: {
            display: true,
            text: 'Komposisi Penduduk Berdasarkan Usia'
          }
        }
      }
    });

    // Data untuk grafik pendidikan
    const ctxPendidikan = document.getElementById('chartPendidikan').getContext('2d');
    const chartPendidikan = new Chart(ctxPendidikan, {
      type: 'bar',
      data: {
        labels: ['Tidak Sekolah', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'Perguruan Tinggi'],
        datasets: [{
          label: 'Jumlah Penduduk',
          data: [523, 1569, 1308, 1308, 522],
          backgroundColor: '#4BC0C0',
          borderColor: '#4BC0C0',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Data untuk grafik pekerjaan
    const ctxPekerjaan = document.getElementById('chartPekerjaan').getContext('2d');
    const chartPekerjaan = new Chart(ctxPekerjaan, {
      type: 'doughnut',
      data: {
        labels: ['Petani', 'Pedagang', 'PNS/TNI/Polri', 'Swasta', 'Lainnya'],
        datasets: [{
          data: [60, 15, 5, 10, 10],
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
          title: {
            display: true,
            text: 'Komposisi Penduduk Berdasarkan Pekerjaan (%)'
          }
        }
      }
    });

    // Data untuk grafik pertumbuhan
    const ctxPertumbuhan = document.getElementById('chartPertumbuhan').getContext('2d');
    const chartPertumbuhan = new Chart(ctxPertumbuhan, {
      type: 'line',
      data: {
        labels: ['2021', '2022', '2023', '2024', '2025'],
        datasets: [{
          label: 'Jumlah Penduduk',
          data: [4850, 4950, 5050, 5150, 5230],
          fill: false,
          borderColor: '#7886c7',
          tension: 0.1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: false
          }
        }
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
