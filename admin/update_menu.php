<?php
session_start();
include('../includes/config.php');

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Procesare formular de actualizare meniu
if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Inserare în baza de date
    $query = "INSERT INTO menu (item_name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
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
        <form method="POST" action="update_menu.php">
            <label for="item_name">Numele produsului:</label>
            <input type="text" id="item_name" name="item_name" required><br><br>

            <label for="description">Descriere:</label>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="price">Preț:</label>
            <input type="number" id="price" name="price" step="0.01" required><br><br>

            <button type="submit" name="submit">Actualizează Meniul</button>
        </form>
        <a href="dashboard.php">Înapoi la panou de administrare</a>
    </div>
</body>
</html>
