<?php
include "db.php"; 
session_start();

$result = $conn->query("SELECT * FROM agenda ORDER BY tanggal ASC"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../js/script.js"></script>
    <title>Agenda - Desa Pamayahan</title>
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

  <div class="agenda">
  <h3><i class="bi bi-calendar-event-fill"></i> AGENDA</h3>
    <?php
    while ($row = $result->fetch_assoc()):
      $tanggal = date('d F Y', strtotime($row['tanggal']));
      $jam = date('H:i', strtotime($row['waktu'])); 
      $judul = htmlspecialchars($row['judul']);
      $status = htmlspecialchars($row['status']);
    
    $statusClass = strtolower($status) === 'aktif' ? 'status-aktif' : 'status-selesai';
    ?>
    <li class="agenda-item">
      <div>
        <strong>
          <i class="bi bi-calendar2-week"></i> <?= $tanggal ?><br>&nbsp; 
          <i class="bi bi-clock"></i> <?= $jam ?>
        </strong><br>
        <span><?= $judul ?></span>
      </div>
      <span class="status <?= $statusClass ?>"><?= $status ?></span>
    </li>
    <?php endwhile; ?>
  </div>

 
<footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3">DESA PAMAYAHAN</h5>
                    <p>Website Pemerintah Desa Pamayahan</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> (0831) 01498510</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> pamayahanpemdes@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-3 border-light">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Desa Pamayahan. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

