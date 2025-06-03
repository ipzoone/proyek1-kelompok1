<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $pin = $_POST['pin'];

    // Validasi panjang NIK
    if (strlen($nik) > 16) {
        echo "<script>
                alert('Maaf, NIK tidak valid. Maksimal 16 karakter.');
                window.history.back();
              </script>";
        exit;
    }

    // Hash PIN sebelum disimpan ke database
    $hash = password_hash($pin, PASSWORD_DEFAULT);

    $sql = "INSERT INTO masyarakat (nik, nama, pin) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nik, $nama, $hash);
    $stmt->execute();

    header("Location: mandiri_crud.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Layanan Mandiri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function togglePinVisibility() {
            var pinField = document.getElementById("pin");
            var pinToggle = document.getElementById("pin-toggle");

            // Toggle input type between 'password' and 'text'
            if (pinField.type === "password") {
                pinField.type = "text";
                pinToggle.src = "https://img.icons8.com/ios-filled/30/000000/visible.png"; 
            } else {
                pinField.type = "password";
                pinToggle.src = "https://img.icons8.com/ios-filled/30/000000/invisible.png"; 
            }
        }
    </script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Tambah Data Layanan Mandiri</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="pin" class="form-label">PIN</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="pin" name="pin" required>
                    <span class="input-group-text" id="pin-toggle" onclick="togglePinVisibility()" style="cursor: pointer;">
                        <img src="https://img.icons8.com/ios-filled/30/000000/invisible.png" alt="toggle visibility" />
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="mandiri_crud.php" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html>
