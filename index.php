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
    <section id="about" class="section-about">
    <div class="container">

    
        <div class="about-content">
            <h2>The Legend</h2>
            <p>Într-un sat mic ascuns în munții Japoniei, oamenii credeau că spiritul muntelui, Kashi-no-Kami, le-a dăruit cunoștințele sacre ale coacerii pâinii și dulciurilor. Aceste creații divine erau pline cu esența pământului, cerului și anotimpurilor eterne, iar cei care le gustau erau binecuvântați cu noroc și o viață lungă și prosperă.</p>

<p>Pe măsură ce timpul trecea, meșteșugul coacerii s-a perfecționat, iar pâinile și prăjiturile reflectau aroma ingredientelor sfinte din jurul muntelui — matcha din câmpiile verzi de ceai, fasolea roșie din văile sacre și orezul auriu crescut sub privirea atentă a zeilor. Doar câțiva aleși aveau acces la rețetele ancestrale, iar aceștia coceau cu o atingere divină, creând produse de o frumusețe etereală, care păreau să strălucească.</p>

<p>Un tânăr brutar, Akihiko, care provenea dintr-o familie de brutari cu tradiție veche de secole, a descoperit un vechi pergament într-un templu sacru al muntelui. Pergamentul, scris într-o limbă uitată, conținea o rețetă misterioasă care putea chema spiritele recoltei. Inspirat de viziuni și ghidat de înțelepciunea strămoșilor săi, Akihiko a experimentat cu rețeta, adăugând ingrediente tradiționale și un strop de magie. Astfel, a creat o prăjitură atât de delicioasă încât cei care o gustau aveau viziuni ale zeilor muntelui și erau transportați într-o lume de vis.</p>

<p>În scurt timp, cofetăria lui Akihiko a devenit celebră, atrăgând călători din toate colțurile lumii care veneau pentru a gusta din creațiile sale magice. Mulți credeau că rețetele aveau puterea de a oferi nemurirea, alții că ele deschideau o poartă către lumea spiritelor. Astăzi, tradiția continuă într-o cofetărie din inima unui oraș agitat, aducând magia și înțelepciunea străveche a Japoniei în fiecare pâine, prăjitură și mușcătură. Cu fiecare creație, păstrăm vie legătura cu zeii, pământul și cerul, asigurându-ne că magia noastră va dăinui pentru generațiile viitoare.</p>

        </div>
        <div class="about-image">
            <img  class="about-image" src="./img/chef__contact.png" loading="lazy" alt="About Us" />
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
