<?php
include "../db.php";  // Menghubungkan ke file db.php yang berisi konfigurasi koneksi ke database
session_start();  // Memulai sesi PHP untuk melacak informasi session

// Mengecek apakah parameter 'id' ada dalam URL, jika tidak ada maka tampilkan pesan error
if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";  // Menampilkan pesan jika parameter 'id' tidak ditemukan
    exit;  // Menghentikan eksekusi script lebih lanjut
}

$id = $_GET['id'];  // Mengambil nilai 'id' dari URL

// Mempersiapkan query untuk mengambil data artikel berdasarkan id yang diberikan
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);  // Mengikat parameter $id ke query dengan tipe data integer ('i')
$stmt->execute();  // Menjalankan query yang telah dipersiapkan
$result = $stmt->get_result();  // Mengambil hasil query
$artikel = $result->fetch_assoc();  // Mengambil data artikel sebagai array asosiatif

// Mengecek apakah artikel ditemukan berdasarkan id, jika tidak ada artikel maka tampilkan pesan error
if (!$artikel) {
    echo "Artikel tidak ditemukan!";  // Menampilkan pesan jika artikel tidak ditemukan
    exit;  // Menghentikan eksekusi script lebih lanjut
}

// Mengecek apakah request method adalah POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];  
    $gambar = $_FILES['gambar']['name'];  // Menyimpan nama file gambar yang di-upload

    // Mengecek apakah ada gambar yang di-upload, jika ada maka gambar akan diproses
    if (!empty($gambar)) {
        $target_dir = "../../img/";  // Menentukan folder tujuan untuk menyimpan gambar
        $target_file = $target_dir . basename($gambar);  // Menentukan lokasi file yang akan disimpan
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);  // Memindahkan file gambar ke folder tujuan
    } else {
        $gambar = $artikel['gambar'];  // Jika tidak ada gambar yang di-upload, maka gunakan gambar lama dari database
    }

    // Menyimpan perubahan artikel ke dalam database
    $stmt = $conn->prepare("UPDATE artikel SET judul = ?, isi = ?, gambar = ?, penulis = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $judul, $isi, $gambar, $penulis, $id);  // Mengikat parameter dengan tipe data yang sesuai
    $stmt->execute();  // Menjalankan query untuk melakukan update data artikel

    // Setelah data berhasil disimpan, redirect ke halaman artikel_crud.php
    header("Location: artikel_crud.php");
    exit;  // Menghentikan eksekusi script setelah redirect
}
?>

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
