<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $pin = $_POST['pin'];

    $stmt = $conn->prepare("SELECT * FROM layanan_mandiri WHERE nik = ? AND pin = ?");
    $stmt->bind_param("ss", $nik, $pin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['nik'] = $user['nik'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['flash_message'] = "Selamat datang, " . $user['nama'] . "! Anda berhasil login.";
        header("Location: home.php");
        exit;
    } else {
        $error = "NIK atau PIN salah!";
        header("Location: layanan_mandiri.php?error=" . urlencode($error));
        exit;
    }
}
?>
