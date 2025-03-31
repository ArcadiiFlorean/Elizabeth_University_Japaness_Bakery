<?php
include('includes/config.php');

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Validare date
    if (!empty($name) && !empty($email) && !empty($feedback)) {
        // Previne XSS și protejează datele
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $feedback = htmlspecialchars($feedback);

        // Salvează feedback-ul în baza de date
        $query = "INSERT INTO feedback (name, email, feedback, submission_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $feedback);

        // Verifică dacă inserarea a avut succes
        if ($stmt->execute()) {
            $message = "Mulțumim pentru feedback-ul dumneavoastră! Vom lua în considerare sugestiile și comentariile dumneavoastră.";
        } else {
            $message = "A apărut o eroare. Vă rugăm încercați mai târziu.";
        }
    } else {
        $message = "Vă rugăm completați toate câmpurile.";
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
    <title>Confirmare Feedback - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sweet Treats - Confirmare Feedback</h1>
        <nav>
            <ul>
                <li><a href="index.php">Pagina Principală</a></li>
                <li><a href="menu.php">Meniul Zilnic</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="confirmation">
            <h2>Confirmare</h2>
            <p><?php echo $message; ?></p>
            <a href="feedback.php">Înapoi la formularul de feedback</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
