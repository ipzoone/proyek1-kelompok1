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
    header("Location: pengajuan_surat.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

// Ambil data pengajuan surat
$query = "
    SELECT 
        p.*,
        m.nama,
        m.id as masyarakat_id,
        j.nama as nama_jenis_surat
    FROM pengajuan_surat p
    JOIN masyarakat m ON p.masyarakat_id = m.id
    LEFT JOIN jenis_surat j ON p.jenis_surat_id = j.id
    WHERE p.id = '$id'
";
$result = $conn->query($query);

// Cek apakah data ditemukan
if (!$result || $result->num_rows == 0) {
    header("Location: pengajuan_surat.php");
    exit;
}

$pengajuan = $result->fetch_assoc();

// Proses form update status dan catatan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $conn->real_escape_string($_POST['status']);
    $catatan = $conn->real_escape_string($_POST['catatan']);
    $tanggal_selesai = ($status == 'Selesai') ? date('Y-m-d H:i:s') : null;
    
    $update_query = "
        UPDATE pengajuan_surat 
        SET status = '$status', 
            catatan_admin = '$catatan'";
    
    if ($tanggal_selesai) {
        $update_query .= ", tanggal_selesai = '$tanggal_selesai'";
    }
    
    $update_query .= " WHERE id = '$id'";
    
    if ($conn->query($update_query)) {
        $success_message = "Pengajuan surat berhasil diperbarui!";
        // Refresh data pengajuan
        $result = $conn->query($query);
        $pengajuan = $result->fetch_assoc();
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
<title>Detail Pengajuan Surat</title>
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
        background-color: #0d6efd;
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
    .pengajuan-info {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    .pengajuan-content {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #dee2e6;
    }
    .catatan-admin {
        background-color: #e9f5ff;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #b8daff;
    }
    .dokumen-pengajuan {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }
</style>
</head>
<body>
<div class="container">
    <h2 class="mb-4"><i class="bi bi-envelope"></i> Detail Pengajuan Surat</h2>
    <a href="pengajuan.php" class="btn btn-secondary btn-back"><i class="bi bi-arrow-left"></i> Kembali ke Daftar Pengajuan</a>
    
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
            <span><i class="bi bi-file-text me-2"></i>Pengajuan #<?= $pengajuan['id'] ?></span>
            <?php
                $status_class = '';
                $status = $pengajuan['status'] ?? '';
                switch($status) {
                    case 'Diajukan':
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
            <div class="pengajuan-info">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Pemohon:</strong> <?= htmlspecialchars($pengajuan['nama']) ?></p>
                        <p><strong>Jenis Surat:</strong> <?= htmlspecialchars($pengajuan['nama_jenis_surat'] ?? $pengajuan['jenis_surat']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Pengajuan:</strong> <?= date('d-m-Y H:i', strtotime($pengajuan['tanggal_pengajuan'])) ?></p>
                        <?php if (!empty($pengajuan['tanggal_selesai'])): ?>
                        <p><strong>Tanggal Selesai:</strong> <?= date('d-m-Y H:i', strtotime($pengajuan['tanggal_selesai'])) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <h5 class="mt-4 mb-3">Keterangan Pengajuan</h5>
            
            <div class="pengajuan-content">
                <p><?= nl2br(htmlspecialchars($pengajuan['keterangan'])) ?></p>
                
                <?php if (!empty($pengajuan['keperluan'])): ?>
                <p><strong>Keperluan:</strong> <?= htmlspecialchars($pengajuan['keperluan']) ?></p>
                <?php endif; ?>
                
                <?php if (!empty($pengajuan['dokumen'])): ?>
                <div class="mt-3">
                    <p><strong>Dokumen Pendukung:</strong></p>
                    <a href="../uploads/dokumen/<?= htmlspecialchars($pengajuan['dokumen']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="bi bi-file-earmark"></i> Lihat Dokumen
                    </a>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($pengajuan['catatan_admin'])): ?>
            <h5 class="mt-4 mb-3">Catatan Admin</h5>
            <div class="catatan-admin">
                <p><?= nl2br(htmlspecialchars($pengajuan['catatan_admin'])) ?></p>
            </div>
            <?php endif; ?>
            
            <h5 class="mt-4 mb-3">Update Status Pengajuan</h5>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Diajukan" <?= ($pengajuan['status'] == 'Diajukan') ? 'selected' : '' ?>>Diajukan</option>
                        <option value="Diproses" <?= ($pengajuan['status'] == 'Diproses') ? 'selected' : '' ?>>Diproses</option>
                        <option value="Selesai" <?= ($pengajuan['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        <option value="Ditolak" <?= ($pengajuan['status'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Admin</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="5"><?= htmlspecialchars($pengajuan['catatan_admin'] ?? '') ?></textarea>
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
