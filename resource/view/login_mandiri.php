<?php
include "db.php";
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST["nama"];
    $pin = $_POST["pin"];

    // $hash = password_hash($pin, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM masyarakat WHERE nama = ?");
    $stmt->bind_param("s",$nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // $_SESSION["nik"] = $user["nik"];
        if(password_verify($pin, $user["pin"])){
            $_SESSION["nama"] = $nama;
            $_SESSION["is_logged_in"] = true;
            $_SESSION["flash_message"] = "Selamat datang, " . $user["nama"] . "! Anda berhasil login.";

            header("Location: home.php");
            exit;
        }
        else {
            $error = "Username atau PIN salah!";
            header("Location: layanan_mandiri.php?error=" . urlencode($error));
            exit;
        }
    }  else {
        $_SESSION['error'] = "Username tidak ditemukan.";
        header("Location: layanan_mandiri.php");
        exit;
    }
}
?>
