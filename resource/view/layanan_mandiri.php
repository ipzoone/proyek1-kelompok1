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
            <span class="text-white me-2"><img src="https://img.icons8.com/?size=100&id=85356&format=png&color=FFFFFF" class="img-fluid" style="max-width: 30px; margin: 2px;">   <?= htmlspecialchars($_SESSION['nama']) ?>
          <img src="https://img.icons8.com/?size=100&id=85913&format=png&color=40C057"  class="img-fluid" style="max-width: 30px; width: 10px; height: 10px; margin-left:5px; margin-top: 10px;"></span>
           <div class="logout-btn">
             <a href="logout.php">Logout</a>
            </div>
          <?php else: ?>
            <div class="login-btn">
              <a href="layanan_mandiri.php">Layanan Mandiri</a>
              <a href="login_admin.php">Login Admin</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </header>

    <div class="container-layanan">
      <div class="card">
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
  </body>
</html>
