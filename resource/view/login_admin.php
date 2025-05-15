<?php
session_start(); // Memulai sesi untuk menyimpan data login
include "db.php"; // Menghubungkan ke file koneksi database
error_reporting(E_ALL); // Menampilkan semua jenis error
ini_set('display_errors', 1); // Memastikan error ditampilkan di browser

// Mengecek apakah request yang masuk adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // Mengambil data username dari form
    $password = $_POST["password"]; // Mengambil data password dari form

    // Mempersiapkan query untuk mencari username di tabel admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s",  $username); // Mengikat parameter username ke query
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query

    // Mengecek apakah username ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc(); // Mengambil data user sebagai array asosiatif

        // Verifikasi password dengan password yang tersimpan di database
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $username; // Menyimpan username di session
            $_SESSION["id"] = $user["id"]; // Menyimpan ID admin di session
            $_SESSION["is_admin_logged_in"] = true; // Menandai bahwa admin sudah login

            header("Location: admin/dashboard.php"); // Redirect ke halaman dashboard admin
            exit; // Menghentikan eksekusi script setelah redirect
        } else {
            $_SESSION['error'] = "Password salah."; // Menyimpan pesan error ke session
            header("Location: admin.php"); // Redirect kembali ke halaman login admin
            exit;
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan."; // Username tidak ada di database
        header("Location: admin.php"); // Redirect kembali ke halaman login admin
        exit;
    }
}
?>
