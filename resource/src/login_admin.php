<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeAkses = $_POST["kode_akses"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cek kode akses (misalnya kamu tentukan: ADMIN123)
    if ($kodeAkses !== "ADMIN123") {
        echo "Kode akses salah! Tidak bisa daftar admin.";
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);

    if ($stmt->execute()) {
        echo "Admin berhasil didaftarkan!";
    } else {
        echo "Gagal mendaftar admin.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
</head>
<body>
    <h2>Daftar Admin Baru</h2>
    <form method="POST">
        <input type="text" name="kode_akses" placeholder="Kode Akses" required><br>
        <input type="text" name="username" placeholder="Username Admin" required><br>
        <input type="password" name="password" placeholder="Password Admin" required><br>
        <button type="submit">Daftar Admin</button>
    </form>
</body>
</html>
