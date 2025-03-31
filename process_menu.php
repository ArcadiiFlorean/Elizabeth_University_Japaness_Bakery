<?php
session_start();
include('includes/config.php');

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirecționează la login dacă nu este autentificat
    exit();
}

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preia datele din formular
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $item_price = $_POST['item_price'];

    // Validare câmpuri
    if (!empty($item_name) && !empty($item_description) && !empty($item_price)) {
        // Protejarea datelor împotriva injecției SQL
        $item_name = htmlspecialchars($item_name);
        $item_description = htmlspecialchars($item_description);
        $item_price = htmlspecialchars($item_price);

        // Verifică dacă prețul este un număr valid și mai mare decât 0
        if (is_numeric($item_price) && $item_price > 0) {
            // Căutarea de a adăuga un articol în baza de date
            $query = "INSERT INTO menu (item_name, item_description, item_price, date_added) 
                      VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssd", $item_name, $item_description, $item_price);

            // Execută interogarea
            if ($stmt->execute()) {
                // Dacă interogarea reușește, redirecționează la pagina de actualizare a meniului
                header("Location: update_menu.php?status=success");
                exit();
            } else {
                $message = "Eroare la adăugarea produsului! Vă rugăm încercați din nou.";
            }
        } else {
            $message = "Prețul trebuie să fie un număr valid și mai mare decât 0.";
        }
    } else {
        $message = "Vă rugăm completați toate câmpurile!";
    }
} else {
    $message = "Acces nepermis! Vă rugăm să utilizați formularul corespunzător.";
}

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizare Meniu - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sweet Treats - Actualizare Meniu</h1>
    </header>

    <main>
        <section class="menu-update">
            <h2>Adăugați un Nou Produs</h2>
            <form action="process_menu.php" method="POST">
                <label for="item_name">Nume Produs:</label>
                <input type="text" id="item_name" name="item_name" required>

                <label for="item_description">Descriere Produs:</label>
                <textarea id="item_description" name="item_description" required></textarea>

                <label for="item_price">Preț Produs:</label>
                <input type="number" id="item_price" name="item_price" step="0.01" required>

                <button type="submit">Adăugați Produs</button>
            </form>

            <?php if (isset($message)) { echo "<p class='error'>$message</p>"; } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
