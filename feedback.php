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
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $feedback = trim($_POST['feedback']);

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
        $_SESSION['feedback_message'] = "Mulțumim pentru feedback-ul tău!";
        $_SESSION['feedback_content'] = $feedback;
    } else {
        $_SESSION['feedback_message'] = "A apărut o eroare la trimiterea feedback-ului.";
    }

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
    <title>Sweet Treats - Feedback</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/normallisation.css">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <a href="index.php" class="navbar__logo"><img src="./img/logo.jpg" alt="logo" class="logo"></a>
        <div class="navbar__menu">
            <ul class="navbar__items">
                <li class="navbar__list"><a class="navbar__link" href="index.php">Home</a></li>
                <li class="navbar__list"><a class="navbar__link" href="index.php#featured-products">Daily Menu</a></li>
                <li class="navbar__list"><a class="navbar__link" href="./contact.php">Contact</a></li>
                <li class="navbar__list">
                    <button class="back-button" onclick="window.history.back();" aria-label="Go back">Back</button>
                </li>
            </ul>
            <div class="hamburger-menu" onclick="toggleMenu()">&#9776;</div>
        </div>
    </nav>
</header>

<div class="feedback-form-container">
    <h1>Trimite Feedback</h1>

    <?php if (isset($_SESSION['feedback_message'])): ?>
        <div class="feedback-message">
            <p><?php echo htmlspecialchars($_SESSION['feedback_message']); ?></p>
        </div>
        <?php unset($_SESSION['feedback_message']); ?>
    <?php endif; ?>

    <form method="POST" action="feedback.php" class="feedback-form">
        <label for="name">Numele dumneavoastră:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea><br>

        <button type="submit" name="submit">Send Feedback</button>
    </form>

    <a href="index.php">Back to main page</a>
</div>
</body>
</html>
