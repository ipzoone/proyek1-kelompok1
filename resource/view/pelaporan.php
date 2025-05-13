<?php
session_start();
include "db.php";

// Cek apakah sudah login
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: layanan_mandiri.php");
    exit;
}

// Gunakan user_id sebagai masyarakat_id
$masyarakat_id = $_SESSION['user_id'];
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Pengguna';
$success_message = '';
$error_message = '';

// Ambil daftar kategori laporan
$kategori_query = "SELECT * FROM kategori_laporan ORDER BY nama";
$kategori_result = $conn->query($kategori_query);

// Proses pengajuan laporan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $_POST['kategori']; // Gunakan nama kategori, bukan ID
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $lokasi = $_POST['lokasi'];
    
    // Upload foto jika ada
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "../img/laporan/";
        
        // Pastikan direktori ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $foto = time() . '_' . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto;
        
        // Cek apakah file adalah gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            // Cek ukuran file (max 5MB)
            if ($_FILES["foto"]["size"] <= 5000000) {
                // Cek format file
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // File berhasil diupload
                    } else {
                        $error_message = "Maaf, terjadi kesalahan saat mengupload file.";
                    }
                } else {
                    $error_message = "Maaf, hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
                }
            } else {
                $error_message = "Maaf, ukuran file terlalu besar (maksimal 5MB).";
            }
        } else {
            $error_message = "File yang diupload bukan gambar.";
        }
    }
    
    // Jika tidak ada error, simpan ke database
    if (empty($error_message)) {
        // Simpan ke database menggunakan masyarakat_id
        // Tambahkan kolom masyarakat_id jika belum ada
        $check_column = $conn->query("SHOW COLUMNS FROM laporan_warga LIKE 'masyarakat_id'");
        if ($check_column->num_rows == 0) {
            $conn->query("ALTER TABLE laporan_warga ADD COLUMN masyarakat_id INT NULL AFTER id");
        }
        
        // Simpan laporan
        $stmt = $conn->prepare("INSERT INTO laporan_warga (masyarakat_id, kategori, judul, isi, lokasi, foto, status, prioritas) VALUES (?, ?, ?, ?, ?, ?, 'Diterima', 'Sedang')");
        $stmt->bind_param("isssss", $masyarakat_id, $kategori, $judul, $isi, $lokasi, $foto);
        
        if ($stmt->execute()) {
            $success_message = "Laporan berhasil dikirim! Terima kasih atas partisipasi Anda.";
        } else {
            $error_message = "Terjadi kesalahan: " . $conn->error;
        }
    }
}

// Tambahkan kolom is_read jika belum ada
$check_column = $conn->query("SHOW COLUMNS FROM laporan_warga LIKE 'is_read'");
if ($check_column->num_rows == 0) {
    $conn->query("ALTER TABLE laporan_warga ADD COLUMN is_read TINYINT(1) DEFAULT 0");
}

// Cek apakah ada notifikasi baru (laporan yang baru diproses atau selesai)
$notifikasi_query = "SELECT COUNT(*) as jumlah FROM laporan_warga 
                    WHERE masyarakat_id = ? 
                    AND (status = 'Diproses' OR status = 'Selesai' OR status = 'Ditolak')
                    AND tanggapan_admin IS NOT NULL
                    AND is_read = 0";

$notif_stmt = $conn->prepare($notifikasi_query);
$notif_stmt->bind_param("i", $masyarakat_id);
$notif_stmt->execute();
$notif_result = $notif_stmt->get_result();
$notif_count = $notif_result->fetch_assoc()['jumlah'];

// Tandai notifikasi sebagai dibaca jika parameter mark_read=1
if (isset($_GET['mark_read']) && $_GET['mark_read'] == 1) {
    $mark_read_query = "UPDATE laporan_warga SET is_read = 1 
                        WHERE masyarakat_id = ? 
                        AND (status = 'Diproses' OR status = 'Selesai' OR status = 'Ditolak')";
    $mark_stmt = $conn->prepare($mark_read_query);
    $mark_stmt->bind_param("i", $masyarakat_id);
    $mark_stmt->execute();
    
    // Redirect untuk menghindari refresh yang menandai ulang
    header("Location: pelaporan.php");
    exit;
}

// Ambil riwayat laporan menggunakan masyarakat_id
$query = "SELECT lw.*, kl.nama as kategori_nama, kl.icon 
          FROM laporan_warga lw 
          LEFT JOIN kategori_laporan kl ON lw.kategori = kl.nama 
          WHERE lw.masyarakat_id = ? 
          ORDER BY lw.tanggal_laporan DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $masyarakat_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pelaporan Warga - Desa Pamayahan</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />
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
    <div
      class="alert alert-warning alert-dismissible fade show"
      role="alert"
    >
      <i class="bi bi-bell-fill me-2"></i> Anda memiliki
      <strong><?= $notif_count ?></strong> tanggapan baru dari admin untuk laporan
      Anda.
      <a href="pelaporan.php?mark_read=1" class="alert-link"
        >Klik di sini</a
      >
      untuk menandai semua sebagai telah dibaca.
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      ></button>
    </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
              <i class="bi bi-person-circle me-2"></i>Informasi Warga
            </h5>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <div class="bg-light rounded-circle p-3 me-3">
                <i
                  class="bi bi-person-fill text-primary"
                  style="font-size: 2rem"
                ></i>
              </div>
              <div>
                <h5 class="mb-1"><?= htmlspecialchars($nama) ?></h5>
                <!-- Username dihapus sesuai permintaan -->
              </div>
            </div>
            <hr />
            <div class="d-grid gap-2">
              <a href="home.php" class="btn btn-outline-primary mb-2">
                <i class="bi bi-house-door me-2"></i>Kembali ke Beranda
              </a>
              <a href="pengajuan.php" class="btn btn-outline-success mb-2">
                <i class="bi bi-file-earmark-text me-2"></i>Pengajuan Surat
              </a>
            </div>
          </div>
        </div>

        <div class="card mt-4 shadow-sm border-0">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">
              <i class="bi bi-info-circle me-2"></i>Bantuan
            </h5>
          </div>
          <div class="card-body">
            <p>
              <i class="bi bi-check-circle-fill text-success me-2"></i> Laporan
              Anda akan ditinjau oleh admin desa
            </p>
            <p>
              <i class="bi bi-check-circle-fill text-success me-2"></i> Status
              laporan akan diperbarui secara berkala
            </p>
            <p>
              <i class="bi bi-check-circle-fill text-success me-2"></i> Prioritas
              laporan ditentukan oleh admin desa
            </p>
            <p>
              <i class="bi bi-check-circle-fill text-success me-2"></i> Laporan
              yang sudah selesai akan diberi status "Selesai"
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="petunjuk">
          <div class="petunjuk-title">
            <i class="bi bi-info-circle-fill me-2"></i>Petunjuk Pelaporan
          </div>
          <ol>
            <li>Pilih kategori laporan yang sesuai</li>
            <li>Isi judul laporan dengan singkat dan jelas</li>
            <li>Berikan detail laporan yang lengkap</li>
            <li>Sertakan lokasi kejadian</li>
            <li>Unggah foto jika ada (opsional)</li>
            <li>Klik tombol "Kirim Laporan"</li>
          </ol>
        </div>

        <div class="card shadow-sm border-0 mb-4">
          <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
              <i class="bi bi-megaphone me-2"></i>Form Pelaporan
            </h5>
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

            <form method="POST" action="" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="kategori" class="form-label">
                  <i class="bi bi-tag me-2"></i>Kategori Laporan
                </label>
                <select class="form-select" id="kategori" name="kategori" required>
                  <option value="" selected disabled>-- Pilih Kategori --</option>
                  <?php while ($kategori = $kategori_result->fetch_assoc()): ?>
                  <option value="<?= htmlspecialchars($kategori['nama']) ?>">
                    <?= htmlspecialchars($kategori['nama']) ?> -
                    <?= htmlspecialchars($kategori['deskripsi']) ?>
                  </option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="judul" class="form-label">
                  <i class="bi bi-pencil me-2"></i>Judul Laporan
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="judul"
                  name="judul"
                  placeholder="Contoh: Jalan Rusak di RT 03"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="isi" class="form-label">
                  <i class="bi bi-textarea-t me-2"></i>Detail Laporan
                </label>
                <textarea
                  class="form-control"
                  id="isi"
                  name="isi"
                  rows="4"
                  placeholder="Jelaskan secara detail permasalahan yang ingin dilaporkan"
                  required
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="lokasi" class="form-label">
                  <i class="bi bi-geo-alt me-2"></i>Lokasi
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="lokasi"
                  name="lokasi"
                  placeholder="Contoh: Jalan Pamayahan RT 03 RW 02"
                  required
                />
              </div>
              <div class="mb-4">
                <label for="foto" class="form-label">
                  <i class="bi bi-camera me-2"></i>Foto (Opsional)
                </label>
                <input
                  type="file"
                  class="form-control"
                  id="foto"
                  name="foto"
                  accept="image/*"
                />
                <div class="form-text">Format: JPG, JPEG, PNG. Ukuran maksimal: 5MB</div>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary py-2">
                  <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">
              <i class="bi bi-clock-history me-2"></i>Riwayat Laporan
            </h5>
          </div>
          <div class="card-body p-0">
            <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    while ($row = $result->fetch_assoc()): 
                        $status_class = '';
                        switch($row['status']) {
                            case 'Diterima':
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
                        
                        $prioritas_class = '';
                        switch($row['prioritas']) {
                            case 'Rendah':
                                $prioritas_class = 'bg-secondary';
                                break;
                            case 'Sedang':
                                $prioritas_class = 'bg-primary';
                                break;
                            case 'Tinggi':
                                $prioritas_class = 'bg-danger';
                                break;
                        }
                        
                        // Cek apakah ada tanggapan admin dan belum dibaca
                        $has_new_response = !empty($row['tanggapan_admin']) && isset($row['is_read']) && $row['is_read'] == 0;
                    ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><i class="bi <?= htmlspecialchars($row['icon'] ?? 'bi-tag') ?> me-1"></i> <?= htmlspecialchars($row['kategori'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_laporan'])) ?></td>
                    <td><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#detail-<?= htmlspecialchars($row['id']) ?>" aria-expanded="false" aria-controls="detail-<?= htmlspecialchars($row['id']) ?>">
                        <i class="bi bi-info-circle"></i> Detail
                      </button>
                      <?php if ($has_new_response): ?>
                        <span class="badge bg-danger ms-1">Baru</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <tr class="collapse" id="detail-<?= htmlspecialchars($row['id']) ?>">
                    <td colspan="6" class="p-0">
                      <div class="modal-detail">
                        <div class="modal-detail-header">
                          <i class="bi bi-megaphone me-2"></i> Detail Laporan #<?= htmlspecialchars($row['id']) ?>
                        </div>
                        <div class="modal-detail-content">
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Kategori:</div>
                            <div class="col-md-8"><?= htmlspecialchars($row['kategori'] ?? '') ?></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Judul:</div>
                            <div class="col-md-8"><?= htmlspecialchars($row['judul']) ?></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Detail Laporan:</div>
                            <div class="col-md-8"><?= nl2br(htmlspecialchars($row['isi'])) ?></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Lokasi:</div>
                            <div class="col-md-8"><?= htmlspecialchars($row['lokasi']) ?></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Tanggal Laporan:</div>
                            <div class="col-md-8"><?= date('d-m-Y H:i', strtotime($row['tanggal_laporan'])) ?></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Status:</div>
                            <div class="col-md-8"><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Prioritas:</div>
                            <div class="col-md-8"><span class="badge <?= $prioritas_class ?>"><?= htmlspecialchars($row['prioritas']) ?></span></div>
                          </div>
                          
                          <?php if (!empty($row['foto'])): ?>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Foto:</div>
                            <div class="col-md-8">
                              <a href="../img/laporan/<?= htmlspecialchars($row['foto']) ?>" target="_blank">
                                <img src="../img/laporan/<?= htmlspecialchars($row['foto']) ?>" alt="Foto Laporan" class="img-fluid img-thumbnail" style="max-height: 150px;" />
                              </a>
                            </div>
                          </div>
                          <?php endif; ?>
                          
                          <?php if (!empty($row['tanggapan_admin'])): ?>
                          <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Tanggapan Admin:</div>
                            <div class="col-md-8">
                              <div class="tanggapan-admin <?= $has_new_response ? 'new-response' : '' ?>">
                                <i class="bi bi-chat-left-text me-2"></i>
                                <?= nl2br(htmlspecialchars($row['tanggapan_admin'])) ?>
                                <?php if (!empty($row['tanggal_update'])): ?>
                                <div class="text-muted mt-1 small">
                                  <i class="bi bi-clock me-1"></i> <?= date('d-m-Y H:i', strtotime($row['tanggal_update'])) ?>
                                </div>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                          <?php endif; ?>
                          
                          <?php if ($row['status'] == 'Selesai'): ?>
                          <div class="alert alert-success mt-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> Laporan Anda telah selesai ditangani. Terima kasih atas partisipasi Anda dalam meningkatkan kualitas desa.
                          </div>
                          <?php elseif ($row['status'] == 'Ditolak'): ?>
                          <div class="alert alert-danger mt-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Maaf, laporan Anda ditolak. Silakan periksa tanggapan admin untuk informasi lebih lanjut.
                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="modal-detail-footer">
                          <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="collapse" data-bs-target="#detail-<?= htmlspecialchars($row['id']) ?>">
                            Tutup
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            <?php else: ?>
            <div class="text-center py-5">
              <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
              <p class="mt-3 text-muted">Belum ada riwayat laporan</p>
              <p class="text-muted small">Silakan buat laporan dengan mengisi form di atas</p>
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
  <script src="../js/script.js"></script>
</body>
</html>

