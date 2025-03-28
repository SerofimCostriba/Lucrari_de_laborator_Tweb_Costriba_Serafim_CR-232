<?php
// Încarcă fișierele necesare pentru conexiunea la baza de date
include('db_connection.php');  // Fișierul care conține conexiunea la DB

// Verifică dacă formularul de autentificare a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login-username'];  // Preia numele de utilizator
    $password = $_POST['login-password'];  // Preia parola

    // Protejează împotriva atacurilor de tip SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Verifică în baza de date dacă există un utilizator cu acest nume și parolă
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";  // Ar trebui să folosești un hash pentru parola în loc de stocarea parolelor clare
    $result = mysqli_query($conn, $query);

    // Dacă utilizatorul există, îl logăm
    if (mysqli_num_rows($result) > 0) {
        // Poți salva informațiile utilizatorului în sesiune
        session_start();
        $_SESSION['username'] = $username;  // Salvează utilizatorul în sesiune
        header("Location: dashboard.php");  // Redirect către pagina de dashboard sau altă pagină protejată
    } else {
        echo "Nume utilizator sau parolă incorectă!";
    }
}
?>
