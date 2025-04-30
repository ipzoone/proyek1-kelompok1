<?php
include '../db.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM masyarakat WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $pin = $_POST['pin'];

    // Jika PIN tidak kosong, update termasuk hash PIN
    if (!empty($pin)) {
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);
        $sql = "UPDATE masyarakat SET nik=?, nama=?, pin=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nik, $nama, $hashed_pin, $id);
    } else {
        // Jika PIN kosong, update tanpa mengubah PIN
        $sql = "UPDATE masyarakat SET nik=?, nama=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nik, $nama, $id);
    }

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
    <title>Edit Data Layanan Mandiri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function togglePinVisibility() {
            const pinField = document.getElementById("pin");
            const pinToggle = document.getElementById("pin-toggle");

            if (pinField.type === "password") {
                pinField.type = "text";
                pinToggle.src = "https://img.icons8.com/ios-filled/24/000000/visible.png";
            } else {
                pinField.type = "password";
                pinToggle.src = "https://img.icons8.com/ios-filled/24/000000/invisible.png";
            }
        }
    </script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Edit Data Layanan Mandiri</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="<?= htmlspecialchars($data['nik']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="pin" class="form-label">PIN</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="pin" name="pin" placeholder="PIN Baru">
                    <span class="input-group-text" onclick="togglePinVisibility()" style="cursor: pointer;">
                        <img id="pin-toggle" src="https://img.icons8.com/ios-filled/24/000000/invisible.png" alt="toggle visibility" />
                    </span>
                </div>
                <small class="text-muted">Kosongkan jika tidak ingin mengubah PIN.</small>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="mandiri_crud.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>
