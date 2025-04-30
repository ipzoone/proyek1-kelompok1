<?php
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db   = "pamayahan";

$conn = new mysqli("localhost", "root", "", "pamayahan");

if ($conn ->connect_error) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
