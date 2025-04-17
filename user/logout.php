<?php
session_start();
session_unset(); // Șterge variabilele din sesiune
session_destroy(); // Distruge sesiunea

header('Location: ../index.php'); // Redirecționăm utilizatorul către pagina de login
exit;
?>
