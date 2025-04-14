<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db   = "desaku";

$conn = new mysqli("localhost", "root", "", "pamayahan");

if ($conn ->connect_error) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
