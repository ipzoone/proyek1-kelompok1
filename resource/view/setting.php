<?php
session_start();
include 'db.php';
$data = $conn->query("SELECT * FROM masyarakat")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $pin = $_POST['pin'];

    // Jika PIN tidak kosong, update termasuk hash PIN
    if (!empty($pin)) {
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);
        $sql = "UPDATE masyarakat SET nama=?, pin=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nama, $hashed_pin);
    } else {
        // Jika PIN kosong, update tanpa mengubah PIN
        $sql = "UPDATE masyarakat SET nama=? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nama);
    }

    $stmt->execute();
    header("Location: setting.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
</head>
<body>
    <div class="setting">
    <?php if (isset($_SESSION['is_logged_in'])): ?>
        <h1>Setting</h1>
        <form action="update_setting.php" method="POST">
            <label for="site_name">Nama :</label>
            <?= htmlspecialchars($_SESSION['nama']) ?><br><br>
            <?php endif; ?>
            <label for="pin">Masukan Pin lama:</label>
            <input type="password" class="form-control" id="pin" name="pin" placeholder="PIN Baru">
            <div class="input-group">
            <label for="pin">Ganti Pin :</label>
            <input type="password" class="form-control" id="pin" name="pin" placeholder="PIN Baru">
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="show-password">
                    <label class="form-check-label small" for="show-password">Tampilkan password</label>
                  </div>
                
                <br>
            <input type="submit" value="Simpan Perubahan">
    </div>
    <script>
        document.getElementById("show-password").addEventListener("change", function () {
            const passwordInput = document.getElementById("pin");
            passwordInput.type = this.checked ? "text" : "pin";
        });
        </script>
</body>
</html>