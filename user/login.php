<?php
include('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['login-username']);
    $password = trim($_POST['login-password']);

    // Căutăm utilizatorul după username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    // Dacă utilizatorul există
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificăm parola criptată
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];

            header("Location: ../index.php"); // sau altă pagină
            exit;
        } else {
            echo "Nume utilizator sau parolă incorectă!";
        }
    } else {
        echo "Nume utilizator sau parolă incorectă!";
    }

    $stmt->close();
}
?>
