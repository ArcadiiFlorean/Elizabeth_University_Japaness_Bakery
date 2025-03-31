<?php
// Include fișierul de configurare pentru conexiunea la baza de date
include('includes/config.php');

// Selectează produsele din meniul zilnic
$query = "SELECT * FROM menu";
$result = $conn->query($query);

// Verifică dacă există produse
$menu_items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
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

    <!-- Add Google Fonts if needed -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">
                <img src="./img/logo.jpg" alt="Sweet Treats Logo" class="logo">
            </a>
            <div class="navbar__menu">
                <ul class="navbar__items">
                    <li class="navbar__list">
                        <a class="navbar__link" href="menu.php" aria-label="Daily menu">Daily Menu</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="feedback.php" aria-label="Submit feedback">Submit Feedback</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="contact.php" aria-label="Contact us">Contact</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="./admin/process_login.php" aria-label="Login">Login</a>
                    </li>
                </ul>
                <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Open menu">
                    &#9776; <!-- Hamburger menu character -->
                </div>
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="main__welcome">
            <h1 class="main__title">Welcome to Sweet Treats! <span>Japanese bakery</span></h1>
            <p class="main__paragraf">日本のレストランは、寿司、刺身、天ぷら、ラーメンなどの新鮮な料理を提供します。落ち着いた雰囲気で、細部にこだわったデザインが特徴です。</p>
        </div>

        <section class="main__section main__section--intro">
            <div class="main__container">
                <div class="main__description">
                    <h2 class="main__section-title">About Us</h2>
                    <p class="main__section-text">At Sweet Treats, we create delicious cakes and pastries made with love every day. Come and try our fresh products!</p>
                </div>
                <img class="main__container--img" src="./img/logo.jpg" width="350" height="350" alt="Sweet Treats Logo">
            </div>
        </section>
        <section class="main__section main__section--featured-products">
    <h3 class="feature-product-title">Produsele Noastre</h3>
    <p class="feature-product-description">Produse proaspete și delicioase, pregătite zilnic cu drag.</p>
    <div class="feature-img">
    <?php foreach ($menu_items as $item): ?>
    <div class="menu-item">
        <h4><?php echo htmlspecialchars($item['item_name']); ?></h4>
        <p><?php echo htmlspecialchars($item['description']); ?></p>
        <p>Preț: <?php echo htmlspecialchars($item['price']); ?> Lei</p>
        <!-- Afișează imaginea -->
        <img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['item_name']); ?>" width="200">

    </div>
<?php endforeach; ?>

    </div>
</section>


        <section class="main__section main__section--customer-feedback">
            <div class="feedback">
                <h2 class="main__section-title">Customer Feedback</h2>
                <p class="main__section-text">We want to hear your opinion! Leave feedback and help us improve our products.</p>
                <!-- <img src="./img/logo.jpg" alt="Feedback logo" class="feedback__img"> -->
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="footer__text">&copy; 2025 Sweet Treats. All rights reserved.</p>
            <div class="footer__container">
                <nav class="footer__nav">
                    <ul class="footer__list">
                        <li class="footer__items">
                            <a href="#" class="footer__link">Home</a>
                        </li>
                        <li class="footer__items">
                            <a href="#" class="footer__link">About</a>
                        </li>
                        <li class="footer__items">
                            <a href="#" class="footer__link">Contact Us</a>
                        </li>
                        <li class="footer__items">
                            <a href="#" class="footer__link">Link</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script> <!-- Ensure you have a JS file for the hamburger menu -->
</body>
</html>
