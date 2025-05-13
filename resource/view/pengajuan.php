<?php
session_start();
include "db.php";

// Cek apakah sudah login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    $_SESSION['error_message'] = "Sesi login Anda telah berakhir atau tidak valid. Silakan login kembali.";
    header("Location: layanan_mandiri.php");
    exit;
}

$masyarakat_id = $_SESSION['user_id'];
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Pengguna';
$success_message = '';
$error_message = '';

// Ambil daftar jenis surat
$jenis_query = "SELECT * FROM jenis_surat ORDER BY nama";
$jenis_result = $conn->query($jenis_query);

// Proses pengajuan surat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_surat_id = $_POST['jenis_surat'];
    $keperluan = $_POST['keperluan'];
    $keterangan = $_POST['keterangan'];
    $dokumen = '';

    // Upload dokumen pendukung jika ada
    if (isset($_FILES['dokumen']) && $_FILES['dokumen']['error'] == 0) {
        $target_dir = "../dokumen/";

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $dokumen = time() . '_' . basename($_FILES["dokumen"]["name"]);
        $target_file = $target_dir . $dokumen;

        if ($_FILES["dokumen"]["size"] <= 10000000) {
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

            if (in_array($fileType, $allowed_types)) {
                if (!move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
                    $error_message = "Maaf, terjadi kesalahan saat mengupload file.";
                }
            } else {
                $error_message = "Maaf, hanya file PDF, DOC, DOCX, JPG, JPEG, dan PNG yang diperbolehkan.";
            }
        } else {
            $error_message = "Maaf, ukuran file terlalu besar (maksimal 10MB).";
        }
    }

    if (empty($error_message)) {
        $stmt = $conn->prepare("INSERT INTO pengajuan_surat (masyarakat_id, jenis_surat_id, keterangan, dokumen, keperluan, status) VALUES (?, ?, ?, ?, ?, 'Menunggu')");
        $stmt->bind_param("iisss", $masyarakat_id, $jenis_surat_id, $keterangan, $dokumen, $keperluan);

        if ($stmt->execute()) {
            $success_message = "Pengajuan surat berhasil dikirim! Silakan tunggu proses verifikasi.";
        } else {
            $error_message = "Terjadi kesalahan: " . $stmt->error;
        }
    }
}

// Cek dan tambahkan kolom is_read jika belum ada
$check_column = $conn->query("SHOW COLUMNS FROM pengajuan_surat LIKE 'is_read'");
if ($check_column->num_rows == 0) {
    $conn->query("ALTER TABLE pengajuan_surat ADD COLUMN is_read TINYINT(1) DEFAULT 0");
}

// Ambil riwayat pengajuan
$query = "SELECT ps.*, js.nama as jenis_surat_nama 
          FROM pengajuan_surat ps 
          JOIN jenis_surat js ON ps.jenis_surat_id = js.jenis_surat_id 
          WHERE ps.masyarakat_id = ? 
          ORDER BY ps.tanggal_pengajuan DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $masyarakat_id);
$stmt->execute();
$result = $stmt->get_result();

// Hitung notifikasi baru
$notifikasi_query = "SELECT COUNT(*) as jumlah FROM pengajuan_surat 
                     WHERE masyarakat_id = ? 
                     AND (status = 'Diproses' OR status = 'Selesai' OR status = 'Ditolak')
                     AND catatan_admin IS NOT NULL
                     AND is_read = 0";
$notif_stmt = $conn->prepare($notifikasi_query);
$notif_stmt->bind_param("i", $masyarakat_id);
$notif_stmt->execute();
$notif_result = $notif_stmt->get_result();
$notif_count = $notif_result->fetch_assoc()['jumlah'];

// Tandai sebagai dibaca
if (isset($_GET['mark_read']) && $_GET['mark_read'] == 1) {
    $mark_read_query = "UPDATE pengajuan_surat SET is_read = 1 
                        WHERE masyarakat_id = ? 
                        AND (status = 'Diproses' OR status = 'Selesai' OR status = 'Ditolak')";
    $mark_stmt = $conn->prepare($mark_read_query);
    $mark_stmt->bind_param("i", $masyarakat_id);
    $mark_stmt->execute();
    header("Location: pengajuan.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Surat - Desa Pamayahan</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .petunjuk {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .petunjuk-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #0d6efd;
        }
        .petunjuk ol {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .notification-bell {
            position: relative;
            display: inline-block;
        }
        .tanggapan-admin {
            background-color: #f0f8ff;
            border-left: 3px solid #0d6efd;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .new-response {
            background-color: #fff3cd;
            border-left: 3px solid #ffc107;
        }
        .modal-detail {
            max-width: 90%;
            margin: 10px auto;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .modal-detail-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .modal-detail-content {
            margin-bottom: 10px;
        }
        .modal-detail-footer {
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
            text-align: right;
        }
    </style>
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
        <?php if ($notif_count > 0): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-bell-fill me-2"></i> Anda memiliki <strong><?= $notif_count ?></strong> tanggapan baru dari admin untuk pengajuan surat Anda.
                <a href="pengajuan.php?mark_read=1" class="alert-link">Klik di sini</a> untuk menandai semua sebagai telah dibaca.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Informasi Warga</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-circle p-3 me-3">
                                <i class="bi bi-person-fill text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h5 class="mb-1"><?= htmlspecialchars($nama) ?></h5>
                                <!-- Username dihapus sesuai permintaan -->
                            </div>
                        </div>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="home.php" class="btn btn-outline-primary mb-2">
                                <i class="bi bi-house-door me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="pelaporan.php" class="btn btn-outline-success mb-2">
                                <i class="bi bi-megaphone me-2"></i>Pelaporan Warga
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Bantuan</h5>
                    </div>
                    <div class="card-body">
                        <p><i class="bi bi-check-circle-fill text-success me-2"></i> Pengajuan surat akan diproses dalam 1-3 hari kerja</p>
                        <p><i class="bi bi-check-circle-fill text-success me-2"></i> Status pengajuan akan diperbarui secara berkala</p>
                        <p><i class="bi bi-check-circle-fill text-success me-2"></i> Surat yang sudah selesai dapat diambil di kantor desa</p>
                        <p><i class="bi bi-check-circle-fill text-success me-2"></i> Pastikan data yang diisi sudah benar dan lengkap</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="petunjuk">
                    <div class="petunjuk-title"><i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pengajuan Surat</div>
                    <ol>
                        <li>Pilih jenis surat yang ingin diajukan</li>
                        <li>Isi keperluan pengajuan surat dengan jelas</li>
                        <li>Berikan keterangan tambahan jika diperlukan</li>
                        <li>Unggah dokumen pendukung jika ada (KTP, KK, dll)</li>
                        <li>Klik tombol "Kirim Pengajuan"</li>
                        <li>Tunggu proses verifikasi dari admin desa</li>
                    </ol>
                </div>
                
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Form Pengajuan Surat</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> <?= $success_message ?>
                            </div>
                                               <?php endif; ?>
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_message ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                <select class="form-select" id="jenis_surat" name="jenis_surat" required>
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    <?php while($row = $jenis_result->fetch_assoc()): ?>
                                        <option value="<?= $row['jenis_surat_id'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <input type="text" class="form-control" id="keperluan" name="keperluan" required>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Dokumen Pendukung (opsional)</label>
                                <input class="form-control" type="file" id="dokumen" name="dokumen" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send-fill me-2"></i>Kirim Pengajuan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-secondary text-white py-3">
                        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Pengajuan Surat</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($result->num_rows > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Surat</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                                            <tr class="<?= $row['is_read'] == 0 && $row['catatan_admin'] ? 'table-warning' : '' ?>">
                                                <td><?= $no++ ?></td>
                                                <td><?= htmlspecialchars($row['jenis_surat_nama']) ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                                <td><?= htmlspecialchars($row['status']) ?></td>
                                                <td>
                                                    <?php if (!empty($row['catatan_admin'])): ?>
                                                        <div class="tanggapan-admin <?= $row['is_read'] == 0 ? 'new-response' : '' ?>">
                                                            <?= nl2br(htmlspecialchars($row['catatan_admin'])) ?>
                                                        </div>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Belum ada pengajuan surat.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
