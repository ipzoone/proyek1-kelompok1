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
$total_surat = $conn->query("SELECT COUNT(*) AS total_surat FROM pengajuan_surat")->fetch_assoc()['total_surat'];
$total_laporan = $conn->query("SELECT COUNT(*) AS total_laporan FROM laporan_warga")->fetch_assoc()['total_laporan'];

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
    <div class="admin-header mb-4">
        <h1 class="fw-bold">Selamat Datang, <span class="text-primary"><?= htmlspecialchars($adminName); ?></span></h1>
    </div>

    <h3 class="mb-3 text-center fw-bold">STATISTIK</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <a href="artikel_crud.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text display-4 text-primary mb-3"></i>
                        <h4 class="fw-bold"><?= $total_artikel ?></h4>
                        <p class="text-muted">Total Artikel</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="agenda_crud.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check display-4 text-success mb-3"></i>
                        <h4 class="fw-bold"><?= $total_agenda ?></h4>
                        <p class="text-muted">Total Agenda</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="mandiri_crud.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-lines-fill display-4 text-warning mb-3"></i>
                        <h4 class="fw-bold"><?= $total_pengguna ?></h4>
                        <p class="text-muted">Total Pengguna</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="pengajuan.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-envelope-fill display-4 text-dark mb-3"></i> 
                        <h4 class="fw-bold"><?= $total_surat ?></h4>
                        <p class="text-muted">Total Pengajuan</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="laporan.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-megaphone-fill display-4 text-danger mb-3"></i>
                        <h4 class="fw-bold"><?= $total_laporan ?></h4>
                        <p class="text-muted">Total Laporan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


</body>
</html>
