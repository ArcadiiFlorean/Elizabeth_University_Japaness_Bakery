<?php
// Conectează-te la baza de date
include('includes/config.php');

// Verifică dacă formularul a fost trimis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preia datele din formular
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Preia imaginea
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    // Validare câmpuri
    if (!empty($name) && !empty($price) && !empty($image)) {
        // Protejează datele împotriva injecției SQL
        $name = htmlspecialchars($name);
        $description = htmlspecialchars($description);
        $price = htmlspecialchars($price);

        // Încarcă imaginea
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Inserare produs în baza de date
            $query = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssis", $name, $description, $price, $target);
            if ($stmt->execute()) {
                $message = "Produsul a fost adăugat cu succes!";
            } else {
                $message = "A apărut o eroare la adăugarea produsului.";
            }
        } else {
            $message = "Eroare la încărcarea imaginii.";
        }
    } else {
        $message = "Vă rugăm să completați toate câmpurile.";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Produs - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Adaugă Produs Nou - Sweet Treats</h1>
    </header>

    <main>
        <section class="add-product">
            <h2>Adaugă un nou produs</h2>
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <label for="name">Nume produs:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Descriere:</label>
                <textarea id="description" name="description"></textarea>

                <label for="price">Preț:</label>
                <input type="text" id="price" name="price" required>

                <label for="image">Imagine produs:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit">Adaugă Produsul</button>
            </form>

            <?php if (isset($message)) { echo "<p class='error'>$message</p>"; } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
