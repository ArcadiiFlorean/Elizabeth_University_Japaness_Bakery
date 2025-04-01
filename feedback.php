<?php
session_start();

// Include fișierul de configurare pentru conexiunea la baza de date
include('includes/config.php');

// Verifică conexiunea
if (!$conn) {
    die("Eroare la conexiunea cu baza de date: " . mysqli_connect_error());
}

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preia datele din formular
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Pregătește interogarea
    $query = "INSERT INTO feedback (name, email, feedback, submission_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);

    // Verifică dacă interogarea a fost pregătită corect
    if ($stmt === false) {
        die('Eroare la pregătirea interogării: ' . $conn->error);
    }

    // Leagă parametrii și execută interogarea
    $stmt->bind_param("sss", $name, $email, $feedback);

    // Verifică dacă execuția a avut succes
    if ($stmt->execute()) {
        // Setează mesajul de feedback în sesiune
        $_SESSION['feedback_message'] = "Mulțumim pentru feedback-ul tău!";
        // Salvează feedback-ul lăsat de utilizator în sesiune pentru a-l putea afișa pe pagina de confirmare
        $_SESSION['feedback_content'] = $feedback;
    } else {
        // Setează mesajul de eroare în sesiune
        $_SESSION['feedback_message'] = "A apărut o eroare la trimiterea feedback-ului.";
    }

    // Închide statement-ul
    $stmt->close();

    // Redirecționează înapoi la pagina de feedback
    header('Location: feedback.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sweet Treats - Japanese bakery with fresh products and customer feedback. Check out our daily menu!">
    <meta property="og:title" content="Sweet Treats - Japanese Bakery">
    <meta property="og:description" content="At Sweet Treats, we create delicious cakes and pastries made with love every day.">
    <meta property="og:image" content="./img/logo.jpg">
    <title>Sweet Treats - Homepage</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/normallisation.css">
</head>
<body>

<header class="header">

        <nav class="navbar">
            <a href="#" class="navbar__logo"><img src="./img/logo.jpg" alt="logo" class="logo"></a>
            <div class="navbar__menu">
   
            <ul class="navbar__items">
            <li class="navbar__list">
                        <a class="navbar__link" href="index.php" aria-label="Daily menu">Home</a>
                    </li>
                    <li class="navbar__list">
                    <a class="navbar__link" href="index.php#featured-products" aria-label="Daily menu">Daily Menu</a>

                    </li>
        
                <li class="navbar__list"><a class="navbar__link" href="./contact.php">Contact</a></li>
                <li class="navbar__list">
                    <button class="back-button" onclick="window.history.back();" aria-label="Go back">Back</button>
                </li>
            </ul>
            <div class="hamburger-menu" onclick="toggleMenu()">
      &#9776; <!-- Caracterul de meniu hamburger -->
    </div>
        </div>
        </nav>
    
</header>
    <div class="feedback-form">

        <h1>Trimite Feedback</h1>

        <?php if (isset($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="feedback.php">
            <label for="name">Numele dumneavoastră:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required></textarea><br><br>

            <button type="submit" name="submit">Send feedbak Feedback</button>
        </form>

        <a href="index.php">Back to main page</a>
    </div>
</body>
</html>
