<?php
session_start();
include('includes/config.php');

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preia datele din formular
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validare câmpuri
    if (!empty($username) && !empty($password)) {
        // Protejarea datelor împotriva injecției SQL
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        // Căutarea utilizatorului în baza de date
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifică dacă utilizatorul există
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verifică parola
            if (password_verify($password, $row['password'])) {
                // Parola este corectă, setăm sesiunea
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;

                // Redirecționează administratorul la dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Parola este incorectă!";
            }
        } else {
            $message = "Utilizatorul nu a fost găsit!";
        }
    } else {
        $message = "Vă rugăm completați toate câmpurile!";
    }
} else {
    $message = "Acces nepermis!";
}

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
            <h2>Autentificare</h2>
            <form action="process_login.php" method="POST">
                <label for="username">Nume utilizator:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Autentificate</button>
            </form>

            <?php if (isset($message)) { echo "<p class='error'>$message</p>"; } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
