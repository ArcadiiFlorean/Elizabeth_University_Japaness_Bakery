<?php
session_start();
include('./includes/config.php');

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Protecție CSRF: Verifică și generează token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generează un token CSRF
}

// Procesare formular de actualizare meniu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică tokenul CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo "Token CSRF invalid.";
        exit();
    }

    // Preia datele din formular
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Verifică dacă un ID a fost setat pentru a edita un produs
    if (isset($_GET['edit'])) {
        $item_id = $_GET['edit'];
        $image_path = $_POST['current_image']; // Salvează imaginea curentă

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
                    // Înlocuiește calea imaginii
                    $image_path = $target_file;
                } else {
                    echo "Eroare la încărcarea imaginii.";
                }
            } else {
                echo "Fișierul nu este o imagine validă.";
            }
        }

        // Actualizează produsul în baza de date
        $query = "UPDATE menu SET item_name = ?, description = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdsi", $item_name, $description, $price, $image_path, $item_id);

        if ($stmt->execute()) {
            echo "Produsul a fost actualizat cu succes!";
        } else {
            echo "Eroare la actualizarea produsului!";
        }
    }
}

// Ștergerea unui element din meniu
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];

    $query = "DELETE FROM menu WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        echo "Produsul a fost șters cu succes!";
    } else {
        echo "Eroare la ștergerea produsului!";
    }
}

// Editarea unui element existent
if (isset($_GET['edit'])) {
    $item_id = $_GET['edit'];
    $query = "SELECT * FROM menu WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
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
        <form method="POST" action="./admin/update_menu.php" enctype="multipart/form-data">

            <!-- Token CSRF pentru protecție -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <label for="item_name">Numele produsului:</label>
            <input type="text" id="item_name" name="item_name" value="<?php echo isset($item) ? $item['item_name'] : ''; ?>" required><br><br>

            <label for="description">Descriere:</label>
            <textarea id="description" name="description" required><?php echo isset($item) ? $item['description'] : ''; ?></textarea><br><br>

            <label for="price">Preț:</label>
            <input type="number" id="price" name="price" value="<?php echo isset($item) ? $item['price'] : ''; ?>" step="0.01" required><br><br>

            <label for="image">Alege imaginea:</label>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <button type="submit" name="submit">Actualizează Meniul</button>
        </form>

        <?php if (isset($item)): ?>
            <a href="update_menu.php?delete=<?php echo $item['id']; ?>">Șterge produsul</a>
        <?php endif; ?>

        <a href="dashboard.php">Înapoi la panou de administrare</a>
    </div>
</body>
</html>
