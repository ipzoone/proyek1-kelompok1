<?php
session_start();
include "../db.php";

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../admin.php");
    exit;
}

// Filter berdasarkan status jika ada
$status_filter = "";
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = $conn->real_escape_string($_GET['status']);
    $status_filter = "WHERE l.status = '$status'";
}

// Ambil data laporan warga dengan join ke tabel masyarakat dan kategori_laporan
$query = "
    SELECT 
        l.*,
        m.nama,
        kl.nama_laporan as kategori_nama
    FROM laporan_warga l
    JOIN masyarakat m ON l.masyarakat_id = m.masyarakat_id
    LEFT JOIN kategori_laporan kl ON l.kategori_id = kl.kategori_id
    $status_filter
    ORDER BY l.tanggal_laporan DESC
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
<title>Laporan Warga</title>
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
        <h2 class="mb-4"><i class="bi bi-exclamation-circle"></i> Daftar Laporan Warga</h2>
    </div>
    <!-- <div class="filter-container">
        <a href="laporan_warga.php" class="btn btn-sm btn-outline-secondary">Semua</a>
        <a href="laporan_warga.php?status=Diterima" class="btn btn-sm btn-outline-warning">Diterima</a>
        <a href="laporan_warga.php?status=Diproses" class="btn btn-sm btn-outline-info">Diproses</a>
        <a href="laporan_warga.php?status=Selesai" class="btn btn-sm btn-outline-success">Selesai</a>
        <a href="laporan_warga.php?status=Ditolak" class="btn btn-sm btn-outline-danger">Ditolak</a>
    </div> -->
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Tanggal Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): 
                $no = 1;
                while ($row = $result->fetch_assoc()):
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
                <td data-label="No"><?= $no++ ?></td>
                <td data-label="Nama"><?= htmlspecialchars($row['nama']) ?></td>
                <td data-label="Kategori"><?= htmlspecialchars($row['kategori_nama'] ?? 'Tidak ada kategori') ?></td>
                <td data-label="Judul"><?= htmlspecialchars($row['judul']) ?></td>
                <td data-label="Tanggal Laporan"><?= date('d-m-Y', strtotime($row['tanggal_laporan'])) ?></td>
                <td data-label="Status"><span class="badge status-badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                <td data-label="Aksi">
                    <a href="detail_laporan.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Detail</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="7" class="text-center">Tidak ada data laporan warga.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>