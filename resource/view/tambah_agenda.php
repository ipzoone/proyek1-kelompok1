<?php
include "db.php";
session_start();

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $tempat = $_POST['tempat'];
    $status = $_POST['status'];

    // Query untuk menambahkan agenda
    $stmt = $conn->prepare("INSERT INTO agenda (judul, deskripsi, tanggal, waktu, tempat, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $judul, $deskripsi, $tanggal, $waktu, $tempat, $status);
    $stmt->execute();

    header("Location: agenda_crud.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Agenda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2>Tambah Agenda Baru</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Waktu</label>
                <input type="time" name="waktu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tempat</label>
                <input type="text" name="tempat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="agenda_crud.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
