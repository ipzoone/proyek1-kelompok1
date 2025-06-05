<?php
session_start();
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin - Desa Pamayahan</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.<min.css" />
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

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeIn">
          <div class="row g-0">
            <div class="col-md-5 bg-danger d-none d-md-block">
              <div class="d-flex flex-column h-100 p-4 text-white justify-content-between">
                <div>
                  <img src="https://1.bp.blogspot.com/-2qXJ0Sm155w/Wg6R6IeIBhI/AAAAAAAAFDc/3CSakAHZ7NEU5X-byzmTFKlIzhobVpkYACLcBGAs/s1600/Indramayu.png" alt="Logo Desa Pamayahan" class="img-fluid mb-3" style="max-width: 80px;">
                  <h4 class="fw-bold">Admin Panel</h4>
                </div>
                <div class="mt-auto">
                  <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Kelola Artikel</span>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Kelola Agenda</span>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <span>Kelola Pengguna</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body p-4 p-lg-5">
                <div class="text-center mb-4">
                  <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-shield-lock-fill" style="font-size: 1.8rem;"></i>
                  </div>
                  <h3 class="fw-bold">Login Admin</h3>
                  <p class="text-muted">Masuk ke panel admin untuk mengelola website desa</p>
                </div>
                
                <?php if (!empty($error)): ?>
                  <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($error); ?>
                  </div>
                <?php endif; ?>
                
                <form action="login_admin.php" method="post">
                  <div class="mb-4">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-person"></i>
                      </span>
                      <input type="text" class="form-control border-start-0 bg-light" id="username" name="username" placeholder="Username" required>
                    </div>
                  </div>
                  
                  <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-lock"></i>
                      </span>
                      <input type="password" class="form-control border-start-0 bg-light" id="password" name="password" placeholder="Password" required>
                    </div>
                  </div>
                  
                  <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="show-password">
                    <label class="form-check-label small" for="show-password">Tampilkan password</label>
                  </div>
                  
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger py-3 fw-semibold">MASUK</button>
                  </div>
                </form>
                
                <div class="text-center mt-4">
                  <!-- <p class="text-muted small">Belum memiliki akun? <a href="register_admin.php" class="text-decoration-none text-danger">Daftar Admin</a></p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="text-center mt-4">
          <div class="d-flex justify-content-center align-items-center">
            <i class="bi bi-shield-lock text-danger me-2"></i>
            <p class="text-muted mb-0 small">Akses admin hanya untuk petugas desa yang berwenang</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="mb-3">DESA PAMAYAHAN</h5>
                    <p>Website Pemerintah Desa Pamayahan</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <h5 class="mb-3">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i> (0831) 01498510</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> pamayahanpemdes@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-3 border-light">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Desa Pamayahan. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("show-password").addEventListener("change", function () {
      const passwordInput = document.getElementById("password");
      passwordInput.type = this.checked ? "text" : "password";
    });
  </script>
  </body>
</html>
