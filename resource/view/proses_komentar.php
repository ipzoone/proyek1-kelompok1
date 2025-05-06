<?php
session_start();
include "db.php";

// 1) Pastikan user sudah login
if (empty($_SESSION['is_logged_in']) || empty($_SESSION['user_id'])) {
    header("Location: layanan_mandiri.php");
    exit;
}

// 2) Ambil data POST
$artikel_id = $_POST['artikel_id'] ?? null;
$parent_id = ($_POST['parent_id'] ?? 0);
$komentar = trim($_POST['komentar'] ?? '');

if (!$artikel_id || $komentar === '') {
    header("Location: detail-artikel.php?id={$artikel_id}");
    exit;
}

$user_id = $_SESSION['user_id'];

// 3) Pastikan parent_id yang tidak ada diubah menjadi NULL
if ($parent_id == 0) {
    $parent_id = null;
}

// 4) Simpan komentar ke database
$stmt = $conn->prepare("
    INSERT INTO komentar (artikel_id, user_id, parent_id, komentar, dibuat_pada)
    VALUES (?, ?, ?, ?, NOW())
");
$stmt->bind_param("iiis", $artikel_id, $user_id, $parent_id, $komentar);
$stmt->execute();

// 5) Redirect kembali ke detail artikel
header("Location: detail-artikel.php?id={$artikel_id}");
exit;
?>
