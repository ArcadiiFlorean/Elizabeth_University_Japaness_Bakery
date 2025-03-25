<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Treats - Pagina Principală</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="css/normallisation.css">

    <!-- fonts-->

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

<main class="main">
    <div class="main__welcome ">
    <h1 class="main__title">Welcome to Sweet Treats! <span>Japanese bakery</span></h1>

           <p class="main__paragraf">日本のレストランは、寿司、刺身、天ぷら、ラーメンなどの新鮮な料理を提供します。落ち着いた雰囲気で、細部にこだわったデザインが特徴です。</p>
          
    </div>
 

    <section class="main__section main__section--intro">
        <div class="main__container">
            <div class="main__description">
        <h2 class="main__section-title">About Us</h2>
        <p class="main__section-text">La Sweet Treats, creăm prăjituri și produse de patiserie delicioase, pregătite cu dragoste pentru fiecare zi. Veniți și încercați produsele noastre proaspete!La Sweet Treats, creăm prăjituri și produse de patiserie delicioase, pregătite cu dragoste pentru fiecare zi. Veniți și încercați produsele noastre proaspete!</p>
        </div>
        <img class="main__container--img" src="./img/logo.jpg" width="350" height="350" alt="logo">
       
    </section>

    <section class="main__section main__section--featured-products">
    <div class="main__description">
        <h2 class="main__section-title">Produse text recomended script </h2>
   

        <p class="main__section-text">Nu ratați prăjiturile noastre deosebite! Descoperiți meniul nostru zilnic pentru a vedea ce am pregătit pentru astăzi.</p>
        <div class="main__grid">
        <img class="grid__img" src="./img/grid_img_01.png" alt="img-02">
        <!-- <img class="grid__img" src="./img/grid_img_02.jpg" alt="img-02">
      
        <img class="grid__img" src="./img/grid_img_03.jpg" alt="img-03"> -->
        <img class="grid__img" src="./img/grid_img_04.png" alt="img-04">
        <img class="grid__img" src="./img/grid_img_05.png" alt="img-05">
        </div>
        </div>
        <img class=" grid__img--modify" src="./img/refreshment.png" alt="img-03"> 

    </section>

    <section class="main__section main__section--customer-feedback">
        <h2 class="main__section-title">Feedback Clienți</h2>
        <p class="main__section-text">Vrem să auzim părerea voastră! Lăsați feedback și ajutați-ne să îmbunătățim produsele noastre.</p>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <p class="footer__text">&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </div>
</footer>

</body>
</html>
