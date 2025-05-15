<?php
session_start();
include "../db.php";

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../admin.php");
    exit;
}

// Ambil data pengajuan surat dengan join ke tabel masyarakat dan jenis_surat
$query = "
    SELECT 
        p.*,
        m.nama,
        j.nama_surat AS jenis_surat
    FROM pengajuan_surat p
    JOIN masyarakat m ON p.masyarakat_id = m.masyarakat_id
    LEFT JOIN jenis_surat j ON p.jenis_surat_id = j.jenis_surat_id
    ORDER BY p.tanggal_pengajuan DESC
    LIMIT 50
";

$result = $conn->query($query);

// Cek error query
if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pengajuan Surat</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>
    <div class="sidebar">
    <h2>Dashboard Admin</h2>
    <a href="dashboard.php"><i class="bi bi-house-door m-2"></i> Dashboard</a>
    <a href="artikel_crud.php"><i class="bi bi-journal-text m-2"></i> Kelola Artikel</a>
    <a href="agenda_crud.php"><i class="bi bi-calendar-event m-2"></i> Kelola Agenda</a>
    <a href="mandiri_crud.php"><i class="bi bi-people m-2"></i> Kelola Pengguna</a>
    <a href="pengajuan.php"><i class="bi bi-envelope-fill m-2"></i> Pengajuan Surat</a>
    <a href="laporan.php"><i class="bi bi-megaphone-fill m-2"></i>Laporan</a>
    <a href="Setting_admin.php"><i class="bi bi-gear m-2"></i> Setting</a>
    <a href="../home.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
</div>

<div class="main">
    <div class="admin-header">
        <h2 class="mb-4"><i class="bi bi-envelope"></i> Daftar Pengajuan Surat</h2>
    </div>
       <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Surat</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): 
                $no = 1;
                while ($row = $result->fetch_assoc()):
                    $status_class = '';
                    $status = $row['status'] ?? '';
                    switch($status) {
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
                    
                    // Pastikan nilai tidak null sebelum menggunakan htmlspecialchars
                    $nama = isset($row['nama']) ? htmlspecialchars($row['nama']) : '';
                    $jenis_surat = isset($row['jenis_surat']) ? htmlspecialchars($row['jenis_surat']) : '';
                    $status_text = isset($row['status']) ? htmlspecialchars($row['status']) : '';
            ?>
            <tr>
                <td data-label="No"><?= $no++ ?></td>
                <td data-label="Nama"><?= $nama ?></td>
                <td data-label="Jenis Surat"><?= $jenis_surat ?></td>
                <td data-label="Tanggal Pengajuan"><?= isset($row['tanggal_pengajuan']) ? date('d-m-Y', strtotime($row['tanggal_pengajuan'])) : '' ?></td>
                <td data-label="Status"><span class="badge status-badge <?= $status_class ?>"><?= $status_text ?></span></td>
                <td data-label="Aksi">
                    <a href="detail_pengajuan.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Detail</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pengajuan surat.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
