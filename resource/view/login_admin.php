<?php
session_start();
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $user["id"];
            $_SESSION["is_admin_logged_in"] = true;

            header("Location: admin/dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Password salah.";
            header("Location: admin.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
        header("Location: admin.php");
        exit;
    }
}
?>
