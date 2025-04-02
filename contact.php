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
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/normallisation.css">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <a href="index.php" class="navbar__logo"><img src="./img/logo.jpg" alt="logo" class="logo"></a>
        <ul class="navbar__items">
            <li class="navbar__list"><a class="navbar__link" href="index.php">Home</a></li>
            <li class="navbar__list"><a class="navbar__link" href="index.php#featured-products">Daily Menu</a></li>
            <li class="navbar__list"><a class="navbar__link" href="contact.php">Contact</a></li>
            <li class="navbar__list">
                <button class="back-button" onclick="window.history.back();" aria-label="Go back">Back</button>
            </li>
        </ul>
    </nav>
</header>

<section class="contact-section">
    <div class="container">
        <div class="contact-info-content">
            
            <div class="contact-info-header">
                <h1>Contactează-ne</h1>
                <p>f you have any questions, please fill out the form or use the contact details.
                </p>
           

            <div class="contact-info">
                <p><strong>Telefon:</strong> <a href="tel:<?php echo htmlspecialchars($settings['phone']); ?>"><?php echo htmlspecialchars($settings['phone']); ?></a></p>
                <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($settings['email']); ?>"><?php echo htmlspecialchars($settings['email']); ?></a></p>
                <p><strong>Adresă:</strong> <?php echo htmlspecialchars($settings['address']); ?></p>
                <p><strong>Luni:</strong> <?php echo htmlspecialchars($settings['monday_hours']); ?></p>
<p><strong>Marți:</strong> <?php echo htmlspecialchars($settings['tuesday_hours']); ?></p>
<p><strong>Miercuri:</strong> <?php echo htmlspecialchars($settings['wednesday_hours']); ?></p>
<p><strong>Joi:</strong> <?php echo htmlspecialchars($settings['thursday_hours']); ?></p>
<p><strong>Vineri:</strong> <?php echo htmlspecialchars($settings['friday_hours']); ?></p>
<p><strong>Sâmbătă:</strong> <?php echo htmlspecialchars($settings['saturday_hours']); ?></p>
<p><strong>Duminică:</strong> <?php echo htmlspecialchars($settings['sunday_hours']); ?></p>
            <div class="contact-form">
                <form method="POST" action="send_contact.php">
                    <label for="name">Nume:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Mesaj:</label>
                    <textarea id="message" name="message" required></textarea>

                    <button type="submit">Trimite</button>
                </form>
               
            </div>
           
             </div>

        </div>
        <img src="./img/Logo_inalt.png" alt="" class="contact-img">
    </div>
</section>

<footer class="footer">
        <div class="footer-content">

        

        <p>Sweet Treats - Toate drepturile rezervate &copy; 1817</p>

        </div>
    
    </footer>




<!-- <section class="map-section">
    <div class="container">
        <h2>Ne găsești aici:</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13623.867847647598!2d-1.1349863748231142!3d53.52110755410088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48790e85c178ab89%3A0xa0357f24c5532956!2sSouth%20Yorkshire%20Aircraft%20Museum!5e0!3m2!1sro!2suk!4v1742506444736!5m2!1sro!2suk"
            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section> -->



</body>
</html>
