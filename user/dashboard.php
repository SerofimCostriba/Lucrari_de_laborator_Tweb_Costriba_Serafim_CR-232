<?php
session_start();

// Verificăm dacă utilizatorul este autentificat
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirecționăm către login dacă nu este autentificat
    exit;
}

echo "Bun venit, " . $_SESSION['username'] . "!";
?>
<a href="logout.php">Deconectează-te</a>
