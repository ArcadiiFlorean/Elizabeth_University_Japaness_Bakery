<?php
// Include fișierul de configurare pentru conexiunea la baza de date
include('includes/config.php');

// Selectează produsele din meniul zilnic
$query = "SELECT * FROM products";  // Modifică de la 'menu' la 'products'

$result = $conn->query($query);

// Verifică dacă există produse
$menu_items = [];
if ($result === false) {
    echo "Eroare la interogarea bazei de date: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

// Începe sesiunea pentru a accesa mesajul de feedback
// session_start();

// Verifică dacă există un mesaj de feedback
if (isset($_SESSION['feedback_message'])) {
    $feedback_message = $_SESSION['feedback_message'];
    unset($_SESSION['feedback_message']);  // Șterge mesajul din sesiune după ce a fost afișat
} else {
    $feedback_message = '';
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sweet Treats - Japanese bakery with fresh products and customer feedback. Check out our daily menu!">
    <meta property="og:title" content="Sweet Treats - Japanese Bakery">
    <meta property="og:description" content="At Sweet Treats, we create delicious cakes and pastries made with love every day.">
    <meta property="og:image" content="./img/logo.jpg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Sweet Treats - Homepage</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/normallisation.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">
                <img src="./img/Logo_2.png" alt="Sweet Treats Logo" class="logo">
            </a>
            <div class="navbar__menu">
                <ul class="navbar__items">
                    <li class="navbar__list">
                        <a class="navbar__link" href="index.php" aria-label="Daily menu">Home</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="#featured-products" aria-label="Daily menu">Daily Menu</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="feedback.php" aria-label="Submit feedback">Submit Feedback</a>
                    </li>
                    <li class="navbar__list">
    <a class="navbar__link" href="#about" aria-label="About us">The Legend </a>
</li>

                    <li class="navbar__list">
                        <a class="navbar__link" href="./contact.php" aria-label="Contact us">Contact</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="./admin/login.php" aria-label="Login">Admin</a>
                    </li>
                </ul>
                <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Open menu">
                    &#9776; <!-- Hamburger menu character -->
                </div>
            </div>
        </nav>
    </header>

    <main class="main">
        <!-- <div class="main__welcome">
            <h1 class="main__title">Welcome to Sweet Treats! <span>Japanese bakery</span></h1>
            <p class="main__paragraf">日本のレストランは、寿司、刺身、天ぷら、ラーメンなどの新鮮な料理を提供します。落ち着いた雰囲気で、細部にこだわったデザインが特徴です。</p>

        </div> -->

        <div class="slider-container">
        <div class="slides">
    <div class="slide" style="background-image: url('../img/contact_img.jpg');"></div>
    <div class="slide" style="background-image: url('img/contact_img2.jpg');"></div>
    <div class="slide" style="background-image: url('img/contact_img3.jpg');"></div>
</div>

        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
        

        <!-- Secțiune pentru mesajul de feedback -->
        <?php if ($feedback_message != ''): ?>
            <section class="confirmation">
                <h2>Confirmare Feedback</h2>
                <p><?php echo $feedback_message; ?></p>
            </section>
        <?php endif; ?>

        <section id="featured-products" class="main__section main__section--featured-products">
            <h3 class="feature-product-title">Menu of the Day – Heavenly Bakery Delights </h3>
            <p class="feature-product-description">新鮮で美味しいお菓子、毎日愛情を込めて作っています！</p>
            <div class="menu_container">
                <?php foreach ($menu_items as $item): ?>
                    <div class="menu-item">
                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <p>Preț: <?php echo htmlspecialchars($item['price']); ?> Lei</p>
                        <img class="menu_img" src="./admin/<?php echo htmlspecialchars($item['image']); ?>" 
                             alt="<?php echo htmlspecialchars($item['name']); ?>" 
                          > 
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <section id="about" class="section-legend">
        <div class="container">

<div class="legend-container">
        <div class="legend-content">
            <h2>The Legend</h2>
            <p> In a small village hidden in the mountains of Japan, the people believed that the spirit of the mountain, Kashi-no-Kami, had gifted them the sacred knowledge of baking bread and sweets. These divine creations were filled with the essence of the earth, sky, and eternal seasons, and those who tasted them were blessed with luck and a long, prosperous life. </p> <p> As time passed, the craft of baking was perfected, and the breads and cakes reflected the aroma of the sacred ingredients from around the mountain — matcha from the green tea fields, red beans from the sacred valleys, and golden rice grown under the watchful eyes of the gods. Only a few chosen ones had access to the ancestral recipes, and they baked with a divine touch, creating products of ethereal beauty that seemed to glow. </p> <p> A young baker, Akihiko, who came from a family of bakers with a centuries-old tradition, discovered an ancient scroll in a sacred temple of the mountain. The scroll, written in a forgotten language, contained a mysterious recipe that could summon the spirits of the harvest. Inspired by visions and guided by the wisdom of his ancestors, Akihiko experimented with the recipe, adding traditional ingredients and a touch of magic. In this way, he created a cake so delicious that those who tasted it had visions of the mountain gods and were transported into a dreamlike world. </p> <p> Soon, Akihiko's pastry shop became famous, attracting travelers from all corners of the world who came to taste his magical creations. Many believed the recipes had the power to grant immortality, while others thought they opened a gateway to the spirit world. Today, the tradition continues in a pastry shop in the heart of a bustling city, bringing the magic and ancient wisdom of Japan into every loaf of bread, cake, and bite. With each creation, we keep the connection with the gods, the earth, and the sky alive, ensuring that our magic will endure for future generations. </p>
        </div>
        <div class="legend-image">
            <img class="about-image" src="./img/chef__contact.png" loading="lazy" alt="About Us" />
        </div>
    </div>

        </div>
    
</section>

<section class="social-section">
    <div class="container">
        <div class="social-content">
            <div class="social-img">
                <img src="./img/IMG_legend.avif" width="650px" alt="">
            </div>
            <div class="social-container">
                <div class="content-social">
                    <a href="https://facebook.com" class="footer-social__icon" aria-label="Facebook">
                        <i class="bi bi-facebook" style="font-size: 26px;"></i>
                    </a>
                    <a href="https://instagram.com" class="footer-social__icon" aria-label="Instagram">
                        <i class="bi bi-instagram" style="font-size: 26px;"></i>
                    </a>
                    <a href="https://twitter.com" class="footer-social__icon" aria-label="Twitter">
                        <i class="bi bi-twitter" style="font-size: 26px;"></i>
                    </a>
                </div>
                <div class="social-text">
                    <p>
                        Our centuries-old history continues to bring the magic of tradition into every product.
                        Join our community and share the story of this legendary bakery! Follow us for the latest
                        updates and special offers, and don't forget to share with your loved ones to keep our
                        tradition alive in every corner of the world!
                    </p>
                </div>
                <div class="social-share">
    <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href))">
        <span>Share on Facebook</span>
    </button>
    <button onclick="window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href))">
        <span>Share on Twitter</span>
    </button>
</div>

            </div>
        </div>
    </div>
</section>



<!-- Includeți CSS și JS pentru slider -->


    <footer class="footer">
        <div class="footer-content">

        

        <p>Sweet Treats - Toate drepturile rezervate &copy; 1817</p>

        </div>
    
    </footer>


    <div id="menuModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h4 id="modalTitle"></h4>
        <p id="modalDescription"></p>
        <p id="modalPrice"></p>
        <img id="modalImage" src="" alt="">
    </div>
</div>
<script src="./script/script.js"></script>
</body>
</html>
