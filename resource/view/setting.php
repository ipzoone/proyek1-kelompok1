<?php
session_start();
include "db.php";

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: layanan_mandiri.php");
    exit;
}

$userId = $_SESSION['user_id'];
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Pengguna';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPin = $_POST['current_pin'] ?? '';
    $newPin = $_POST['pin'] ?? '';

    // Ambil PIN sekarang dari DB
    $stmt = $conn->prepare("SELECT pin FROM masyarakat WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedPinDB);
    $stmt->fetch();
    $stmt->close();

    if (!empty($newPin)) {
        if (password_verify($currentPin, $hashedPinDB)) {
            $hashedNewPin = password_hash($newPin, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE masyarakat SET pin = ? WHERE id = ?");
            $stmt->bind_param("si", $hashedNewPin, $userId);
            if ($stmt->execute()) {
                $successMessage = "PIN berhasil diperbarui!";
            } else {
                $errorMessage = "Gagal memperbarui PIN.";
            }
            $stmt->close();
        } else {
            $errorMessage = "PIN lama salah!";
        }
    } else {
        $errorMessage = "PIN baru tidak boleh kosong!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <?php if (isset($_SESSION['is_logged_in'])): ?>
                        <a href="pengajuan.php">Pengajuan</a>
                        <a href="pelaporan.php" class="active">Pelaporan</a>
                        <a href="dashboard_user.php">Dashboard</a>
            <?php endif; ?>
        </div>

          <div class="nav-kanan">
            <?php if (!isset($_SESSION['is_logged_in'])): ?>
              <div class="login-btn">
                <a href="layanan_mandiri.php">Layanan Mandiri</a>
                <a href="admin.php">Login Admin</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
  </header>
<body>
           <div class="container my-5">
        <?php if (isset($_SESSION['is_logged_in'])): ?>
            <div class="settings-container">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-gear-fill me-2"></i> Pengaturan Akun
                    </div>
                    <div class="card-body">
                        <form action="update_setting.php" method="POST">
                            <div class="mb-4">
                                <label for="username" class="form-label">Nama Pengguna:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" class="form-control" value="<?= htmlspecialchars($nama) ?>" disabled>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="current_pin" class="form-label">Masukkan PIN Lama:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="current_pin" name="current_pin" placeholder="Masukkan PIN lama">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="pin" class="form-label">Ganti PIN:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                    <input type="password" class="form-control" id="pin" name="pin" placeholder="Masukkan PIN baru">
                                </div>
                                <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah PIN</div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="show-password">
                                <label class="form-check-label small" for="show-password">Tampilkan password</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Anda harus login terlebih dahulu untuk mengakses halaman ini.
            </div>
        <?php endif; ?>
    </div>
    <script>
        document.getElementById("show-password").addEventListener("change", function () {
            const passwordInput = document.getElementById("pin");
            passwordInput.type = this.checked ? "text" : "pin";
        });
        </script>
</body>
</html>
