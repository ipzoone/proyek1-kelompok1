<?php
include "db.php";
session_start();

if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM artikel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: artikel_crud.php");
exit;
?>
