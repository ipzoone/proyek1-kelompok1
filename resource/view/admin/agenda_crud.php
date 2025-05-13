<?php
include "../db.php";
session_start();

if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../login_admin.php");
    exit;
}

$result = $conn->query("SELECT * FROM agenda ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Agenda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
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
    <h2><i class="bi bi-calendar-event m-2"></i>Kelola Agenda</h2>
</div>
    <a href="tambah_agenda.php" class="btn btn-success mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Agenda
    </a>

    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= date('H:i', strtotime($row['waktu'])) ?></td>
                    <td>
                        <?php
                        $status = strtolower($row['status']);
                        $badge = ($status === 'aktif') ? 'success' : 'primary';
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= ucfirst($status) ?></span>
                    </td>
                    <td>
                        <a href="edit_agenda.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="hapus_agenda.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus agenda ini?')" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
