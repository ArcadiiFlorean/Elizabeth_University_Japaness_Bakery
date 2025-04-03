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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header class="header">
    <nav class="navbar">
        <a href="index.php" class="navbar__logo"><img src="./img/Logo_2.png" alt="logo" class="logo"></a>
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
            <h1>Contact Us</h1>
                <p>If you have any questions, please fill out the form or use the contact details.
                </p>
           

            <div class="contact-info">
            <p><strong>Phone:</strong> <a href="tel:<?php echo htmlspecialchars($settings['phone']); ?>"><?php echo htmlspecialchars($settings['phone']); ?></a></p>
<p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($settings['email']); ?>"><?php echo htmlspecialchars($settings['email']); ?></a></p>
<p><strong>Address:</strong> <?php echo htmlspecialchars($settings['address']); ?></p>
<p><strong>Monday:</strong> <?php echo htmlspecialchars($settings['monday_hours']); ?></p>
<p><strong>Tuesday:</strong> <?php echo htmlspecialchars($settings['tuesday_hours']); ?></p>
<p><strong>Wednesday:</strong> <?php echo htmlspecialchars($settings['wednesday_hours']); ?></p>
<p><strong>Thursday:</strong> <?php echo htmlspecialchars($settings['thursday_hours']); ?></p>
<p><strong>Friday:</strong> <?php echo htmlspecialchars($settings['friday_hours']); ?></p>
<p><strong>Saturday:</strong> <?php echo htmlspecialchars($settings['saturday_hours']); ?></p>
<p><strong>Sunday:</strong> <?php echo htmlspecialchars($settings['sunday_hours']); ?></p>

            <div class="contact-form">
            <form method="POST" action="send_contact.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">Send</button>
</form>

               
            </div>
           
             </div>

        </div>
        
         <div class="map-section">
    <div class="container">
   
        <img src="./img/Logo_2.png" alt="" class="contact-img">
        <div class="contact-social-container">
                <div class="content-social">
                    <a href="https://facebook.com" class="footer-social__icon" aria-label="Facebook">
                        <i class="bi bi-facebook" style="font-size: 26px;"> Facebook</i>
                    </a>
                    <a href="https://instagram.com" class="footer-social__icon" aria-label="Instagram">
                        <i class="bi bi-instagram" style="font-size: 26px;"> Instagram</i>
                    </a>
                    <a href="https://twitter.com" class="footer-social__icon" aria-label="Twitter">
                        <i class="bi bi-twitter" style="font-size: 26px;"> Twiter</i>
                    </a>
                </div>
              
                <div class="social-share">
                    <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href))">
                        <span>Partajează pe Facebook</span>
                    </button>
                    <button onclick="window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href))">
                        <span>Partajează pe Twitter</span>
                    </button>
                </div>
            </div>
            <h2>You can find us here:</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13623.867847647598!2d-1.1349863748231142!3d53.52110755410088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48790e85c178ab89%3A0xa0357f24c5532956!2sSouth%20Yorkshire%20Aircraft%20Museum!5e0!3m2!1sro!2suk!4v1742506444736!5m2!1sro!2suk"
            width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
        </div>

    </div>
</section>

<footer class="footer">
        <div class="footer-content">

        
        <p>Sweet Treats - All rights reserved &copy; 1817</p>


        </div>
    
    </footer>







</body>
</html>
