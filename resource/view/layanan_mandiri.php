<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan Mandiri</title>
    <link rel="stylesheet" href="../css/cssmandiri.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
              <a href="#" class="dropdown-btn">Profil Desa</a>
            </div>
            <div class="dropdown-content">
              <a href="sejarahdesa.html">Sejarah Desa</a>
              <a href="#">Jumlah Penduduk</a>
              <a href="#">Fasilitas Desa</a>
            </div>
          </div>
          <div class="dropdown">
            <div class="program-desa">
              <a href="#" class="dropdown-btn">Program Desa</a>
            </div>
            <div class="dropdown-content">
              <a href="#">Program Pertanian</a>
              <a href="#">Program Pendidikan</a>
              <a href="#">Program Kesehatan</a>
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

    <div class="container-layanan">
      <div class="card">
    <?php if (isset($_SESSION["flash_message"])) {
        echo $_SESSION["flash_message"];
        unset($_SESSION["flash_message"]);
    } ?>
        <div class="card-header">
          <div class="title">
            <i class="bi bi-person icon"></i>
            LAYANAN MANDIRI
          </div>

          <p class="subtitle">
            SILAHKAN DATANG / HUBUNGI PERANGKAT DESA UNTUK <br />
            MENDAPATKAN KODE PIN ANDA
          </p>
        </div>
        <div class="card-body">
          <form action="login_mandiri.php" method="post">
            <label for="nama">USERNAME</label>
            <input type="text" id="nama" name="nama" required />
            <label for="pin">PIN</label>
            <input type="password" id="pin" name="pin" required />
            <div class="button-group">
              <button type="submit">MASUK</button>
              <a href="#" class="forgot-pin">LUPA PIN?</a>
            </div>
          </form>
          <?php if (!empty($_GET['error'])): ?>
            <p style="color:red; margin-top: 10px;"><?= htmlspecialchars($_GET['error']) ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <footer>
    <p>&copy; 2025 Desa Pamayahan</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
