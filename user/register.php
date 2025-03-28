<?php
header("Location: ../index.php");
include 'db.php'; // Conectare la baza de date

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $confirm_password = $_POST['register-confirm-password'];

    // Validări
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Toate câmpurile sunt obligatorii.");
    }

    if ($password !== $confirm_password) {
        die("Parolele nu se potrivesc.");
    }

    // Criptăm parola
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verificăm dacă utilizatorul există deja
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
    $stmt->execute([$username, $email]);
    if ($stmt->rowCount() > 0) {
        die("Utilizatorul sau emailul există deja.");
    }

    // Inserăm utilizatorul în baza de date
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $hashed_password]);

    echo "<script> 
    alert('Înregistrare reușită! Acum te poți autentifica.');
    </script>";

    exit();
}
?>