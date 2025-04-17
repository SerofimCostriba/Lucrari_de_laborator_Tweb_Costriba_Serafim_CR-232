<?php
$servername = "localhost";
$username = "root";
$password = ""; // fără parolă implicit în XAMPP
$dbname = "agroshop_db";

// Conectare DB
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Verificare conectare
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

// Preluare termen de căutare
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Căutare în tabel
$sql = "SELECT * FROM produse WHERE nume LIKE '%$search%'";
$result = $conn->query($sql);

// Colectăm datele
$produse = [];

while ($row = $result->fetch_assoc()) {
    $produse[] = $row;
}

// Răspuns JSON
echo json_encode($produse);
?>
