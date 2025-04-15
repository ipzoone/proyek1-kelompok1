<?php
include "db.php";
session_start();

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM artikel ORDER BY dibuat_pada DESC");

?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Artikel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .img-thumbnail {
        width: 100px;
        height: auto;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4">Kelola Artikel</h2>
    <a href="tambah_artikel.php" class="btn btn-success mb-3">+ Tambah Artikel</a>

    <table class="table table-bordered bg-white">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Judul</th>
          <th>Isi Artikel</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()):
          ?>
        <tr>
          <td><?= $no++ ?></td>
          <td>
            <?php if ($row['gambar']): ?>
              <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" class="img-thumbnail" alt="Gambar">
              <?php else: ?>
                <em>Belum ada</em>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['judul']) ?></td>
              <td><?= substr(strip_tags($row['isi']), 0, 100) ?>...</td>
              <td>
                <a href="edit_artikel.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="hapus_artikel.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus artikel ini?')" class="btn btn-sm btn-danger">Hapus</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-danger mb-3">keluar</a>
  </div>
</body>
</html>
