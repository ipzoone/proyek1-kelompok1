<?php
include "db.php";

if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah artikel ada
if ($result->num_rows === 0) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$artikel = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($artikel['judul']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <a href="artikel.php" class="btn btn-secondary mb-4">← Kembali ke daftar artikel</a>
        
        <h1><?= htmlspecialchars($artikel['judul']) ?></h1>
        <p class="text-muted">
            📅 <?= date('d F Y', strtotime($artikel['dibuat_pada'])) ?> |
            👤 <?= htmlspecialchars($artikel['penulis']) ?>
        </p>
        <?php if (!empty($artikel['gambar'])): ?>
            <img src="../img/<?= htmlspecialchars($artikel['gambar']) ?>" alt="<?= htmlspecialchars($artikel['judul']) ?>" class="img-fluid my-4">
        <?php endif; ?>

        <div class="artikel-isi">
            <?= nl2br($artikel['isi']) ?>
        </div>
    </div>
</body>
</html>
