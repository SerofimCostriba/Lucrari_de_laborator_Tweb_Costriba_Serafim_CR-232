<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "agroshop_db"; 

// Creare conexiune
$conn = new mysqli($servername, $username, $password, $database);

// Verificare conexiune
if ($conn->connect_error) {
    die("Eroare la conectare: " . $conn->connect_error);
}
?>
