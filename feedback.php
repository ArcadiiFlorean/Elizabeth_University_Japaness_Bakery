<?php
include('includes/config.php');

// Procesare formular de feedback
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Validare date
    if (!empty($name) && !empty($email) && !empty($feedback)) {
        // Salvare feedback în baza de date
        $query = "INSERT INTO feedback (customer_name, customer_email, feedback_text, date_submitted) VALUES (?, ?, ?, NOW())";


        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $feedback);

        if ($stmt->execute()) {
            $message = "Mersi pentru feedback";
        } else {
            $message = "Eroare la trimiterea feedback-ului. Vă rugăm încercați mai târziu.";
        }
    } else {
        $message = "Vă rugăm completați toate câmpurile.";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimite Feedback</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normallisation.css">
</head>
<body>

<header class="header">

        <nav class="navbar">
            <a href="#" class="navbar__logo"><img src="./img/logo.jpg" alt="logo" class="logo"></a>
            <div class="navbar__menu">
   
            <ul class="navbar__items">
                <li class="navbar__list"><a class="navbar__link" href="menu.php">Meniul Zilnic</a></li>
                <li class="navbar__list"><a class="navbar__link" href="feedback.php">Trimite Feedback</a></li>
                <li class="navbar__list"><a class="navbar__link" href="contact.php">Contact</a></li>
                <li class="navbar__list"><a class="navbar__link" href="login.php">Autentificare</a></li>
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
