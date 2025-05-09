<?php
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeAkses = $_POST["kode_akses"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // KODE AKSES
    if ($kodeAkses !== "ADMIN123") {
        echo "Kode akses salah! Tidak bisa daftar admin.";
        exit;
    } 
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);

    if ($stmt->execute()) {
      $successMessage = "Pengaturan berhasil diperbarui!";
  } else {
      $errorMessage = "Terjadi kesalahan saat memperbarui data!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>
        <div class="sidebar">
            <h2>Dashboard Admin</h2>
            <a href="dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>
            <a href="artikel_crud.php"><i class="bi bi-journal-text"></i> Kelola Artikel</a>
            <a href="agenda_crud.php"><i class="bi bi-calendar-event"></i> Kelola Agenda</a>
            <a href="mandiri_crud.php"><i class="bi bi-people"></i> Kelola Pengguna</a>
            <a href="Setting_admin.php"><i class="bi bi-gear"></i> Setting</a>
            <a href="../home.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
          </div>

        <div class="main">
          <div class="admin-header">  
            <h2>Daftar Admin Baru</h2>
          </div>
          <?php if (isset($errorMessage)): ?>
         <div class="alert alert-danger"><?= $errorMessage ?></div>
           <?php elseif (isset($successMessage)): ?>
           <div class="alert alert-success"><?= $successMessage ?></div>
         <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="kode_akses" class="form-label">Kode Akses</label>
                    <input type="text" name="kode_akses" id="kode_akses" class="form-control" placeholder="Masukkan Kode Akses" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username Admin</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Admin" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Admin</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Admin" required>
                </div>
                <button type="submit" class="btn btn-primary">Daftar Admin</button>
                <a href="setting_admin.php"class="btn btn-danger">Kembali</a>
            </form>
        </div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
