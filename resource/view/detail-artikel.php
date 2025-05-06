<?php
include "db.php";
// require_once "komentar.php";
session_start();
if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah artikel ada
if ($result->num_rows === 0) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$artikel = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($artikel['judul']) ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../js/script.js"></script>
</head>
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

<body class="bg-light">
    <div class="container py-5">
        <a href="artikel.php" class="btn btn-danger mb-4">← Kembali</a>
        
        <h1><?= htmlspecialchars($artikel['judul']) ?></h1>
        <p class="text-muted">
     <i class="bi bi-calendar-event"></i> <?= date('d F Y', strtotime($artikel['dibuat_pada'])) ?> |
     <i class="bi bi-person"></i> <?= htmlspecialchars($artikel['penulis']) ?>
       </p>
        <?php if (!empty($artikel['gambar'])): ?>
            <img src="../img/<?= htmlspecialchars($artikel['gambar']) ?>" alt="<?= htmlspecialchars($artikel['judul']) ?>" class="img-fluid my-4">
        <?php endif; ?>

        <div class="artikel-isi">
            <?= nl2br($artikel['isi']) ?>
        </div>
    </div>

    <?php if (! empty($_SESSION['is_logged_in'])): ?>
      <div class="card mb-5">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Tinggalkan Komentar</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="proses_komentar.php">
            <input type="hidden" name="artikel_id" value="<?= $id ?>">
            <input type="hidden" name="parent_id" value="0">
            <textarea name="komentar" class="form-control mb-3" rows="4" required></textarea>
            <button type="submit" class="btn btn-success">Kirim</button>
          </form>
        </div>
      </div>
    <?php else: ?>
      <p class="text-center">Silakan <a href="layanan_mandiri.php">login</a> untuk berkomentar.</p>
    <?php endif; ?>

    <?php
    include "komentar.php";
    echo "<h4>Komentar</h4>";
    tampilkan_komentar($conn, $id); 
    
    ?>
      <!-- <footer>
          <p>&copy; 2025 Desa Pamayahan</p>
      </footer> -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
