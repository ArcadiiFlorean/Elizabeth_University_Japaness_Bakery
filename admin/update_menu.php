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
    // Preia datele din formular
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Verifică dacă fișierul a fost încărcat corect
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Setează directorul de destinație pentru imagini
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);  // Creează directorul cu permisiuni corespunzătoare
        }
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verifică dacă fișierul este o imagine
        if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
            // Verifică dimensiunea fișierului
            $max_size = 5000000; // 5MB
            if ($_FILES["image"]["size"] > $max_size) {
                echo "Fișierul este prea mare.";
                exit();
            }

            // Încearcă să încarci fișierul
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "Imaginea a fost încărcată cu succes.";
            } else {
                echo "Eroare la încărcarea imaginii.";
            }

            // Salvează calea imaginii în baza de date
            $image_path = $target_file;

            // Inserare în baza de date (cu imaginea)
            $query = "INSERT INTO menu (item_name, description, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssds", $item_name, $description, $price, $image_path);

            if ($stmt->execute()) {
                echo "Meniul a fost actualizat cu succes!";
            } else {
                echo "Eroare la actualizarea meniului!";
            }
        } else {
            echo "Fișierul nu este o imagine validă.";
        }
    } else {
        echo "Eroare la încărcarea fișierului: " . $_FILES['image']['error'];
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
