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
                <img src="../img/Logo_2.png" alt="Sweet Treats Logo" class="logo" > 
              
            </a>
            <div class="navbar__menu">
                
       
            <div class="clock" id="clock">Loading...</div>
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
    <section class="login-section">
    <div class="container">
    <div class="login-content">
        <h2 class="login-title">Administrator Login</h2>

        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</div>

  

    
  
     
  

    </div>
</section>
<script src="../script/script.js"></script>
</body>
</html>
