<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM layanan_mandiri WHERE id=$id");
header("Location: dashboard_layanan.php");
?>
