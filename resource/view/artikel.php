<?php
include "db.php"; 
$query = "SELECT * FROM artikel ORDER BY dibuat_pada DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Artikel</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
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
  <div class="container py-5">
    <h2 class="mb-4">Semua Artikel</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card mb-4 shadow-sm">
        <div class="row g-0">
          <div class="col-md-4">
            <a href="detail-artikel.php?id=<?= $row['id'] ?>">
              <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($row['judul']) ?>">
            </a>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">
                <a href="detail-artikel.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark">
                  <?= htmlspecialchars($row['judul']) ?>
                </a>
              </h5>
              <p class="card-text">
                <?php
                $ringkas = substr(strip_tags($row['isi']), 0, 120);
                echo $ringkas . (strlen($row['isi']) > 120 ? '...' : '');
                ?>
              </p>
              <p class="card-text">
                <small class="text-muted">
                  📅 <?= date('d F Y', strtotime($row['dibuat_pada'])) ?> | 👤 <?= htmlspecialchars($row['penulis']) ?>
                </small>
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
