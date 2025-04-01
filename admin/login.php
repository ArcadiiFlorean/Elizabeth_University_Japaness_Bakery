<?php
// Include fișierul de configurare și funcțiile necesare
include('../includes/config.php');
include('../includes/functions.php');

// Verificăm dacă s-au trimis datele de autentificare
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificăm autentificarea
    if (authenticate_admin($username, $password)) {
        // Dacă autentificarea este reușită, creăm o sesiune și redirecționăm către dashboard
        session_start();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Nume de utilizator sau parolă incorectă!";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare Administrator</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/normallisation.css">
</head>
<body>
<header class="header-admin">
        <nav class="navbar">
            <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">  
                <img src="../img/logo.jpg" alt="Sweet Treats Logo" class="logo" > Admin
              
            </a>
            <div class="navbar__menu">
                <ul class="navbar__items">
                <li class="navbar__list">
                        <a class="navbar__link" href="../index.php" aria-label="Daily menu">Home</a>
                    </li>
                    <li class="navbar__list">
                    <a class="navbar__link" href="../index.php#featured-products" aria-label="Daily menu">Daily Menu</a>



                    </li>
                    <li class="navbar__list">
                    <button class="back-button" onclick="window.history.back();" aria-label="Go back">Back</button>
                </li>
                
                   
                </ul>
                <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Open menu">
                    &#9776; <!-- Hamburger menu character -->
                </div>
            </div>
        </nav>
    </header>
    <section class="login-container">
        <div class="container">
             <h2>Autentificare Administrator</h2>

        <!-- Afișăm un mesaj de eroare dacă autentificarea nu a reușit -->
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Nume de utilizator</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Parolă</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Autentificare</button>
        </form>
        </div>
       
    </section>
</body>
</html>
