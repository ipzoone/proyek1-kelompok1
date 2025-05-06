<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fasilitas Desa - Desa Pamayahan</title>
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

  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold text-primary">Fasilitas Desa Pamayahan</h2>
        <p class="text-muted">Informasi fasilitas umum yang tersedia di Desa Pamayahan</p>
      </div>
    </div>

    <!-- Kategori Fasilitas -->
    <div class="row mb-4">
      <div class="col-12">
        <ul class="nav nav-pills justify-content-center mb-4">
          <li class="nav-item">
            <a class="nav-link active" href="#semua" data-bs-toggle="pill">Semua</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#pendidikan" data-bs-toggle="pill">Pendidikan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#kesehatan" data-bs-toggle="pill">Kesehatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#ibadah" data-bs-toggle="pill">Tempat Ibadah</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#umum" data-bs-toggle="pill">Fasilitas Umum</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Daftar Fasilitas -->
    <div class="tab-content">
      <!-- Semua Fasilitas -->
      <div class="tab-pane fade show active" id="semua">
        <div class="row">
          <!-- Fasilitas Pendidikan -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-primary p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">SD Negeri Pamayahan</h4>
                </div>
                <p>Sekolah Dasar Negeri yang terletak di pusat Desa Pamayahan. Memiliki 12 ruang kelas, perpustakaan, dan lapangan olahraga.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 10</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-primary">Pendidikan</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-primary p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building" p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">SMP Negeri Pamayahan</h4>
                </div>
                <p>Sekolah Menengah Pertama Negeri yang melayani pendidikan untuk anak-anak Desa Pamayahan dan sekitarnya. Memiliki 9 ruang kelas, laboratorium komputer, dan perpustakaan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 15</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-primary">Pendidikan</span>
              </div>
            </div>
          </div>

          <!-- Fasilitas Kesehatan -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-danger p-3 rounded-circle text-white me-3">
                    <i class="bi bi-hospital-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Puskesmas Pembantu</h4>
                </div>
                <p>Puskesmas Pembantu yang melayani kebutuhan kesehatan dasar masyarakat Desa Pamayahan. Memiliki ruang periksa, ruang obat, dan ruang tindakan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 20</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-danger">Kesehatan</span>
              </div>
            </div>
          </div>

          <!-- Tempat Ibadah -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-success p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Masjid Jami Pamayahan</h4>
                </div>
                <p>Masjid utama di Desa Pamayahan yang dapat menampung hingga 500 jamaah. Dilengkapi dengan tempat wudhu, toilet, dan ruang serbaguna untuk kegiatan keagamaan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 5</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0234-123459</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-success">Tempat Ibadah</span>
              </div>
            </div>
          </div>

          <!-- Fasilitas Umum -->
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-info p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Balai Desa Pamayahan</h4>
                </div>
                <p>Balai Desa yang berfungsi sebagai pusat pemerintahan dan kegiatan masyarakat Desa Pamayahan. Memiliki ruang pertemuan, ruang pelayanan, dan halaman yang luas.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 1</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0234-123450</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-info">Fasilitas Umum</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-info p-3 rounded-circle text-white me-3">
                    <i class="bi bi-shop" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Pasar Desa Pamayahan</h4>
                </div>
                <p>Pasar tradisional yang menjadi pusat kegiatan ekonomi masyarakat Desa Pamayahan. Beroperasi setiap hari dengan komoditas utama hasil pertanian dan kebutuhan sehari-hari.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 25</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-clock-fill text-primary me-2"></i>
                  <span>05.00 - 12.00 WIB</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-info">Fasilitas Umum</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Fasilitas Pendidikan -->
      <div class="tab-pane fade" id="pendidikan">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-primary p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">SD Negeri Pamayahan</h4>
                </div>
                <p>Sekolah Dasar Negeri yang terletak di pusat Desa Pamayahan. Memiliki 12 ruang kelas, perpustakaan, dan lapangan olahraga.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 10</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-primary">Pendidikan</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-primary p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">SMP Negeri Pamayahan</h4>
                </div>
                <p>Sekolah Menengah Pertama Negeri yang melayani pendidikan untuk anak-anak Desa Pamayahan dan sekitarnya. Memiliki 9 ruang kelas, laboratorium komputer, dan perpustakaan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 15</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-primary">Pendidikan</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Fasilitas Kesehatan -->
      <div class="tab-pane fade" id="kesehatan">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-danger p-3 rounded-circle text-white me-3">
                    <i class="bi bi-hospital-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Puskesmas Pembantu</h4>
                </div>
                <p>Puskesmas Pembantu yang melayani kebutuhan kesehatan dasar masyarakat Desa Pamayahan. Memiliki ruang periksa, ruang obat, dan ruang tindakan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 20</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854
                  </span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-danger">Kesehatan</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tempat Ibadah -->
      <div class="tab-pane fade" id="ibadah">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-success p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Masjid Jami Pamayahan</h4>
                </div>
                <p>Masjid utama di Desa Pamayahan yang dapat menampung hingga 500 jamaah. Dilengkapi dengan tempat wudhu, toilet, dan ruang serbaguna untuk kegiatan keagamaan.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 5</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0889-7212-6930</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-success">Tempat Ibadah</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Fasilitas Umum -->
      <div class="tab-pane fade" id="umum">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-info p-3 rounded-circle text-white me-3">
                    <i class="bi bi-building-fill" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Balai Desa Pamayahan</h4>
                </div>
                <p>Balai Desa yang berfungsi sebagai pusat pemerintahan dan kegiatan masyarakat Desa Pamayahan. Memiliki ruang pertemuan, ruang pelayanan, dan halaman yang luas.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 1</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-telephone-fill text-primary me-2"></i>
                  <span>0838-3570-8854</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-info">Fasilitas Umum</span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="bg-info p-3 rounded-circle text-white me-3">
                    <i class="bi bi-shop" style="font-size: 1.5rem;"></i>
                  </div>
                  <h4 class="mb-0">Pasar Desa Pamayahan</h4>
                </div>
                <p>Pasar tradisional yang menjadi pusat kegiatan ekonomi masyarakat Desa Pamayahan. Beroperasi setiap hari dengan komoditas utama hasil pertanian dan kebutuhan sehari-hari.</p>
                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                  <span>Jl. Raya Pamayahan No. 25</span>
                </div>
                <div class="d-flex align-items-center mt-2">
                  <i class="bi bi-clock-fill text-primary me-2"></i>
                  <span>05.00 - 12.00 WIB</span>
                </div>
              </div>
              <div class="card-footer bg-white">
                <span class="badge bg-info">Fasilitas Umum</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Peta Lokasi Fasilitas -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i> Peta Lokasi Fasilitas Desa</h5>
          </div>
          <div class="card-body">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15838.54289301464!2d108.2747551!3d-6.39295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb867c063ff9b%3A0xddd467d1acde6282!2sPamayahan%2C%20Kec.%20Lohbener%2C%20Kabupaten%20Indramayu%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1614673547753!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
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
