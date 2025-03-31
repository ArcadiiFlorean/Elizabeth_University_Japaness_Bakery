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

<header class="header">
        <nav class="navbar">
            <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">
                <img src="../img/logo.jpg" alt="Sweet Treats Logo" class="logo">
            </a>
            <div class="navbar__menu">
                <ul class="navbar__items">
                    <li class="navbar__list">
                    <a class="navbar__link" href="../index.php#featured-products" aria-label="Daily menu">Daily Menu</a>

                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="feedback.php" aria-label="Submit feedback">Submit Feedback</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="contact.php" aria-label="Contact us">Contact</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="./admin/process_login.php" aria-label="Login">Login</a>
                    </li>
                </ul>
                <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Open menu">
                    &#9776; <!-- Hamburger menu character -->
                </div>
            </div>
        </nav>
    </header>

    <div class="dashboard-container">
        <h2>Bine ai venit, Admin!</h2>
        <nav>
            <ul>
                <li><a href="../add_product.php">Add Product</a></li>
                <li><a href="update_menu.php">Actualizare Meniu</a></li>
                <li><a href="view_feedback.php">Vizualizare Feedback</a></li>
                <li><a href="logout.php">Deconectare</a></li>
            </ul>
        </nav>
        <p>Selectează o opțiune din meniul de administrare.</p>
    </div>



</body>
</html>
