<?php
include "db.php";
session_start();

// Periksa apakah ada ID artikel yang dikirimkan melalui URL
if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Hapus artikel dari database
$stmt = $conn->prepare("DELETE FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirect ke halaman artikel setelah berhasil menghapus
header("Location: artikel_crud.php");
exit;
?>
