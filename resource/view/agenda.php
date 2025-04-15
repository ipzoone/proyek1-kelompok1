<?php
include "db.php";  // Menghubungkan ke database

// Query untuk mengambil data agenda
$result = $conn->query("SELECT * FROM agenda ORDER BY tanggal ASC"); // Menampilkan agenda berdasarkan tanggal secara urut

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" />
    <title>Document</title>
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
                  <a href="login_admin.php">Login Admin</a>
                </div>
          </div>
      </nav>
  </header>
  <div class="agenda">
    <h3>Agenda</h3>
    <ul>
        <?php
        // Loop untuk menampilkan semua agenda
        while ($row = $result->fetch_assoc()):
            $tanggal = date('d F Y', strtotime($row['tanggal']));  // Format tanggal
            $judul = htmlspecialchars($row['judul']);  // Menghindari XSS
        ?>
            <li><?= $tanggal ?> - <?= $judul ?></li>
        <?php endwhile; ?>
    </ul>
</div>
    
</body>
</html>

