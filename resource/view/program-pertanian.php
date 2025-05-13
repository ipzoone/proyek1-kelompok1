<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Pertanian - Desa Pamayahan</title>
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
        <h2 class="fw-bold text-success">Program Pertanian Desa Pamayahan</h2>
        <p class="text-muted">Memajukan sektor pertanian untuk kesejahteraan masyarakat desa</p>
      </div>
    </div>

    <!-- Banner Program Pertanian -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card bg-success text-white shadow">
          <div class="card-body p-4">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h3>Pertanian Berkelanjutan</h3>
                <p class="mb-0">Program unggulan Desa Pamayahan untuk meningkatkan produktivitas pertanian dengan tetap menjaga kelestarian lingkungan.</p>
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
              <div class="bg-success p-3 rounded-circle text-white me-3">
                <i class="bi bi-droplet-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Irigasi Modern</h4>
            </div>
            <p>Program irigasi modern bertujuan untuk meningkatkan efisiensi penggunaan air dalam pertanian. Dengan sistem irigasi tetes dan sprinkler, petani dapat menghemat penggunaan air hingga 40% dibandingkan metode konvensional.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pembangunan saluran irigasi baru
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pelatihan penggunaan sistem irigasi modern
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Bantuan peralatan irigasi tetes
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-success p-3 rounded-circle text-white me-3">
                <i class="bi bi-tree-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Pertanian Organik</h4>
            </div>
            <p>Program pertanian organik mendorong petani untuk beralih ke metode pertanian yang lebih ramah lingkungan. Penggunaan pupuk organik dan pengendalian hama terpadu menjadi fokus utama program ini.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pelatihan pembuatan pupuk organik
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Sertifikasi produk pertanian organik
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Bantuan bibit unggul dan ramah lingkungan
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-success p-3 rounded-circle text-white me-3">
                <i class="bi bi-shop" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Pemasaran Hasil Tani</h4>
            </div>
            <p>Program pemasaran hasil tani membantu petani untuk mendapatkan akses pasar yang lebih luas dan harga yang lebih baik. Kerjasama dengan berbagai pihak dilakukan untuk memastikan hasil pertanian dapat dijual dengan harga yang menguntungkan.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pembentukan koperasi tani
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Kerjasama dengan pasar modern
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pelatihan pengemasan produk pertanian
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-success p-3 rounded-circle text-white me-3">
                <i class="bi bi-gear-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Modernisasi Alat Pertanian</h4>
            </div>
            <p>Program modernisasi alat pertanian bertujuan untuk meningkatkan efisiensi dan produktivitas pertanian melalui penggunaan teknologi modern. Bantuan alat pertanian dan pelatihan penggunaannya diberikan kepada kelompok tani di desa.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Bantuan traktor dan alat panen modern
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Pelatihan penggunaan dan perawatan alat
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                Sistem sewa alat pertanian untuk petani kecil
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
          <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i> Jadwal Kegiatan Program Pertanian</h5>
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
                    <td>15 Juni 2025</td>
                    <td>Pelatihan Pembuatan Pupuk Organik</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Kelompok Tani Makmur</td>
                  </tr>
                  <tr>
                    <td>20 Juli 2025</td>
                    <td>Sosialisasi Sistem Irigasi Modern</td>
                    <td>Aula Kecamatan Lohbener</td>
                    <td>Seluruh Petani Desa</td>
                  </tr>
                  <tr>
                    <td>10 Agustus 2025</td>
                    <td>Pelatihan Pemasaran Digital</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Pengurus Koperasi Tani</td>
                  </tr>
                  <tr>
                    <td>25 September 2025</td>
                    <td>Penyerahan Bantuan Alat Pertanian</td>
                    <td>Lapangan Desa Pamayahan</td>
                    <td>Perwakilan Kelompok Tani</td>
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
            <p>Untuk informasi lebih lanjut mengenai Program Pertanian Desa Pamayahan, silakan hubungi:</p>
            <div class="d-flex align-items-center mt-3">
              <i class="bi bi-person-fill me-2 text-success"></i>
              <span>Bapak Sutrisno (Koordinator Program Pertanian)</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-telephone-fill me-2 text-success"></i>
              <span>Telepon: 0812-3456-7890</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-envelope-fill me-2 text-success"></i>
              <span>Email: pertanian@desapamayahan.com</span>
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
