<?php
session_start();
include "../db.php";

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../admin.php");
    exit;
}

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: laporan_warga.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

// Ambil data laporan warga
$query = "
    SELECT 
        l.*,
        m.nama,
        m.masyarakat_id as masyarakat_id,
        k.nama_laporan
    FROM laporan_warga l
    JOIN masyarakat m ON l.masyarakat_id = m.masyarakat_id 
    JOIN kategori_laporan k ON l.kategori_id = k.kategori_id   
    WHERE l.id = '$id' 
";   

$result = $conn->query($query);

// Cek apakah data ditemukan
if (!$result || $result->num_rows == 0) {
    header("Location: laporan_warga.php");
    exit;
}

$laporan = $result->fetch_assoc();

// Proses form update status dan tanggapan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $conn->real_escape_string($_POST['status']);
    $tanggapan = $conn->real_escape_string($_POST['tanggapan']);
    $tanggal_update = date('Y-m-d H:i:s');
    
    $update_query = "
        UPDATE laporan_warga 
        SET status = '$status', 
        tanggapan_admin = '$tanggapan', 
        tanggal_update = '$tanggal_update' 
        WHERE id = '$id'
    ";
    
    if ($conn->query($update_query)) {
        $success_message = "Laporan berhasil diperbarui!";
        // Refresh data laporan
        $result = $conn->query($query);
        $laporan = $result->fetch_assoc();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Detail Laporan Warga</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
        padding-top: 2rem;
        max-width: 800px;
    }
    .card {
        border-radius: 0.625rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        overflow: hidden;
    }
    .card-header {
        background-color: #dc3545;
        color: white;
        font-weight: 600;
    }
    .btn-back {
        margin-bottom: 1rem;
    }
    .status-badge {
        font-size: 0.875rem;
        padding: 0.4em 0.75em;
        border-radius: 0.375rem;
        font-weight: 600;
        display: inline-block;
    }
    .bg-warning.text-dark {
        background-color: #ffc107 !important;
        color: #212529 !important;
    }
    .bg-info.text-dark {
        background-color: #0dcaf0 !important;
        color: #212529 !important;
    }
    .bg-success {
        background-color: #198754 !important;
        color: white !important;
    }
    .bg-danger {
        background-color: #dc3545 !important;
        color: white !important;
    }
    .laporan-info {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .laporan-content {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
    }
    .tanggapan-admin {
        background-color: #e9f5ff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #b8daff;
    }
    .foto-laporan {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }
</style>
</head>
<body>
<div class="container">
    <h2 class="mb-4"><i class="bi bi-exclamation-circle"></i> Detail Laporan Warga</h2>
    <a href="laporan.php" class="btn btn-secondary btn-back"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Laporan</a>
    
    <?php if (isset($success_message)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $success_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $error_message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-file-text me-2"></i>Laporan #<?= $laporan['id'] ?></span>
            <?php
                $status_class = '';
                $status = $laporan['status'] ?? '';
                switch($status) {
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
            ?>
            <span class="badge status-badge <?= $status_class ?>"><?= htmlspecialchars($status) ?></span>
        </div>
        <div class="card-body">
            <div class="laporan-info">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Pelapor:</strong> <?= htmlspecialchars($laporan['nama']) ?></p>
                        <p><strong>Kategori:</strong> <?= htmlspecialchars($laporan['nama_laporan']) ?></p>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Laporan:</strong> <?= date('d-m-Y H:i', strtotime($laporan['tanggal_laporan'])) ?></p>
                        <?php if (!empty($laporan['tanggal_update'])): ?>
                        <p><strong>Terakhir Diperbarui:</strong> <?= date('d-m-Y H:i', strtotime($laporan['tanggal_update'])) ?></p>
                        <?php endif; ?>
                        <p><strong>Lokasi:</strong> <?= htmlspecialchars($laporan['lokasi'] ?? '-') ?></p>
                    </div>
                </div>
            </div>
            
            <h5 class="mt-4 mb-3"><?= htmlspecialchars($laporan['judul']) ?></h5>
            
            <div class="laporan-content">
                <p><?= nl2br(htmlspecialchars($laporan['isi'])) ?></p>
                
                <?php if (!empty($laporan['foto'])): ?>
                <div class="text-center">
                    <img src="../../img/<?= htmlspecialchars($laporan['foto']) ?>" alt="Foto Laporan" class="foto-laporan">
                </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($laporan['tanggapan_admin'])): ?>
            <h5 class="mt-4 mb-3">Tanggapan Admin</h5>
            <div class="tanggapan-admin">
                <p><?= nl2br(htmlspecialchars($laporan['tanggapan_admin'])) ?></p>
            </div>
            <?php endif; ?>
            
            <h5 class="mt-4 mb-3">Update Status Laporan</h5>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Diterima" <?= ($laporan['status'] == 'Diterima') ? 'selected' : '' ?>>Diterima</option>
                        <option value="Diproses" <?= ($laporan['status'] == 'Diproses') ? 'selected' : '' ?>>Diproses</option>
                        <option value="Selesai" <?= ($laporan['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        <option value="Ditolak" <?= ($laporan['status'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggapan" class="form-label">Tanggapan</label>
                    <textarea class="form-control" id="tanggapan" name="tanggapan" rows="5" required><?= htmlspecialchars($laporan['tanggapan_admin'] ?? '') ?></textarea>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
