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
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }

        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            background-color: #1e293b;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            border-bottom: 1px solid #475569;
            padding-bottom: 10px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            padding: 12px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #334155;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .admin-header {
            background: linear-gradient(to right, #304352, #485563);
            padding: 24px 30px;
            border-radius: 8px;
            color: white;
            margin-bottom: 25px;
        }

        .admin-name {
            font-weight: bold;
            border-bottom: 2px solid rgba(255, 255, 255, 0.4);
        }

        .stats-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
        }

        .stats-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
        }

        .stats-item {
            flex: 1;
            min-width: 180px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: inherit;
        }

        .stats-item:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .stats-artikel {
            background-color: rgba(182, 227, 48, 0.5);
        }

        .stats-agenda {
            background-color: rgba(48, 224, 115, 0.5);
        }

        .stats-pengguna {
            background-color: rgba(48, 134, 224, 0.5);
        }

        .stats-icon i {
            font-size: 2.5rem;
        }

        .stats-info {
            display: flex;
            flex-direction: column;
        }

        .stats-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-top: 5px;
        }

        .stats-label {
            color: #666;
            font-size: 14px;
            margin-top: 3px;
        }

        .btn-danger {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dashboard Admin</h2>
    <a href="dashboard.php"><i class="bi bi-house-door"></i> Dashboard</a>
    <a href="artikel_crud.php"><i class="bi bi-journal-text"></i> Kelola Artikel</a>
    <a href="agenda_crud.php"><i class="bi bi-calendar-event"></i> Kelola Agenda</a>
    <a href="mandiri_crud.php"><i class="bi bi-people"></i> Kelola Pengguna</a>
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
