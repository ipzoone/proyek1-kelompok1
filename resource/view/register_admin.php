<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeAkses = $_POST["kode_akses"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek kode akses (misalnya kamu tentukan: ADMIN123)
    if ($kodeAkses !== "ADMIN123") {
        echo "Kode akses salah! Tidak bisa daftar admin.";
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);

    if ($stmt->execute()) {
        echo "Admin berhasil didaftarkan!";
    } else {
        echo "Gagal mendaftar admin.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body> <div class="bg-head">
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
            <a href="#">Agenda</a>
          </div>
          <div class="nav-kanan">
            <a href="layanan_mandiri.html">Layanan Mandiri</a>
            <a href="login_admin.php">Login Admin</a>
          </div>
        </div>
      </nav>
    </header>
    <h2>Daftar Admin Baru</h2>
    <form method="POST">
        <input type="text" name="kode_akses" placeholder="Kode Akses" required><br>
        <input type="text" name="username" placeholder="Username Admin" required><br>
        <input type="password" name="password" placeholder="Password Admin" required><br>
        <button type="submit">Daftar Admin</button>
    </form>
</body>
</html>
