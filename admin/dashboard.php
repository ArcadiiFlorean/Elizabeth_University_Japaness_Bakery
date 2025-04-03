<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include('../includes/config.php');

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

// CSRF Token Generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Funcție de validare a fișierelor imagine
function validateImage($image) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    return in_array($image['type'], $allowed_types) && in_array(strtolower($image_extension), $allowed_extensions);
}

// Salvarea modificărilor pentru setările de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $map_link = htmlspecialchars($_POST['map_link']);

    $query = "UPDATE site_settings SET phone=?, email=?, address=?, map_link=? WHERE id=1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $phone, $email, $address, $map_link);
    $stmt->execute();
}

// Preluarea datelor pentru afișare setări de contact
$query = "SELECT * FROM site_settings WHERE id=1";
$result = $conn->query($query);
$settings = $result->fetch_assoc();
// $query = "SELECT work_hours FROM settings WHERE id = 1";
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);
// $settings['work_hours'] = $row['work_hours'];

// Adaugă produs
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = (float)$_POST['price'];

    $target_file = 'default.jpg';
    if (!empty($_FILES['image']['name']) && validateImage($_FILES['image'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $query = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssds", $name, $description, $price, $target_file);
    $stmt->execute();
}

// Actualizează produs
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $id = intval($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = (float)$_POST['price'];
    
    $query = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $target_file = $row['image'];

    if (!empty($_FILES['image']['name']) && validateImage($_FILES['image'])) {
        if (file_exists($target_file) && $target_file !== 'default.jpg') {
            unlink($target_file); // Șterge vechea imagine
        }
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $query = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsi", $name, $description, $price, $target_file, $id);
    $stmt->execute();
}

// Șterge produs
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);

    $query = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && file_exists($row['image'])) {
        unlink($row['image']);
    }

    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Selectează produse
$query = "SELECT * FROM products";
$result = $conn->query($query);
$products = $result->fetch_all(MYSQLI_ASSOC);
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

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/normallisation.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="header-admin">
    <nav class="navbar">
        <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">
            <img src="../img/logo.jpg" alt="Sweet Treats Logo" class="logo">Admin
        </a>
        <div class="navbar__menu">
            <ul class="navbar__items">
                <li class="navbar__list">
                    <a class="navbar__link" href="../index.php" aria-label="Daily menu">Home</a>
                </li>
                <li class="navbar__list">
                    <a class="navbar__link" href="../index.php#featured-products" aria-label="Daily menu">Daily Menu</a>
                </li>
                <li class="navbar__list"><a class="navbar__link" href="admin_feedback.php">Vezi Feedback</a></li>
                <li class="navbar__list">
                    <a class="navbar__link" href="../contact.php" aria-label="Contact us">Contact</a>
                </li>
                <li class="navbar__list">
                    <a class="navbar__link" href="../admin/logout.php" aria-label="Login">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<section class="section-dashboard">
    <div class="container">

    
        <div class="admin-panel-all">
        <div class="admin-title">
        <h1>Admin - Meniu Produse</h1>
    <h1>Admin - Settings Contact</h1>
    <h1>Admin -Week houres</h1>
    </div>
        <div class="admin-panel">
  
 

<div class="admin_meniu">
            
               
                <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="add" value="1">
                    <label>Nume produs:</label>
                    <input type="text" name="name" required><br>
                    <label>Descriere:</label>
                    <textarea name="description" required></textarea><br>
                    <label>Preț:</label>
                    <input type="number" name="price" step="0.01" required><br>
                    <label>Imagine:</label>
                    <input type="file" name="image"><br>
                    <input type="submit" value="Adaugă">
                </form>
            </div>











         <div class="admin_settings">
        
            <form action="dashboard.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="hidden" name="update_contact" value="1">
                
                <label>Telefon:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($settings['phone']); ?>" required><br>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($settings['email']); ?>" required><br>

                <label>Adresă:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($settings['address']); ?>" required><br>

                <label>Link Google Maps:</label>
                <input type="text" name="map_link" value="<?php echo htmlspecialchars($settings['map_link']); ?>" required><br>

                <input type="submit" value="Salvează modificările">
            </form>
        </div>

      <div class="admin-hours">
      
         <form method="post" action="update_hours.php">
            <label>Luni:</label> <input type="text" name="monday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Marți:</label> <input type="text" name="tuesday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Miercuri:</label> <input type="text" name="wednesday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Joi:</label> <input type="text" name="thursday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Vineri:</label> <input type="text" name="friday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Sâmbătă:</label> <input type="text" name="saturday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <label>Duminică:</label> <input type="text" name="sunday_hours" placeholder="Ex: 09:00 - 17:00"><br>
            <button type="submit">Actualizează orele</button>
        </form>
      </div>
       

     </div>
       
        <div class="admin-products-area">

      
            

           

            <!-- List of Existing Products -->
            <div class="admin_products_existing">
                <h2>Produse existente</h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Nume</th>
                        <th>Descriere</th>
                        <th>Preț</th>
                        <th>Imagine</th>
                        <th>Acțiuni</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="update" value="1">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <td><?php echo $product['id']; ?></td>
                                <td><input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"></td>
                                <td><textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea></td>
                                <td><input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>"> Lei</td>
                                <td>
                                    <img src="<?php echo $product['image']; ?>" width="100"><br>
                                    <input type="file" name="image">
                                </td>
                                <td>
                                    <input type="submit" value="Salvează">
                                    <a href="dashboard.php?delete_id=<?php echo $product['id']; ?>" onclick="return confirm('Sigur ștergi?')">Șterge</a>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        </div>
     
    </div>
</section>


</body>
</html>

