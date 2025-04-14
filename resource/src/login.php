<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    echo "Input Username: $username<br>";
    echo "Input Password: $password<br>";

    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        echo "Data ditemukan. Hash password di DB:<br>";
        echo $user["password"] . "<br>";

        if (password_verify($password, $user["password"])) {
            echo "Password cocok!<br>";
            $_SESSION["username"] = $username;
            header("Location: home.php");
            exit;
        } else {
            echo "Password TIDAK cocok!<br>";
        }
    } else {
        echo "Username tidak ditemukan di database!<br>";
    }
}
?>
