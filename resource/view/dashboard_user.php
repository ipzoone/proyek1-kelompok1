<?php
include "db.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: layanan_mandiri.php");
    exit;
}


// Ambil data pengguna
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM masyarakat WHERE masyarakat_id = ?"; 
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Ambil data permohonan surat terbaru
$query_surat = "SELECT ps.*, js.nama_surat AS nama_surat
                FROM pengajuan_surat ps
                JOIN jenis_surat js ON ps.jenis_surat_id = js.jenis_surat_id
                WHERE ps.masyarakat_id = ?
                ORDER BY ps.tanggal_pengajuan DESC
                LIMIT 5";

$stmt_surat = $conn->prepare($query_surat);
$stmt_surat->bind_param('i', $user_id);
$stmt_surat->execute();
$surat_result = $stmt_surat->get_result();


// Ambil data pengaduan terbaru
$query_pengaduan = "SELECT lw.*, kl.nama_laporan AS nama_kategori
                   FROM laporan_warga lw
                   LEFT JOIN kategori_laporan kl ON lw.kategori_id = kl.kategori_id
                   WHERE lw.masyarakat_id = ? 
                   ORDER BY lw.tanggal_laporan DESC 
                   LIMIT 5";
$stmt_pengaduan = $conn->prepare($query_pengaduan);
$stmt_pengaduan->bind_param('i', $user_id);
$stmt_pengaduan->execute();
$pengaduan_result = $stmt_pengaduan->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Warga - Desa Pamayahan</title>
  <link rel="stylesheet" href="../css/style.css">
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

  <div class="container py-5">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="fw-bold text-primary">Dashboard Warga</h2>
        <p class="text-muted">Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?>! Pantau layanan dan pengajuan Anda di sini.</p>
      </div>
      <div class="col-md-4 text-md-end">
          <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right me-2"></i>logout
              </a>
        <a href="setting.php" class="btn btn-secondary"><i class="bi bi-sliders m-2"></i>Setting</a>
      </div>
    </div>

    <!-- Kartu Ringkasan -->
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                <i class="bi bi-envelope-paper text-primary" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <h5 class="mb-0">Pengajuan Surat</h5>
                <p class="text-muted small mb-0">Total pengajuan Anda</p>
              </div>
            </div>
            <h2 class="display-5 fw-bold text-primary mb-0">
              <?php 
                $count_query = "SELECT COUNT(*) as total FROM pengajuan_surat WHERE masyarakat_id = ?";
                $count_stmt = $conn->prepare($count_query);
                $count_stmt->bind_param('i', $user_id);
                $count_stmt->execute();
                $count_result = $count_stmt->get_result();
                $count = $count_result->fetch_assoc()['total'];
                echo $count;
              ?>
            </h2>
            <a href="pengajuan.php" class="btn btn-sm btn-light mt-3"><i class="bi bi-arrow-right me-1"></i>Detail</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                <i class="bi bi-megaphone text-danger" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <h5 class="mb-0">Pelaporan</h5>
                <p class="text-muted small mb-0">Pengaduan yang disampaikan</p>
              </div>
            </div>
            <h2 class="display-5 fw-bold text-danger mb-0">
              <?php 
                $count_query = "SELECT COUNT(*) as total FROM laporan_warga WHERE masyarakat_id = ?";
                $count_stmt = $conn->prepare($count_query);
                $count_stmt->bind_param('i', $user_id);
                $count_stmt->execute();
                $count_result = $count_stmt->get_result();
                $count = $count_result->fetch_assoc()['total'];
                echo $count;
              ?>
            </h2>
            <a href="pelaporan.php" class="btn btn-sm btn-light mt-3"><i class="bi bi-arrow-right me-1"></i> Detail</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
              <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
              </div>
              <div>
                <h5 class="mb-0">Selesai</h5>
                <p class="text-muted small mb-0">Dokumen siap diambil</p>
              </div>
            </div>
            <h2 class="display-5 fw-bold text-success mb-0">
              <?php 
                $count_query = "SELECT COUNT(*) as total FROM pengajuan_surat WHERE masyarakat_id = ? AND status = 'Selesai'";
                $count_stmt = $conn->prepare($count_query);
                $count_stmt->bind_param('i', $user_id);
                $count_stmt->execute();
                $count_result = $count_stmt->get_result();
                $count = $count_result->fetch_assoc()['total'];
                echo $count;
              ?>
            </h2>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Permohonan Surat Terbaru -->
      <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-light border-0">
            <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Permohonan Surat Terbaru</h5>
          </div>
          <div class="card-body p-0">
            <?php if($surat_result->num_rows > 0): ?>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>No.</th>
                      <th>Jenis Surat</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    while($row = $surat_result->fetch_assoc()): 
                      $status_class = '';
                      switch($row['status']) {
                        case 'Menunggu':
                          $status_class = 'bg-warning text-dark';
                          break;
                        case 'Diproses':
                          $status_class = 'bg-info text-dark';
                          break;
                        case 'Selesai':
                          $status_class = 'bg-success';
                          break;
                        case 'Ditolak':
                          $status_class = 'bg-danger';
                          break;
                      }
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_surat'])?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                        <td><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <img src="/placeholder.svg?height=100&width=100" alt="No Data" class="mb-3" height="100">
                <p class="text-muted">Belum ada permohonan surat</p>
                <a href="pengajuan.php" class="btn btn-sm btn-primary">Ajukan Surat</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Pengaduan Terbaru -->
      <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-light border-0">
            <h5 class="mb-0"><i class="bi bi-megaphone me-2"></i>Pelaporan Terbaru</h5>
          </div>
          <div class="card-body p-0">
            <?php if($pengaduan_result->num_rows > 0): ?>
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>No.</th>
                      <th>Kategori</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    while($row = $pengaduan_result->fetch_assoc()): 
                      $status_class = '';
                      switch($row['status']) {
                        case 'Diterima':
                          $status_class = 'bg-secondary';
                          break;
                        case 'Diproses':
                          $status_class = 'bg-info text-dark';
                          break;
                        case 'Selesai':
                          $status_class = 'bg-success';
                          break;
                        case 'Ditolak':
                          $status_class = 'bg-danger';
                          break;
                      }
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= isset($row['nama_kategori']) ? htmlspecialchars($row['nama_kategori']) : 'Tidak ada kategori' ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal_laporan'])) ?></td>
                        <td><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <img src="/placeholder.svg?height=100&width=100" alt="No Data" class="mb-3" height="100">
                <p class="text-muted">Belum ada pengaduan</p>
                <a href="pelaporan.php" class="btn btn-sm btn-danger">Buat Pengaduan</a>
              </div>
            <?php endif; ?>
          </div>

        </div>
      </div>


    </div>
  </div>

  <footer>
    <p>&copy; 2025 Desa Pamayahan</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>