<?php
include "../db.php";
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
$stmt = $conn->prepare("DELETE FROM agenda WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: agenda_crud.php");
exit;
?>
