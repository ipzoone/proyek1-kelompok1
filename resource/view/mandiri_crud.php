<?php
include 'db.php';
$result = $conn->query("SELECT * FROM masyarakat");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Layanan Mandiri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        table { width: 100%; }
        th, td { text-align: center; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Data Warga Layanan Mandiri</h2>
        <a href="tambah_mandiri.php" class="btn btn-success mb-3">+ Tambah Data</a>
        <a href="layanan_mandiri.php" class="btn btn-primary mb-3">Halaman Layanan Mandiri</a>
        <a href="dashboard.php" class="btn btn-danger mb-3">Keluar</a>
        
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
