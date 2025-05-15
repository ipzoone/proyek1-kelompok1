<?php
include "db.php";
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST["nama"];
    $pin = $_POST["pin"];

    $stmt = $conn->prepare("SELECT * FROM masyarakat WHERE nama = ?");
    $stmt->bind_param("s",$nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if(password_verify($pin, $user["pin"])){
            $_SESSION["nama"] = $nama;
            $_SESSION['user_id'] = $user['masyarakat_id']; 
            $_SESSION["is_logged_in"] = true;
            $_SESSION["flash_message"] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Anda Berhasil login!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            header("Location: home.php");
            exit;
        }
        else {
            $_SESSION["flash_message"] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Username atau PIN salah!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            header("Location: layanan_mandiri.php");

            exit;
        }
    }
}
?>
