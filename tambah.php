<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $konten = $_POST["konten"];
    $penulis = $_POST["penulis"];
    $tanggal = date("Y-m-d");

    $query = "INSERT INTO artikel (judul, konten, penulis, tanggal) VALUES ('$judul', '$konten', '$penulis', '$tanggal')";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="judul" placeholder="Judul" required><br>
    <textarea name="konten" placeholder="Isi Artikel" required></textarea><br>
    <input type="text" name="penulis" placeholder="Penulis" required><br>
    <button type="submit">Simpan</button>
</form>
