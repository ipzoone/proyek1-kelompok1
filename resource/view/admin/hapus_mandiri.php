<?php
include '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM masyarakat WHERE id=$id");
header("Location: mandiri_crud.php");
?>
