<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "agroshop_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Adăugare produs
$mesaj = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $conn->real_escape_string($_POST["nume"]);
    $descriere = $conn->real_escape_string($_POST["descriere"]);
    $pret = floatval($_POST["pret"]);
    $imagine = basename($_FILES["imagine"]["name"]);

    // Salvează imaginea în folder
    $target_dir = "Image/Produse/";
    $target_file = $target_dir . $imagine;
    move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file);

    // Inserare în baza de date
    $sql = "INSERT INTO produse (nume, descriere, pret, imagine)
            VALUES ('$nume', '$descriere', '$pret', '$imagine')";

    if ($conn->query($sql) === TRUE) {
        $mesaj = "Produs adăugat cu succes!";
    } else {
        $mesaj = "Eroare: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Adaugă produs - AgroShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background-color: #f0f0f0; }
        form { max-width: 500px; margin: auto; background: white; padding: 30px; border-radius: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { background-color: #145a32; color: white; padding: 10px 20px; border: none; border-radius: 5px; }
        .success { color: green; text-align: center; }
        .back { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Adaugă un produs nou</h2>

<?php if (!empty($mesaj)): ?>
    <p class="success"><?php echo $mesaj; ?></p>
<?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="nume">Nume produs:</label>
    <input type="text" name="nume" required>

    <label for="descriere">Descriere:</label>
    <textarea name="descriere" rows="4" required></textarea>

    <label for="pret">Preț (RON):</label>
    <input type="number" step="0.01" name="pret" required>

    <label for="imagine">Imagine produs:</label>
    <input type="file" name="imagine" accept="image/*" required>

    <button type="submit">Adaugă produs</button>
</form>

<div class="back">
    <a href="index_Produse.php">← Înapoi la listă produse</a>
</div>

</body>
</html>
