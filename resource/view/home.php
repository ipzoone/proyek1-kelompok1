<?php
include "db.php";
session_start();

$result_agenda = $conn->query("SELECT * FROM agenda ORDER BY tanggal ASC");
$username = $_SESSION['username'] ?? null;

$limit = 3; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM artikel ORDER BY dibuat_pada DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$total_artikel = $conn->query("SELECT COUNT(*) AS total FROM artikel")->fetch_assoc()['total'];
$total_halaman = ceil($total_artikel / $limit);

if (isset($_SESSION['flash_message'])) {
  echo "<script>alert('" . $_SESSION['flash_message'] . "');</script>";
  unset($_SESSION['flash_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/slidegambar.css" />
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

  <div class="content-wrapper">
    <div class="content-left">
      <div class="row">
      <div class="col-md-12">
        <!-- Carousel -->
        <div class="carousel">
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <div class="carousel-container">
          <div class="slide active">
            <img src="../img/jalann.jpg" alt="Perbaikan Jalan">
            <div class="caption">Perbaikan jalan Desa Pamayahan Kabupaten Indramayu</div>
          </div>
          <div class="slide">
            <img src="../img/pamayahan.jpg" alt="Rapat Koordinasi">
            <div class="caption">Kantor Desa Pamayahan</div>
          </div>
          <div class="slide">
            <img src="../img/lantik.jpeg" alt="Pelantikan Petugas Pemilu">
            <div class="caption">Pelantikan petugas Pemilu</div>
          </div>
        </div>
        <button class="next" onclick="nextSlide()">&#10095;</button>
      </div>
     </div>
    
    <div class="row mt-3">
  <div class="col-md-12">
    <div class="agenda">
  <h3><i class="bi bi-calendar-event-fill"></i> AGENDA</h3>
  <ul class="list-agenda">
    <?php while ($row = $result_agenda->fetch_assoc()):
      $tanggal = date('d F Y', strtotime($row['tanggal']));
      $jam = date('H:i', strtotime($row['waktu']));
      $judul = htmlspecialchars($row['judul']);
    ?>
      <li>
        <i class="bi bi-chevron-right"></i>
        <div>
          <strong><i class="bi bi-calendar2-week"></i> <?= $tanggal ?> &nbsp; 
                  <i class="bi bi-clock-fill"></i> <?= $jam ?></strong>
          <span><?= $judul ?></span>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
</div>
    </div>
  </div>
</div>

    </div>

    <div class="content-right">
      <div class="peta-container">
        <h2>PETA DESA</h2>
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15838.54289301464!2d108.2747551!3d-6.39295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb867c063ff9b%3A0xddd467d1acde6282!2sPamayahan%2C%20Kec.%20Lohbener%2C%20Kabupaten%20Indramayu%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1614673547753!5m2!1sid!2sid" 
          width="100" height="100" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
        <p>Desa. Pamayahan, Kec. Lohbener, Kabupaten Indramayu Kode pos : 45252</p>
      </div>
      <div class="profil-kades">
        <h3>KEPALA DESA</h3>
        <img src="../img/kades.jpg" alt="kades">
        <p>H. Abdul Hakim, M.Pd.I</p>
      </div>
    </div>
  </div>

  <section class="artikel-terkini">
  <h2>ARTIKEL TERKINI</h2>
  <div class="artikel-list">
    <?php while ($row = $result->fetch_assoc()):
      $id = $row['id'];
      $judul = $row['judul'];
      $isi = $row['isi'];
      $gambar = $row['gambar'];
      $penulis = $row['penulis'];
      $dibuat_pada = $row['dibuat_pada'];
    ?>
    <div class="card mb-4 shadow-sm">
      <div class="row g-0">
        <div class="col-md-4">
          <a href="detail-artikel.php?id=<?= $id ?>">
            <img src="../img/<?= htmlspecialchars($gambar) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($judul) ?>">
          </a>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">
              <a href="detail-artikel.php?id=<?= $id ?>" class="text-decoration-none text-dark">
                <?= htmlspecialchars($judul) ?>
              </a>
            </h5>
            <p class="card-text">
              <?= substr(strip_tags($isi), 0, 120) . (strlen($isi) > 120 ? '...' : '') ?>
            </p>
            <p class="card-text">
              <small class="text-muted">
                <i class="bi bi-calendar-event me-1"></i> <?= date('d F Y', strtotime($dibuat_pada)) ?> |
                <i class="bi bi-person me-1"></i> <?= htmlspecialchars($penulis) ?>
              </small>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</section>


  <div class="container mt-3 mb-3">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $page - 1 ?>">
              <i class="bi bi-chevron-left"></i>
            </a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
          <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($page < $total_halaman): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $page + 1 ?>">
             <i class="bi bi-chevron-right"></i>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  <footer>
    <p>&copy; 2025 Desa Pamayahan</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
