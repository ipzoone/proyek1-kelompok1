<?php
include "../db.php";
session_start();

if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$artikel = $result->fetch_assoc();

if (!$artikel) {
    echo "Artikel tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];  
    $gambarBaru = $_FILES['gambar']['name'];

    // Cek apakah ada gambar baru yang diupload
    if (!empty($gambarBaru)) {
        $target_dir = "../../img/";
        $target_file = $target_dir . basename($gambarBaru);

        // Hapus gambar lama jika file-nya ada
        if (!empty($artikel['gambar']) && file_exists($target_dir . $artikel['gambar'])) {
            unlink($target_dir . $artikel['gambar']);
        }

        // Upload gambar baru
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        $gambar = $gambarBaru;
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $gambar = $artikel['gambar'];
    }

    $stmt = $conn->prepare("UPDATE artikel SET judul = ?, isi = ?, gambar = ?, penulis = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $judul, $isi, $gambar, $penulis, $id);
    $stmt->execute();

    header("Location: artikel_crud.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Edit Artikel</h2>

    <form action="edit_artikel.php?id=<?= $artikel['id']; ?>" method="post" enctype="multipart/form-data" class="card p-4 shadow-sm bg-white">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Artikel</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= htmlspecialchars($artikel['judul']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea id="isi" name="isi" rows="8" class="form-control" required><?= htmlspecialchars($artikel['isi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" id="penulis" name="penulis" class="form-control" value="<?= htmlspecialchars($artikel['penulis']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Artikel</label>
            <input type="file" id="gambar" name="gambar" class="form-control">
            <?php if (!empty($artikel['gambar'])): ?>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="artikel_crud.php" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
