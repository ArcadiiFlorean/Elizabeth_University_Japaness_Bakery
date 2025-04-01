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
                    <!-- <li class="navbar__list">  <a href="./admin/admin_menu.php">Administrează produsele</a></li> -->
                    <!-- <li class="navbar__list">
                        <a class="navbar__link" href="category.php?id=<?php echo $category['id']; ?>" aria-label="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a>
                    </li> -->
                    <li class="navbar__list">
                        <a class="navbar__link" href="feedback.php" aria-label="Submit feedback">Submit Feedback</a>
                    </li>
                    <li class="navbar__list">
                        <a class="navbar__link" href="contact.php" aria-label="Contact us">Contact</a>
                    </li>
                    <li class="navbar__list">
                        <!-- <a class="navbar__link" href="./admin/process_login.php" aria-label="Login">Login</a> -->
                        <a class="navbar__link" href="./admin/login.php" aria-label="Login">Login</a>
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

        <section id="featured-products" class="main__section main__section--featured-products">
            <h3 class="feature-product-title">Daily Menu</h3>
            <p class="feature-product-description">Produse proaspete și delicioase, pregătite zilnic cu drag.</p>
            <div class="feature-img">
            <?php foreach ($menu_items as $item): ?>
    
    <div class="menu-item">
        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
        <p><?php echo htmlspecialchars($item['description']); ?></p>
        <p>Preț: <?php echo htmlspecialchars($item['price']); ?> Lei</p>
        <img src="./admin/<?php echo htmlspecialchars($item['image']); ?>" 
     alt="<?php echo htmlspecialchars($item['name']); ?>" 
     width="200">




    </div>
<?php endforeach; ?>

            </div>
        </section>
    </main>


        


    <footer class="footer">
        <p>Sweet Treats - Toate drepturile rezervate &copy; 2025</p>
    </footer>
</body>
</html>
