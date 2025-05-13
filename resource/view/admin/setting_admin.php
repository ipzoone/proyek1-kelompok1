<?php
include "../db.php";
session_start();

if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../login_admin.php");
    exit;
}

$adminId = $_SESSION['id']; // Ambil ID admin dari session
$adminName = $_SESSION['username']; // Ambil username admin dari session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!empty($newPassword) && $newPassword !== $confirmPassword) {
        $errorMessage = "Password dan konfirmasi tidak cocok!";
    } else {
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE admin SET username = ?, password = ? WHERE id = ?");
            $stmt->bind_param('ssi', $newUsername, $hashedPassword, $adminId);
        } else {
            $stmt = $conn->prepare("UPDATE admin SET username = ? WHERE id = ?");
            $stmt->bind_param('si', $newUsername, $adminId);
        }
        if ($stmt->execute()) {
            $_SESSION['username'] = $newUsername;
            $_SESSION['password'] = $newPassword;
            $stmt->close();
            $successMessage = "Pengaturan berhasil diperbarui!";
        } else {
            $errorMessage = "Terjadi kesalahan saat memperbarui data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setting Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>
<div class="sidebar">
    <h2>Dashboard Admin</h2>
    <a href="dashboard.php"><i class="bi bi-house-door m-2"></i> Dashboard</a>
    <a href="artikel_crud.php"><i class="bi bi-journal-text m-2"></i> Kelola Artikel</a>
    <a href="agenda_crud.php"><i class="bi bi-calendar-event m-2"></i> Kelola Agenda</a>
    <a href="mandiri_crud.php"><i class="bi bi-people m-2"></i> Kelola Pengguna</a>
    <a href="pengajuan.php"><i class="bi bi-envelope-fill m-2"></i> Pengajuan Surat</a>
    <a href="laporan.php"><i class="bi bi-megaphone-fill m-2"></i>Laporan</a>
    <a href="Setting_admin.php"><i class="bi bi-gear m-2"></i> Setting</a>
    <a href="../home.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
</div>


<div class="main">
    <div class="admin-header">
        <h1><i class="bi bi-gear m-2"></i> Setting Admin</h1>
    </div>

    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?= $errorMessage ?></div>
    <?php elseif (isset($successMessage)): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php endif; ?>

    <form action="Setting_admin.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($adminName) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="register_admin.php" class="btn btn-primary">Tambah Admin</a>
    </form>
</div>

</body>
</html>
