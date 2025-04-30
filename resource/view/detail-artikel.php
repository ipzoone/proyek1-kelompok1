<?php
include "db.php";

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
    <title><?= htmlspecialchars($artikel['judul']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
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
            📅 <?= date('d F Y', strtotime($artikel['dibuat_pada'])) ?> |
            👤 <?= htmlspecialchars($artikel['penulis']) ?>
        </p>
        <?php if (!empty($artikel['gambar'])): ?>
            <img src="../img/<?= htmlspecialchars($artikel['gambar']) ?>" alt="<?= htmlspecialchars($artikel['judul']) ?>" class="img-fluid my-4">
        <?php endif; ?>

        <div class="artikel-isi">
            <?= nl2br($artikel['isi']) ?>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0">Tinggalkan Komentar</h5>
        </div>
        <div class="card-body">
          <form
            id="commentForm"
            method="POST"
            action="index.php?halaman=detail&id=<?php echo $article_id; ?>"
          >
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                required
              />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                required
              />
            </div>
            <div class="mb-3">
              <label for="comment" class="form-label">Komentar</label>
              <textarea
                class="form-control"
                id="comment"
                name="comment"
                rows="5"
                required
              ></textarea>
            </div>
            <button type="submit" class="btn btn-success">Kirim</button>
            </button>
          </form>
        </div>
      </div>
</body>
<footer>
    <p>&copy; 2025 Desa Pamayahan</p>
  </footer>
</html>
