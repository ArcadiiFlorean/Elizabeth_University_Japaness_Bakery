<?php
include('includes/config.php');

// Preluarea datelor de contact
$query = "SELECT * FROM site_settings WHERE id=1";
$result = $conn->query($query);
$settings = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <a href="index.php" class="navbar__logo"><img src="./img/logo.jpg" alt="logo" class="logo"></a>
        <ul class="navbar__items">
            <li class="navbar__list"><a class="navbar__link" href="index.php">Home</a></li>
            <li class="navbar__list"><a class="navbar__link" href="index.php#featured-products">Daily Menu</a></li>
            <li class="navbar__list"><a class="navbar__link" href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<section class="contact">
    <h1>Contactează-ne</h1>
    <p>Ai întrebări? Completează formularul sau folosește datele de mai jos.</p>
    
    <div class="contact-info">
        <p><strong>Telefon:</strong> <a href="tel:<?php echo htmlspecialchars($settings['phone']); ?>"><?php echo htmlspecialchars($settings['phone']); ?></a></p>
        <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($settings['email']); ?>"><?php echo htmlspecialchars($settings['email']); ?></a></p>
        <p><strong>Adresă:</strong> <?php echo htmlspecialchars($settings['address']); ?></p>
    </div>
    
    <form method="POST" action="send_contact.php">
        <label for="name">Nume:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Mesaj:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Trimite</button>
    </form>
</section>

<section class="map">
    <h2>Ne găsești aici:</h2>
    <iframe src="<?php echo htmlspecialchars($settings['map_link']); ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>

</body>
</html>
