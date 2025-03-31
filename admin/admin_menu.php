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
    return in_array($image['type'], $allowed_types);
}

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
            unlink($target_file);
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
    <title>Admin - Meniu Produse</title>
</head>
<body>
    <h1>Admin - Meniu Produse</h1>
    <h2>Adaugă un nou produs</h2>
    <form action="admin_menu.php" method="POST" enctype="multipart/form-data">
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
    <h2>Produse existente</h2>
    <table border="1">
        <tr><th>ID</th><th>Nume</th><th>Descriere</th><th>Preț</th><th>Imagine</th><th>Acțiuni</th></tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <form action="admin_menu.php" method="POST" enctype="multipart/form-data">
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
                        <a href="admin_menu.php?delete_id=<?php echo $product['id']; ?>" onclick="return confirm('Sigur ștergi?')">Șterge</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
