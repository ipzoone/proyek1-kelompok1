<?php
session_start();
include "../db.php";

// if (!isset($_SESSION['nik'])) {
//     header("Location: home.php");
//     exit;
// }

$nik = $_SESSION['nik'];
$data = $conn->query("SELECT * FROM masyarakat WHERE nik = '$nik'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pin = $_POST['pin'];
    $fotoName = $data['foto']; // default foto lama

    // Handle upload foto baru
    if ($_FILES['foto']['name']) {
        $fileName = uniqid() . "_" . $_FILES['foto']['name'];
        $targetPath = "../uploads/" . $fileName;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
            $fotoName = $fileName;
        }
    }

    // Update data
    $stmt = $conn->prepare("UPDATE masyarakat SET pin = ?, foto = ? WHERE nik = ?");
    $stmt->bind_param("sss", $pin, $fotoName, $nik);
    if ($stmt->execute()) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='profil_masyarakat.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Profil Saya</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($data['nik']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" readonly>
                </div>
                <div class="mb-3">
                    <label>PIN</label>
                    <input type="text" name="pin" class="form-control" value="<?= htmlspecialchars($data['pin']) ?>" required>
                </div>
                <div class="mb-3">
                    <label>Foto Profil</label><br>
                    <img src="../uploads/<?= $data['foto'] ?>" width="100" class="mb-2"><br>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
