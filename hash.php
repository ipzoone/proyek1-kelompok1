<?php
$hashedPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plainPassword = $_POST["password"];
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Generator Hash Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        input, button {
            padding: 8px;
            margin: 5px 0;
            width: 300px;
        }
        .output {
            margin-top: 15px;
            background-color: #f4f4f4;
            padding: 10px;
            width: fit-content;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Generator Hash Password (PHP)</h2>
    <form method="POST">
        <input type="text" name="password" placeholder="Masukkan password asli" required>
        <br>
        <button type="submit">Generate Hash</button>
    </form>

    <?php if (!empty($hashedPassword)): ?>
        <div class="output">
            <strong>Hash:</strong><br>
            <code><?= htmlspecialchars($hashedPassword) ?></code>
        </div>
    <?php endif; ?>
</body>
</html>
