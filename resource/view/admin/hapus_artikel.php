<?php
include "../db.php";
session_start();

if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data artikel dulu untuk mendapatkan nama file gambar
$stmt = $conn->prepare("SELECT gambar FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$artikel = $result->fetch_assoc();

if ($artikel && !empty($artikel['gambar'])) {
    $gambarPath = "../../img/" . $artikel['gambar'];
    if (file_exists($gambarPath)) {
        unlink($gambarPath);  // Hapus gambar dari folder
    }
}

// Lanjutkan hapus artikel dari database
$stmt = $conn->prepare("DELETE FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: artikel_crud.php");
exit;
?>
