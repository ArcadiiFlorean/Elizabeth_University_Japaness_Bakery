<?php
session_start();

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bine ai venit, Admin!</h2>
        <nav>
            <ul>
                <li><a href="update_menu.php">Actualizare Meniu</a></li>
                <li><a href="view_feedback.php">Vizualizare Feedback</a></li>
                <li><a href="logout.php">Deconectare</a></li>
            </ul>
        </nav>
        <p>Selectează o opțiune din meniul de administrare.</p>
    </div>
</body>
</html>
