<?php
include "db.php";
session_start();

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Agenda tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM agenda WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$agenda = $result->fetch_assoc();

if (!$agenda) {
    echo "Agenda tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $tempat = $_POST['tempat'];
    $status = $_POST['status'];

    // Query untuk mengupdate agenda
    $stmt = $conn->prepare("UPDATE agenda SET judul = ?, deskripsi = ?, tanggal = ?, waktu = ?, tempat = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $judul, $deskripsi, $tanggal, $waktu, $tempat, $status, $id);
    $stmt->execute();

    header("Location: agenda_crud.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Agenda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2>Edit Agenda</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($agenda['judul']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required><?= htmlspecialchars($agenda['deskripsi']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $agenda['tanggal'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Waktu</label>
                <input type="time" name="waktu" class="form-control" value="<?= $agenda['waktu'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Tempat</label>
                <input type="text" name="tempat" class="form-control" value="<?= htmlspecialchars($agenda['tempat']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Aktif" <?= $agenda['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Selesai" <?= $agenda['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="agenda_crud.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
