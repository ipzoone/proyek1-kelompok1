<?php
include "../db.php";
session_start();

if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../login_admin.php");
    exit;
}

$result = $conn->query("SELECT * FROM masyarakat");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Layanan Mandiri</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
  <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>

<div class="sidebar">
    <h2>Dashboard Admin</h2>
    <a href="dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>
    <a href="artikel_crud.php"><i class="bi bi-journal-text"></i> Kelola Artikel</a>
    <a href="agenda_crud.php"><i class="bi bi-calendar-event"></i> Kelola Agenda</a>
    <a href="mandiri_crud.php"><i class="bi bi-people"></i> Kelola Pengguna</a>
    <a href="Setting_admin.php"><i class="bi bi-gear"></i> Setting</a>
    <a href="../home.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
</div>

<div class="main">
<div class="admin-header">  
    <h2>Data Warga Layanan Mandiri</h2>
</div>
    <a href="tambah_mandiri.php" class="btn btn-success mb-3">+ Tambah Data</a>
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Password (PIN)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nik']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['pin']) ?></td>
                    <td>
                        <a href="edit_mandiri.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus_mandiri.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
