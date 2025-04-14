<?php
include "config.php";
$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM artikel WHERE id=$id");
header("Location: index.php");
?>
