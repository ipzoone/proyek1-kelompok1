<?php
include "../db.php";
session_start();

if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: ../login_admin.php");
    exit;
}

$total_artikel = $conn->query("SELECT COUNT(*) AS total_artikel FROM artikel")->fetch_assoc()['total_artikel'];
$total_agenda = $conn->query("SELECT COUNT(*) AS total_agenda FROM agenda")->fetch_assoc()['total_agenda'];
$total_pengguna = $conn->query("SELECT COUNT(*) AS total_pengguna FROM masyarakat")->fetch_assoc()['total_pengguna'];

$adminName = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        <h1>Selamat Datang, <span class="admin-name"><?= htmlspecialchars($adminName); ?></span></h1>
    </div>

    <div class="stats-card">
        <h2>Statistik Dashboard</h2>
        <div class="stats-container">
            <a href="artikel_crud.php" class="stats-item stats-artikel">
                <div class="stats-icon"><i class="bi bi-file-earmark-text"></i></div>
                <div class="stats-info">
                    <div class="stats-value"><?= $total_artikel ?></div>
                    <div class="stats-label">Total Artikel</div>
                </div>
            </a>

            <a href="agenda_crud.php" class="stats-item stats-agenda">
                <div class="stats-icon"><i class="bi bi-calendar-check"></i></div>
                <div class="stats-info">
                    <div class="stats-value"><?= $total_agenda ?></div>
                    <div class="stats-label">Total Agenda</div>
                </div>
            </a>

            <a href="mandiri_crud.php" class="stats-item stats-pengguna">
                <div class="stats-icon"><i class="bi bi-person-lines-fill"></i></div>
                <div class="stats-info">
                    <div class="stats-value"><?= $total_pengguna ?></div>
                    <div class="stats-label">Total Pengguna</div>
                </div>
            </a>
        </div>
    </div>
</div>

</body>
</html>
