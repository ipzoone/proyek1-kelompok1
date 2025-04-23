<?php
include "db.php";
session_start();

// Proteksi halaman
if (!isset($_SESSION['is_admin_logged_in']) || $_SESSION['is_admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
$total_artikel_result = $conn->query("SELECT COUNT(*) AS total_artikel FROM artikel");
$total_artikel = $total_artikel_result->fetch_assoc()['total_artikel'];

//Menghitung total agenda 
$total_agenda_result = $conn->query("SELECT COUNT(*) AS total_agenda FROM agenda");
$total_agenda = $total_agenda_result->fetch_assoc()['total_agenda'];

// // Menghitung total pengguna
$total_pengguna_result = $conn->query("SELECT COUNT(*) AS total_pengguna FROM masyarakat");
$total_pengguna = $total_pengguna_result->fetch_assoc()['total_pengguna'];

// Simpan nama admin dari session
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
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            color: #333;
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
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #334155;
        }
        .btn btn-danger {
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

.admin-header {
    background: linear-gradient(to right, #304352, #485563);
    padding: 24px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 25px;
}

.welcome-text {
    color: #ffffff;
    font-size: 22px;
    font-weight: 500;
    margin: 0;
    letter-spacing: 0.3px;
}

.admin-name {
    font-weight: 700;
    position: relative;
    padding-bottom: 2px;
}

.admin-name::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 2px;
}

        .card {
            background-color: white;
            padding: 25px;
            margin-top: 25px;
            border-radius: 10px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
        }

        .logout-btn {
            background-color: crimson;
            color: white;
            border: none;
            padding: 10px 25px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 6px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: darkred;
        }
        .logout{
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            margin-top: 20px;
        }

        .crud-links {
            margin-top: 30px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .crud-links a {
            background-color: #3b82f6;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .crud-links a:hover {
            background-color: #2563eb;
        }
        .stats-card {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 800px;
    margin: 20px auto;
}

.stats-header {
    padding-bottom: 15px;
    margin-bottom: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.stats-title {
    color: #333;
    font-size: 22px;
    margin: 0;
    font-weight: 600;
}

.stats-subtitle {
    color: #777;
    font-size: 14px;
    margin-top: 5px;
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
    display: flex;
    align-items: center;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.stats-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
}

.stats-icon {
    background:rgb(199, 40, 31);
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 20px;
}

.stats-item:nth-child(2) .stats-icon {
    background: #6c5ce7;
}

.stats-item:nth-child(3) .stats-icon {
    background:rgb(128, 223, 12);
}

.stats-value {
    font-size: 24px;
    font-weight: 700;
    color: #333;
}

.stats-label {
    color: #666;
    font-size: 14px;
    margin-top: 5px;
}
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dashboard Admin</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="artikel_crud.php">Kelola Artikel</a>
    <a href="agenda_crud.php">Kelola Agenda</a>
    <a href="mandiri_crud.php">Kelola Pengguna</a>
    <a href="home.php" class="btn btn-danger">Logout</a>
</div>

<div class="main">
<div class="admin-header">
    <h1 class="welcome-text">Selamat Datang, <span class="admin-name"><?= htmlspecialchars($adminName); ?></span></h1>
</div>

    <div class="stats-card">
    <div class="stats-header">
        <h2 class="stats-title">Statistik Dashboard</h2>
        <div class="stats-subtitle">Ringkasan data sistem</div>
    </div>
    
    <div class="stats-container">
        <div class="stats-item">
            <div class="stats-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stats-info">
                <div class="stats-value"><?= $total_artikel ?></div>
                <div class="stats-label">Total Artikel</div>
            </div>
        </div>
        
        <div class="stats-item">
            <div class="stats-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stats-info">
                <div class="stats-value"><?= $total_agenda ?></div>
                <div class="stats-label">Total Agenda</div>
            </div>
        </div>
        
        <div class="stats-item">
            <div class="stats-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stats-info">
                <div class="stats-value"><?= $total_pengguna ?></div>
                <div class="stats-label">Total Pengguna</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
