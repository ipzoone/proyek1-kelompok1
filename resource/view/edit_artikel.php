<?php
include "db.php";
session_start();

// Periksa apakah ada ID artikel yang dikirimkan melalui URL
if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data artikel berdasarkan ID
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
    // Ambil data dari form
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];  // Tambahkan penulis
    $gambar = $_FILES['gambar']['name'];

    // Proses upload gambar jika ada
    if (!empty($gambar)) {
        $target_dir = "../img/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    } else {
        $gambar = $artikel['gambar']; // Menggunakan gambar lama jika tidak diubah
    }

    // Update artikel ke dalam database, termasuk penulis
    $stmt = $conn->prepare("UPDATE artikel SET judul = ?, isi = ?, gambar = ?, penulis = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $judul, $isi, $gambar, $penulis, $id);
    $stmt->execute();

    // Redirect ke halaman artikel setelah berhasil edit
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Edit Artikel</h2>

    <form action="edit_artikel.php?id=<?= $artikel['id']; ?>" method="post" enctype="multipart/form-data">
        <label for="judul">Judul Artikel:</label><br>
        <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($artikel['judul']); ?>" required><br><br>

        <label for="isi">Isi Artikel:</label><br>
        <textarea id="isi" name="isi" rows="10" cols="30" required><?= htmlspecialchars($artikel['isi']); ?></textarea><br><br>

        <label for="penulis">Penulis:</label><br>
        <input type="text" id="penulis" name="penulis" value="<?= htmlspecialchars($artikel['penulis']); ?>" required><br><br>

        <label for="gambar">Gambar Artikel:</label><br>
        <input type="file" id="gambar" name="gambar"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
