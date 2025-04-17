<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "agroshop_db";

$conn = new mysqli($servername, $username, $password, $database);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// Preluare termen căutare (dacă există)
$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
}

// Interogare produse cu sau fără filtrare
$sql = "SELECT * FROM produse";
if (!empty($search)) {
    $sql .= " WHERE nume LIKE '%$search%' OR descriere LIKE '%$search%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>AgroShop - Produse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style_produse.css">
</head>
<body>

    <!-- Navigare principală -->
    <header>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">AgroShop</a></li>
                <li><a href="index_Produse.php">Produse</a></li>
                <li><a href="index_Despre_noi.php">Despre noi</a></li>
                <li><a href="index_Contacte.php">Contact</a></li>
            </ul>
        </nav>

        <!-- Navigare categorii -->
        <nav class="categories-navbar">
            <ul>
                <li><a href="#">Instrumente</a></li>
                <li><a href="#">Motocultoare</a></li>
                <li><a href="#">Cereale</a></li>
                <li><a href="#">Plante medicinale</a></li>
                <li><a href="#">Animale</a></li>
                <li><a href="copaci.php">Copaci</a></li>
                <li><a href="#">Apicultură</a></li>
                <li><a href="#">Condimente</a></li>
                <li><a href="#">Uleiuri</a></li>
                <li><a href="#">Produse bio</a></li>
                <li><a href="#">Semințe</a></li>
                <li><a href="#">Plante ornamentale</a></li>
                <li><a href="#">Îngrășăminte</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Căutare și buton adăugare -->
        <div style="margin-top: 120px; text-align: center;">
            <form method="GET" action="">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Caută produse..." 
                    value="<?php echo htmlspecialchars($search); ?>" 
                    style="padding: 10px; width: 250px;"
                >
                <button 
                    type="submit" 
                    style="padding: 10px; background-color: #145a32; color: white; border: none; border-radius: 5px;"
                >
                    Caută
                </button>
            </form>

            <br>

            <button 
                onclick="window.location.href='adauga_produs.php'" 
                style="padding: 10px 20px; background-color: #145a32; color: white; border: none; border-radius: 5px;"
            >
                + Adaugă produs
            </button>
        </div>

        <!-- Afișare produse -->
        <section class="product-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img 
                            src="Image/Produse/<?php echo htmlspecialchars($row['imagine']); ?>" 
                            alt="<?php echo htmlspecialchars($row['nume']); ?>"
                        >
                        <h3><?php echo htmlspecialchars($row['nume']); ?></h3>
                        <p><?php echo htmlspecialchars($row['descriere']); ?></p>
                        <span>Preț: <?php echo htmlspecialchars($row['pret']); ?> RON</span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="margin-top: 30px;">Nu s-au găsit produse.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 AgroShop - Toate drepturile rezervate.</p>
    </footer>

</body>
</html>
