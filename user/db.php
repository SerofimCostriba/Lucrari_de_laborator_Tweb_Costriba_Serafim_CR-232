<?php
$host = 'localhost'; // Gazda serverului MySQL
$dbname = 'agroshop_db'; // Numele bazei de date
$username = 'root'; // Numele utilizatorului MySQL
$password = ''; // Parola pentru utilizatorul MySQL

try {
    // Creăm conexiunea PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setăm erorile pentru a fi arătate
} catch (PDOException $e) {
    die("Conexiune eșuată: " . $e->getMessage());
}
?>
