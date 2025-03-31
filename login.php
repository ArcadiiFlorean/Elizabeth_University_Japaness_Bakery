<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare Administrator - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sweet Treats - Autentificare Administrator</h1>
    </header>

    <main>
        <section class="login">
            <h2>Autentificare Administrator</h2>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo "<p class='error'>" . $_SESSION['login_error'] . "</p>";
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="process_login.php" method="POST">
                <label for="username">Nume utilizator:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Parola:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Autentifică-te</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
