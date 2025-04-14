<?php
include "config.php";
$result = mysqli_query($conn, "SELECT * FROM artikel ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Manajemen Artikel</title>
</head>
<body>
    <h2>Daftar Artikel</h2>
    <a href="tambah.php">Tambah Artikel</a>
    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['penulis'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
