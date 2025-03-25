<?php
// Începem sesiunea
session_start();

// Distrugem toate variabilele de sesiune
session_unset();

// Distrugem sesiunea
session_destroy();

// Redirecționăm utilizatorul înapoi la pagina de login
header("Location: login.php");
exit();
?>
