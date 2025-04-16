<?php
include "db.php"; 
session_start(); // Memulai sesi PHP
$username = isset($_SESSION['username']); // Mengambil username dari sesi jika ada
// $password = isset($_SESSION['password']); // Mengambil password dari sesi jika ada
$query = "SELECT * FROM artikel ORDER BY dibuat_pada DESC LIMIT 3"; // Batasi 3 artikel terbaru
$result = $conn->query($query);
if (isset($_SESSION['flash_message'])) {
  echo "<script>alert('" . $_SESSION['flash_message'] . "');</script>";
  unset($_SESSION['flash_message']); // hapus supaya nggak muncul lagi saat reload
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
            <img 
              src="https://img.icons8.com/ios-glyphs/30/FFFFFF/home.png"
               alt="home"
              />
                </a>
                  </div>
                  <div class="dropdown">
                    <div class="profil-desa">
                      <a href="galeri.html" class="dropdown-btn">Profil Desa</a>
                    </div>
                      <div class="dropdown-content">
                          <a href="#">Posyandu</a>
                          <a href="#">BUMDes</a>
                          <a href="#">PPKM</a>
                      </div>
                  </div>
                  <div class="dropdown">
                    <div class="program-desa">
                      <a href="biografi.html" class="dropdown-btn">Program Desa</a>
                    </div>
                      <div class="dropdown-content">
                          <a href="#">Program Pertanian</a>
                          <a href="#">Program Pendidikan</a>
                          <a href="#">Program Kesehatan</a>
                      </div>
                  </div>
                  <a href="agenda.php">Agenda</a>
              </div>
              <div class="nav-kanan">
                  <a href="layanan_mandiri.html">Layanan Mandiri</a>
                  <a href="login_admin.php">Login Admin</a>
                </div>
          </div>
      </nav>
  </header>

    <div class="content-wrapper">
      <div class="content-left">
          <!-- Bagian Kiri -->
          <div class="carousel">
            <button class="prev" onclick="prevSlide()">&#10094;</button>
            <div class="carousel-container">
                <div class="slide active">
                    <img src="../img/jalann.jpg" alt="Perbaikan Jalan">
                    <div class="caption">Perbaikan jalan Desa Pemayahan Kabupaten Indramayu</div>
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

      <!-- Bagian Kanan -->
      <div class="content-right">
          <div class="peta-container">
              <h2>Peta Desa</h2>
              <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15838.54289301464!2d108.2747551!3d-6.39295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb867c063ff9b%3A0xddd467d1acde6282!2sPamayahan%2C%20Kec.%20Lohbener%2C%20Kabupaten%20Indramayu%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1614673547753!5m2!1sid!2sid" 
              width="100" height="100" style="border:0;" allowfullscreen="" loading="lazy">
          </iframe>
          </div>
          <div class="profil-kades">
            <h3>KEPALA DESA</h3>
            <img src="../img/kades.jpg" alt="kades">
            <p>H. Abdul Hakim, M.Pd.I</p>
          </div>
      </div>
  </div>
        
  <section class="artikel-terkini">
  <h2>Artikel Terkini</h2>
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
              <?php
              // Batasi jumlah karakter untuk ringkasan isi artikel (misalnya 120 karakter)
              $isi_ringkas = substr(strip_tags($isi), 0, 120);
              echo $isi_ringkas . (strlen($isi) > 120 ? '...' : ''); 
              ?>
            </p>
            <p class="card-text">
              <small class="text-muted">
                📅 <?= date('d F Y', strtotime($dibuat_pada)) ?> | 👤 <?= htmlspecialchars($penulis) ?>
              </small>
            </p>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</section>


    <div class="container">
        <div class="pagination">
            <div class="page-info">Halaman 1 dari 5</div>
            <div class="page-numbers">
                <!-- <img width="32" height="32" src="https://img.icons8.com/windows/64/1A1A1A/circled-left-2.png" alt="circled-left-2"/> -->
                <a href="#" class="page-number">1</a>
                <a href="#" class="page-number">2</a>
                <a href="#" class="page-number">3</a>
                <a href="#" class="page-number">4</a>
                <a href="#" class="page-number">5</a>
                <!-- <img width="64" height="64" src="https://img.icons8.com/windows/64/1A1A1A/circled-left-2.png" alt="circled-left-2"/> -->
            </div>
        </div>
    </div>
</section>

      </div>
    </div>
    <footer>
      <p>&copy; 2025 Desa Pamayahan</p>
    </footer>
  </body>
</html>
