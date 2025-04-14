<?php
include "config.php";
$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM artikel WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $konten = $_POST["konten"];
    $penulis = $_POST["penulis"];
    $query = "UPDATE artikel SET judul='$judul', konten='$konten', penulis='$penulis' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
<form method="POST">
    <input type="text" name="judul" value="<?= $row['judul'] ?>" required><br>
    <textarea name="konten" required><?= $row['konten'] ?></textarea><br>
    <input type="text" name="penulis" value="<?= $row['penulis'] ?>" required><br>
    <button type="submit">Update</button>
</form>
