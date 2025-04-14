<?php
session_start(); // Memulai sesi PHP
$username = isset($_SESSION['username']); // Mengambil username dari sesi jika ada
// $password = isset($_SESSION['password']); // Mengambil password dari sesi jika ada
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/slidegambar.css" />
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
                  <a href="login.html">Agenda</a>
              </div>
              <div class="nav-kanan">
                  <a href="layanan_mandiri.html">Layanan Mandiri</a>
                  <a href="login_admin.html">Login Admin</a>
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
            <div class="agenda">
              <h3>Agenda</h3>
              <ul>
                <li>26 Februari 2025 - Perbaikan jalan Desa Pemayahan Kabupaten Indramayu</li>
                <li>14 Januari 2025 - Rapat Koordinasi Pekerja Sosial</li>
                <li>24 Desember 2024 - Pelantikan petugas Pemilu</li>
              </div>
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
        <div class="artikel-item">
            <a href="detail-artikel.php?id=1">
                <img src="../img/jalann.jpg" alt="Perbaikan Jalan">
                <div class="artikel-info">
                    <h3>Perbaikan jalan Desa Pemayahan Kabupaten Indramayu</h3>
                    <p>Pemayahan sedang melakukan perbaikan jalan...</p>
                  </a>
                    <span>📅 26 Februari 2025 | 👤 Siskiyah | 🗂 Berita Desa</span>
                </div>
        </div>
        <div class="artikel-item">
            <a href="detail-artikel.php?id=2">
                <img src="../img/rapat.jpeg" alt="Rapat Koordinasi">
                <div class="artikel-info">
                    <h3>Rapat Koordinasi Pekerja Sosial</h3>
                    <p>Rapat koordinasi sukses dilaksanakan...</p>
                  </a>
                    <span>📅 14 Januari 2025 | 👤 Fasido</span>
                </div>
        </div>
        <div class="artikel-item">
            <a href="detail-artikel.php?id=3">
                <img src="../img/lantik.jpeg" alt="Pelantikan Petugas Pemilu">
                <div class="artikel-info">
                    <h3>Pelantikan petugas Pemilu</h3>
                    <p>Melantik petugas Pemilu...</p>
                  </a>
                    <span>📅 24 Desember 2024 | 👤 Saifali</span>
                </div>
        </div>
    </div>
    
        <div class="container">
            <div class="pagination">
                <div class="page-info">Halaman 1 dari 5</div>
                <div class="page-numbers">
                 <img width="32" height="32" src="https://img.icons8.com/windows/64/1A1A1A/circled-left-2.png" alt="circled-left-2"/>
                    <a href="../html/satu.html" class="page-number">1</a>
                    <a href="../html/satu.html" class="page-number">2</a>
                    <a href="../html/satu.html" class="page-number">3</a>
                    <a href="../html/satu.html" class="page-number">4</a>
                    <a href="../html/satu.html" class="page-number">5</a>
                  <img width="64" height="64" src="https://img.icons8.com/windows/64/1A1A1A/circled-left-2.png" alt="circled-left-2"/>
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
