<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Kesehatan - Desa Pamayahan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
            <?php if (isset($_SESSION['is_logged_in'])): ?>
                        <a href="pengajuan.php">Pengajuan</a>
                        <a href="pelaporan.php" class="active">Pelaporan</a>
                        <a href="dashboard_user.php">Dashboard</a>
            <?php endif; ?>
        </div>

          <div class="nav-kanan">
            <?php if (!isset($_SESSION['is_logged_in'])): ?>
              <div class="login-btn">
                <a href="layanan_mandiri.php">Layanan Mandiri</a>
                <a href="admin.php">Login Admin</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold text-danger">Program Kesehatan Desa Pamayahan</h2>
        <p class="text-muted">Mewujudkan masyarakat desa yang sehat dan sejahtera</p>
      </div>
    </div>

    <!-- Banner Program Kesehatan -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card bg-danger text-white shadow">
          <div class="card-body p-4">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h3>Desa Sehat, Masyarakat Kuat</h3>
                <p class="mb-0">Program unggulan Desa Pamayahan untuk meningkatkan kualitas kesehatan dan akses layanan kesehatan bagi seluruh warga desa.</p>
              </div>
              <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="#detail-program" class="btn btn-light">Pelajari Lebih Lanjut</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail Program -->
    <div id="detail-program" class="row mb-5">
      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger p-3 rounded-circle text-white me-3">
                <i class="bi bi-heart-pulse-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Posyandu Aktif</h4>
            </div>
            <p>Program Posyandu Aktif bertujuan untuk meningkatkan kualitas layanan posyandu di desa. Fokus utama program ini adalah pemantauan kesehatan ibu hamil, bayi, dan balita, serta lansia.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pemeriksaan kesehatan rutin untuk ibu hamil
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Imunisasi dan pemantauan tumbuh kembang balita
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pemeriksaan kesehatan lansia
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger p-3 rounded-circle text-white me-3">
                <i class="bi bi-hospital-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Poliklinik Desa</h4>
            </div>
            <p>Program Poliklinik Desa menyediakan layanan kesehatan dasar yang terjangkau bagi warga desa. Poliklinik ini dilengkapi dengan tenaga medis dan obat-obatan dasar untuk penanganan pertama.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pemeriksaan kesehatan umum
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pengobatan penyakit ringan
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Rujukan ke fasilitas kesehatan yang lebih lengkap
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger p-3 rounded-circle text-white me-3">
                <i class="bi bi-droplet-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Sanitasi Bersih</h4>
            </div>
            <p>Program Sanitasi Bersih bertujuan untuk meningkatkan kualitas sanitasi di desa. Program ini meliputi pembangunan sarana sanitasi, edukasi tentang pentingnya sanitasi, dan kampanye hidup bersih dan sehat.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pembangunan jamban sehat
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Penyediaan air bersih
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Edukasi Perilaku Hidup Bersih dan Sehat (PHBS)
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-danger p-3 rounded-circle text-white me-3">
                <i class="bi bi-activity" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Desa Siaga Sehat</h4>
            </div>
            <p>Program Desa Siaga Sehat bertujuan untuk meningkatkan kesiapsiagaan desa dalam menghadapi masalah kesehatan dan bencana. Program ini melibatkan pelatihan kader kesehatan dan pembentukan tim siaga bencana.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pelatihan pertolongan pertama
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Pembentukan tim siaga bencana
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-danger me-2"></i>
                Simulasi penanganan bencana
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Jadwal Kegiatan -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i> Jadwal Kegiatan Program Kesehatan</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Lokasi</th>
                    <th>Peserta</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>5 Juni 2025</td>
                    <td>Posyandu Balita</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Ibu dan Balita</td>
                  </tr>
                  <tr>
                    <td>12 Juli 2025</td>
                    <td>Posyandu Lansia</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Lansia</td>
                  </tr>
                  <tr>
                    <td>20 Agustus 2025</td>
                    <td>Pelatihan Kader Kesehatan</td>
                    <td>Aula Kecamatan Lohbener</td>
                    <td>Kader Kesehatan Desa</td>
                  </tr>
                  <tr>
                    <td>15 September 2025</td>
                    <td>Pemeriksaan Kesehatan Gratis</td>
                    <td>Poliklinik Desa</td>
                    <td>Seluruh Warga Desa</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kontak -->
    <div class="row">
      <div class="col-12">
        <div class="card bg-light">
          <div class="card-body p-4">
            <h5 class="card-title"><i class="bi bi-info-circle me-2"></i>Informasi Kontak</h5>
            <p>Untuk informasi lebih lanjut mengenai Program Kesehatan Desa Pamayahan, silakan hubungi:</p>
            <div class="d-flex align-items-center mt-3">
              <i class="bi bi-person-fill me-2 text-danger"></i>
              <span>Ibu Dr. Ratna (Koordinator Program Kesehatan)</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-telephone-fill me-2 text-danger"></i>
              <span>Telepon: 0812-3456-7892</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-envelope-fill me-2 text-danger"></i>
              <span>Email: kesehatan@desapamayahan.com</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 Desa Pamayahan</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
