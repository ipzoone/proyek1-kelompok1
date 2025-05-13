<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Pendidikan - Desa Pamayahan</title>
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
        <h2 class="fw-bold text-primary">Program Pendidikan Desa Pamayahan</h2>
        <p class="text-muted">Membangun generasi cerdas untuk masa depan desa yang lebih baik</p>
      </div>
    </div>

    <!-- Banner Program Pendidikan -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card bg-primary text-white shadow">
          <div class="card-body p-4">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h3>Pendidikan Berkualitas untuk Semua</h3>
                <p class="mb-0">Program unggulan Desa Pamayahan untuk meningkatkan kualitas pendidikan dan akses pendidikan bagi seluruh warga desa.</p>
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
              <div class="bg-primary p-3 rounded-circle text-white me-3">
                <i class="bi bi-book-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Beasiswa Pendidikan</h4>
            </div>
            <p>Program beasiswa pendidikan bertujuan untuk membantu anak-anak dari keluarga kurang mampu agar tetap dapat melanjutkan pendidikan. Beasiswa diberikan mulai dari tingkat SD hingga perguruan tinggi.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Beasiswa untuk siswa berprestasi
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Bantuan biaya pendidikan untuk keluarga kurang mampu
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Program pendampingan belajar
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-primary p-3 rounded-circle text-white me-3">
                <i class="bi bi-laptop-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Perpustakaan Digital</h4>
            </div>
            <p>Program perpustakaan digital menyediakan akses terhadap berbagai sumber belajar digital bagi warga desa. Fasilitas komputer dan internet disediakan di balai desa untuk mendukung program ini.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Penyediaan komputer dan akses internet
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Koleksi e-book dan materi pembelajaran digital
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Pelatihan literasi digital untuk warga
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-primary p-3 rounded-circle text-white me-3">
                <i class="bi bi-people-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">PAUD dan TK Desa</h4>
            </div>
            <p>Program PAUD dan TK Desa bertujuan untuk memberikan pendidikan usia dini yang berkualitas bagi anak-anak di desa. Fasilitas dan tenaga pengajar yang berkualitas disediakan untuk mendukung tumbuh kembang anak.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Pembangunan dan renovasi gedung PAUD/TK
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Pelatihan untuk guru PAUD/TK
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Penyediaan alat permainan edukatif
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-primary p-3 rounded-circle text-white me-3">
                <i class="bi bi-mortarboard-fill" style="font-size: 1.5rem;"></i>
              </div>
              <h4 class="mb-0">Bimbingan Belajar</h4>
            </div>
            <p>Program bimbingan belajar gratis untuk siswa SD, SMP, dan SMA di desa. Program ini bertujuan untuk meningkatkan prestasi akademik siswa dan mempersiapkan mereka untuk ujian nasional dan masuk perguruan tinggi.</p>
            <ul class="list-group list-group-flush mt-3">
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Bimbingan belajar untuk mata pelajaran utama
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Persiapan ujian nasional dan SBMPTN
              </li>
              <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                Konseling pendidikan dan karir
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
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i> Jadwal Kegiatan Program Pendidikan</h5>
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
                    <td>10 Juni 2025</td>
                    <td>Pembukaan Pendaftaran Beasiswa</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Siswa SD, SMP, SMA</td>
                  </tr>
                  <tr>
                    <td>15 Juli 2025</td>
                    <td>Pelatihan Guru PAUD/TK</td>
                    <td>Aula Kecamatan Lohbener</td>
                    <td>Guru PAUD/TK Desa</td>
                  </tr>
                  <tr>
                    <td>5 Agustus 2025</td>
                    <td>Peresmian Perpustakaan Digital</td>
                    <td>Balai Desa Pamayahan</td>
                    <td>Seluruh Warga Desa</td>
                  </tr>
                  <tr>
                    <td>20 September 2025</td>
                    <td>Mulai Program Bimbingan Belajar</td>
                    <td>SD, SMP, SMA Desa</td>
                    <td>Siswa SD, SMP, SMA</td>
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
            <p>Untuk informasi lebih lanjut mengenai Program Pendidikan Desa Pamayahan, silakan hubungi:</p>
            <div class="d-flex align-items-center mt-3">
              <i class="bi bi-person-fill me-2 text-primary"></i>
              <span>Ibu Siti Aminah (Koordinator Program Pendidikan)</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-telephone-fill me-2 text-primary"></i>
              <span>Telepon: 0812-3456-7891</span>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="bi bi-envelope-fill me-2 text-primary"></i>
              <span>Email: pendidikan@desapamayahan.com</span>
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
