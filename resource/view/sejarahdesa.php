<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/profildesa.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <script src="../js/script.js"></script>
    <title>Sejarah Desa</title>
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


      <section>
      <div class="container py-5">
      <div class="row mb-4">
        <div class="col-12 text-center">
          <h2 class="fw-bold text-primary">Sejarah Desa Pamayahan</h2>
          <p class="text-muted">Mengenal lebih dekat asal usul dan perjalanan Desa Pamayahan</p>
        </div>
      </div>

      <div class="row mb-5">
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h4 class="card-title mb-3 text-primary">Asal Usul Desa Pamayahan</h4>
              <p>Telaah sejarah tentang Desa Pamayahan sejak pertama berdiri yang diperkirakan pada tahun 1838 berdasarkan temuan "buk" (sekumpulan arsip dulu yang tertulis di daun lontar dan kertas) walau tidak tercatat dalam sejarah siapa? kapan? pendiri dan mulai adanya Desa Pamayahan, rekam jejak peninggalan situs cagar budaya desa yang berupa pemandian Ki Buyut Urang yang berlokasi di RT. 001 RW. 001 blok pinggir kali sampai saat ini belum terungkap dengan jelas fakta sejarah yang menguatkan atau sebagai dasar bukti adanya desa Pamayahan.</p>
              <p>Pemakaman Pangeran Raden Surahadikusuma yang konon disebut sebagai ki buyut urang pun belum bisa diungkap ikhwah keabsahan benar tidaknya bahwa Desa Pamayahan adalah titisan dari Raden Surahadikusuma, hal ini disebabkan banyaknya multitafsir yang berkembang, sehingga akar sosial budaya yang tidak terungkap dengan sebenarnya.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 mb-4">
          <div class="card shadow-sm h-100">
            <img src="../img/pamayahan.jpg" class="card-img-top" alt="Desa Pamayahan" style="height: 250px; object-fit: cover;">
            <div class="card-body">
              <h4 class="card-title mb-3 text-primary">Catatan Sejarah</h4>
              <p>Sumber dari pelaku sejarah yang dituakan di Desa Pamayahan pun belum bisa memberikan ringkasan cerita tentang Desa Pamayahan, belum adanya kajian dan penelitian secara detail tentang Desa Pamayahan menjadikan sejarah Desa Pamayahan masih belum tersusun secara baik, ditambah lagi tentang mitos yang berkembang bahwa bercerita atau menceritakan Desa Pamayahan merupakan hal yang pantangan untuk disampaikan ataupun diceritakan.</p>
              <p>Terbukti berdasarkan catatan sejarah mulai dari Kerajaan Demak, Kesultanan Cirebon dan Masa Pendudukan Kolonial tidak terungkap fakta sejarah yang representative dan relevan tentang Desa Pamayahan.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-5">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="card-title mb-3 text-primary">Perkembangan Desa</h4>
              <p>Sebagai bahan referensi untuk menggali tentang sejarah Desa Pamayahan, berdasarkan catatan buku kuno yang kondisinya sudah mengalami kerusakan parah sehingga sulit untuk dibaca buk kuwu (orang Pamayahan menyebutnya), pada tahun 1883 sudah ada orang yang menjabat sebagai kuwu di Desa Pamayahan, namun yang menjadi pertanyaan apakah pada tahun itu pula asal usul Desa Pamayahan mulai ada?, sementara berdasarkan catatan sejarah yang lain padukuhan / padusunan / Desa Pamayahan berdiri dan didirikan pada tahun 1838.</p>
              
              <div class="row mt-4">
                <div class="col-md-6">
                  <h5 class="text-primary">Perkembangan Modern</h5>
                  <p>Seiring dengan perkembangan zaman, Desa Pamayahan terus mengalami kemajuan dalam berbagai bidang. Pembangunan infrastruktur, peningkatan kualitas pendidikan, dan pengembangan ekonomi masyarakat menjadi fokus utama pemerintah desa dalam beberapa dekade terakhir.</p>
                  <p>Desa Pamayahan kini telah berkembang menjadi desa yang memiliki potensi besar di bidang pertanian, pendidikan, dan pariwisata. Masyarakat desa juga semakin sadar akan pentingnya pelestarian budaya dan kearifan lokal sebagai bagian dari identitas desa.</p>
                </div>
                <div class="col-md-6">
                  <h5 class="text-primary">Visi Masa Depan</h5>
                  <p>Dengan semangat gotong royong dan kerja keras, Desa Pamayahan terus berbenah untuk mewujudkan visi menjadi desa yang mandiri, sejahtera, dan berbudaya. Berbagai program pembangunan dan pemberdayaan masyarakat terus digalakkan untuk meningkatkan kualitas hidup warga desa.</p>
                  <p>Pemerintah desa bersama masyarakat berkomitmen untuk terus menjaga dan melestarikan nilai-nilai luhur yang telah diwariskan oleh para pendahulu, sambil tetap terbuka terhadap kemajuan dan perkembangan zaman.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Visi Desa Pamayahan</h5>
            </div>
            <div class="card-body">
              <p class="card-text">"Mewujudkan Desa Pamayahan yang Mandiri, Sejahtera, dan Berbudaya Berbasis Pertanian dan Pariwisata"</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Misi Desa Pamayahan</h5>
            </div>
            <div class="card-body">
              <ol class="mb-0">
                <li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan</li>
                <li>Mengembangkan sektor pertanian dengan teknologi tepat guna</li>
                <li>Membangun infrastruktur desa yang memadai</li>
                <li>Mengembangkan potensi pariwisata desa</li>
                <li>Melestarikan budaya dan kearifan lokal</li>
                <li>Meningkatkan pelayanan publik yang transparan dan akuntabel</li>
                <li>Memberdayakan ekonomi masyarakat melalui UMKM</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

      </section>
    </div>
    <footer>
      <p>&copy; 2025 Desa Pamayahan</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
