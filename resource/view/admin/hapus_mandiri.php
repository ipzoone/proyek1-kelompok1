<?php
include '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM masyarakat WHERE masyarakat_id=$id");
header("Location: mandiri_crud.php");
?>
