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

//Menghitung total agenda (misalnya dari tabel agenda)
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

        .header {
            background-color: #22c55e;
            padding: 20px;
            color: white;
            font-size: 24px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            border-radius: 10px;
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
    <div class="header">
        <h1>Selamat Datang, <?= htmlspecialchars($adminName); ?>!</h1>
    </div>

    <div class="card">
    <h3>Statistik</h3>
    <ul>
        <li>Total Artikel: <?= $total_artikel ?></li>
        <li>Total Agenda: <?= $total_agenda ?></li>
        <li>Total Pengguna: <?= $total_pengguna ?></li>
    </ul>
    <!-- <form action="logout.php" method="post">
        <button class="logout-btn">Logout</button>
    </form> -->
</div>

</body>
</html>
