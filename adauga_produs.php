<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "agroshop_db";

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Conexiune eșuată: " . $conn->connect_error]);
    exit;
}

// Adăugare produs prin AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nume = $conn->real_escape_string($_POST["nume"]);
    $descriere = $conn->real_escape_string($_POST["descriere"]);
    $pret = floatval($_POST["pret"]);

    if (isset($_FILES["imagine"])) {
        $imagine = basename($_FILES["imagine"]["name"]);
        $target_dir = "Image/Produse/";
        $target_file = $target_dir . $imagine;

        if (move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO produse (nume, descriere, pret, imagine)
                    VALUES ('$nume', '$descriere', '$pret', '$imagine')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["status" => "success", "message" => "Produs adăugat cu succes!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Eroare la salvare în baza de date: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Eroare la încărcarea imaginii."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Imaginea este necesară."]);
    }
    exit;
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
        .error { color: red; text-align: center; }
        .back { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Adaugă un produs nou</h2>

<p id="mesaj" class=""></p>

<form id="formular-produs" enctype="multipart/form-data">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#formular-produs').submit(function(e) {
        e.preventDefault(); // Previne trimiterea standard a formularului

        const formData = new FormData(this);
        const mesaj = $('#mesaj');

        // Curățăm mesajele anterioare
        mesaj.text('');
        mesaj.removeClass('success error');

        $.ajax({
            url: 'adauga_produs.php',
            type: 'POST',
            data: formData,
            contentType: false, // Important pentru trimiterea fișierelor
            processData: false, // Important pentru trimiterea fișierelor
            success: function(data) {
                const response = JSON.parse(data);

                // Mesajul de succes sau eroare
                if (response.status === 'success') {
                    mesaj.addClass('success');
                    mesaj.text(response.message);
                    $('#formular-produs')[0].reset(); // Resetează formularul
                } else {
                    mesaj.addClass('error');
                    mesaj.text(response.message);
                }
            },
            error: function() {
                mesaj.addClass('error');
                mesaj.text('Eroare la trimiterea datelor.');
            }
        });
    });
</script>

</body>
</html>
