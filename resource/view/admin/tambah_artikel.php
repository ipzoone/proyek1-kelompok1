<?php
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Mengecek apakah form dikirim menggunakan metode POST
    // Ambil data dari form
    $judul = $_POST['judul']; // Menyimpan nilai input 'judul' dari form
    $isi = $_POST['isi']; // Menyimpan nilai input 'isi' dari form
    $penulis = $_POST['penulis']; // Menyimpan nilai input 'penulis' dari form

    // Mengelola gambar
    $gambar = null; // Variabel untuk menyimpan nama gambar
    if ($_FILES['gambar']['name']) { // Mengecek apakah ada gambar yang diunggah
        $gambar = time() . '_' . $_FILES['gambar']['name']; // Membuat nama file gambar unik menggunakan timestamp
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../../img/' . $gambar); // Memindahkan file gambar ke folder img
    }

    // Menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO artikel (judul, isi, gambar, penulis) VALUES (?, ?, ?, ?)"); // Menyiapkan query untuk insert data
    $stmt->bind_param("ssss", $judul, $isi, $gambar, $penulis); // Mengikat parameter dengan query SQL
    $stmt->execute(); // Menjalankan query untuk memasukkan data ke database

    header("Location: artikel_crud.php"); // Mengarahkan pengguna ke halaman artikel_crud.php setelah data disimpan
    exit; // Menghentikan eksekusi lebih lanjut
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2>Tambah Artikel Baru</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
      </div>
      
      <div class="mb-3">
        <label>Isi Artikel</label>
        <textarea name="isi" class="form-control" rows="6" required></textarea>
      </div>

      <div class="mb-3">
        <label>Penulis</label>
        <input type="text" name="penulis" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control">
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="artikel_crud.php" class="btn btn-danger">Kembali</a>
    </form>
  </div>
</body>
</html>
