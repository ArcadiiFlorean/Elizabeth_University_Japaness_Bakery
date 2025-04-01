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
                <img src="./img/logo.jpg" alt="Sweet Treats Logo" class="logo">
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
        <div class="main__welcome">
            <h1 class="main__title">Welcome to Sweet Treats! <span>Japanese bakery</span></h1>
            <p class="main__paragraf">日本のレストランは、寿司、刺身、天ぷら、ラーメンなどの新鮮な料理を提供します。落ち着いた雰囲気で、細部にこだわったデザインが特徴です。</p>

        </div>


        

        <!-- Secțiune pentru mesajul de feedback -->
        <?php if ($feedback_message != ''): ?>
            <section class="confirmation">
                <h2>Confirmare Feedback</h2>
                <p><?php echo $feedback_message; ?></p>
            </section>
        <?php endif; ?>

        <section id="featured-products" class="main__section main__section--featured-products">
            <h3 class="feature-product-title">Menu of the Day – Heavenly Bakery Delights 🍰</h3>
            <p class="feature-product-description">Fresh and delicious treats, made daily with love!</p>
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
    <section id="about" class="section-about">
    <div class="container">

    
        <div class="about-content">
            <h2>The Legend of Our Bakery</h2>
          <p>Long ago, in the misty mountains of Japan, there was a small village where the art of baking was passed down by the gods themselves. The villagers believed that the divine spirit of the mountain, known as Kashi-no-Kami, bestowed upon them the sacred knowledge of creating bread and sweets that carried the essence of the earth, the sky, and the eternal seasons. It was said that those who tasted the bread from this village would be blessed with good fortune and a long, prosperous life.</p>

<p>As the years passed, the villagers honed their craft, creating delicate pastries that were infused with the flavors of the land—the rich matcha from the deep green tea fields, the sweet red beans harvested from sacred valleys, and the golden rice grown under the watchful eye of the gods. The secret recipes were passed down through the generations, but only a few were entrusted with the ancient knowledge. It was said that the bakers who could truly understand the spirit of Kashi-no-Kami were able to bake with a divine touch, crafting pastries so perfect that they seemed to glow with an ethereal light.</p>

<p>One fateful day, a young baker named Akihiko, whose family had served the village as bakers for centuries, discovered an ancient scroll hidden deep within the sacred temple of the mountain. The scroll, written in a forgotten language, contained a recipe so complex and mysterious that it was said to summon the spirits of the harvest. Akihiko, guided by the whispers of the mountain wind and the wisdom of his ancestors, began to experiment with the recipe, blending traditional ingredients with a touch of magic. The result was a pastry unlike any other, so delicious that it caused those who ate it to experience vivid dreams of the mountain gods themselves.</p>

<p>Over time, Akihiko's bakery became known far and wide, attracting travelers from across the land who sought the mystical flavors of his creations. Some believed that the bakery held the key to immortality, others that it was a gateway to the spirit world. The legacy of that ancient bakery, shrouded in mystery, was passed down through the generations, each baker adding their own twist to the divine recipes. Now, in the heart of the bustling city, our bakery continues this tradition, bringing the ancient wisdom and magical flavors of Japan's spiritual past into every loaf, every pastry, and every bite. We honor the gods, the earth, and the sky in every creation we make, ensuring that the magic of our bakery lives on for generations to come.</p>

        </div>
        <div class="about-image">
            <img  class="about-image" src="./img/chef__contact.png" alt="About Us" />
        </div>
    </div>
</section>
<section class="social-section">
    <div class="container">
      <div class="social-img">

      <img src="./img/IMG_legend.avif" width="650px" alt="">
      </div>

<div class="social-container">
     <div class="content-social">
    <!-- Imagini pentru rețele sociale -->
    <a href="https://facebook.com" class="footer-social__icon" aria-label="Facebook">
    <i class="bi bi-facebook" style="font-size: 26px;"></i>
    </a>
    <a href="https://instagram.com" class="footer-social__icon" aria-label="Instagram">
    <i class="bi bi-instagram" style="font-size: 26px;"></i>
    </a>
    <a href="https://twitter.com" class="footer-social__icon" aria-label="Twitter">
        <i class="bi bi-twitter" style="font-size: 26px;"></i> <!-- Icon Twitter -->
    </a>
</div>

        <!-- Text informativ -->
        <div class="social-text">
            <p>Our centuries-old history continues to bring the magic of tradition into every product. Join our community and share the story of this legendary bakery! Follow us for the latest updates and special offers, and don't forget to share with your loved ones to keep our tradition alive in every corner of the world!</p>
        </div>

        <!-- Buton de partajare -->
        <div class="social-share">
            <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href))">
                <span>Partajează pe Facebook</span>
            </button>
            <button onclick="window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(window.location.href))">
                <span>Partajează pe Twitter</span>
            </button>
        </div>
    </div>
</div>
   
</section>




<!-- Includeți CSS și JS pentru slider -->


    <footer class="footer">
        <div class="footer-content">

        

        <p>Sweet Treats - Toate drepturile rezervate &copy; 2025</p>

        </div>
    
    </footer>
</body>
</html>
