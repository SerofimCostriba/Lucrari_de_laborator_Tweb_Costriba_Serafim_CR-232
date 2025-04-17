<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroShop</title>
  <link rel="stylesheet" href="CSS/style_index.css">
  <script id="background-data" type="application/json">
    [
      "../Image/forest_path_summer_125991_1920x1080.jpg",
      "../Image/803471.jpg",
      "../Image/803470.jpg",
      "../Image/803491.jpg",
      "../Image/803486.jpg"
    ]
  </script>
</head>
<body>
<?php session_start(); ?>
  <header>
    <nav class="navbar">
      <ul>
        <li><a href="index.php">AgroShop</a></li>
        <li><a href="index_Produse.php">Produse</a></li>
        <li><a href="index_Despre_noi.php">Despre noi</a></li>
        <li><a href="index_Contacte.php">Contact</a></li>
         <!-- Afișare dinamică în funcție de sesiune -->
         <?php if (isset($_SESSION['username'])): ?>
          <li><a href="user/logout.php" id="log_out">Logout</a></li>
        <?php else: ?>
          <li><a href="#" id="auth-btn">Autentificare</a></li>
        <?php endif; ?>
        
      </ul>
    </nav>

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

  <!-- Overlay și fereastra modală -->
  <div id="overlay" class="hidden"></div>
  <div id="auth-modal" class="hidden">
    <div class="modal-content">
      <span class="close-btn">&times;</span>
      <h2 id="modal-title">Autentificare</h2>

      <!-- Formularul de autentificare (vizibil inițial) -->
      <form id="auth-form" action="user/login.php" method="POST">
        <input type="text" name="login-username" placeholder="Nume utilizator" required>
        <input type="password" name="login-password" placeholder="Parolă" required>
        <button type="submit">Continuă</button>
      </form>
      

      <!-- Formularul de înregistrare (ascuns inițial) -->
      <form id="register-form" class="hidden" action="user/register.php" method="POST">
        <input type="text" name="register-username" placeholder="Nume utilizator" required>
        <input type="email" name="register-email" placeholder="Email" required>
        <input type="password" name="register-password" placeholder="Parolă" required>
        <input type="password" name="register-confirm-password" placeholder="Confirmă parola" required>
        <button type="submit">Înregistrează-te</button>
      </form>
      

      <!-- Linkuri pentru comutarea între formulare -->
      <p id="auth-question">
        <span id="back-arrow" style="display: none;"><a href="#" id="switch-to-login">&#8592;</a></span>
        <span id="switch-to-register-container">Nu ai cont? <a href="#" id="switch-to-register">Înregistrare</a></span>
      </p>
    </div>
  </div>

  <main>
    <div class="main-section">
      <h1>Bun venit la AgroShop!</h1>
      <div class="content-container">
        <p class="left-text">
          Bine ai venit la AgroShop, partenerul tău de încredere în agricultură!
          Cu pasiune pentru natură și respect pentru pământ, îți aducem cele mai bune produse și soluții
          pentru o agricultură prosperă!
          Fie că ești fermier, grădinar pasionat sau antreprenor în domeniul agricol, aici găsești tot ce ai
          nevoie pentru succes.
          Sămânță cu sămânță, creștem împreună! Oferim echipamente moderne, îngrășăminte de calitate și
          sfaturi profesioniste.
        </p>
        <img src="Image/emblema.png" alt="Emblema AgroShop" id="image_index">
        <ul class="right-text">
          <li>Echipamente moderne pentru un proces eficient și productiv</li>
          <li>Îngrășăminte de calitate pentru culturi sănătoase</li>
          <li>Soluții inovatoare adaptate agriculturii moderne</li>
          <li>Sfaturi profesioniste pentru fiecare etapă a cultivării</li>
          <li>Utilaje agricole performante pentru eficiență ridicată</li>
          <li>Sisteme de irigare inteligente pentru utilizarea optimă a apei</li>
          <li>Pesticide și fungicide eficiente pentru protecția culturilor</li>
          <li>Semințe certificate cu randament ridicat</li>
          <li>Substraturi și turbă de calitate</li>
          <li>Tehnologii de automatizare pentru monitorizarea culturilor</li>
        </ul>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 AgroShop - Toate drepturile rezervate.</p>
  </footer>

  <script src="js/index.js"></script>

  <!-- <script>
    function logout() {
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
    document.getElementById('log-out')

}

  </script> -->
</body>
</html>
