<?php
session_start();
include('../includes/config.php');

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Procesare formular de actualizare meniu
if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Verificăm conexiunea la baza de date
    if (!$conn) {
        die("Conexiune eșuată: " . mysqli_connect_error());
    }

    // Inserare în baza de date
    $query = "INSERT INTO menu (item_name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Eroare SQL: ' . $conn->error);  // Afișează eroarea SQL
    }

    $stmt->bind_param("ssd", $item_name, $description, $price);

    if ($stmt->execute()) {
        echo "Meniul a fost actualizat cu succes!";
    } else {
        echo "Eroare la actualizarea meniului!";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizare Meniu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-dashboard">
        <h1>Actualizare Meniu Zilnic</h1>
        <form method="POST" action="update_menu.php" enctype="multipart/form-data">
    <label for="item_name">Numele produsului:</label>
    <input type="text" id="item_name" name="item_name" required><br><br>

    <label for="description">Descriere:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="price">Preț:</label>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="image">Alege imaginea:</label>
    <input type="file" id="image" name="image" accept="image/*"><br><br>

    <button type="submit" name="submit">Actualizează Meniul</button>
</form>

        <a href="dashboard.php">Înapoi la panou de administrare</a>
    </div>
</body>
</html>
