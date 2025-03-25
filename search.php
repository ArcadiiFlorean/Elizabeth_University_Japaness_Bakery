<?php
session_start();
include('includes/config.php');

// Verifică dacă formularul de căutare a fost trimis
$search_query = '';
$search_results = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Protejarea datelor împotriva injecției SQL
    $search_query = htmlspecialchars($search_query);

    // Căutarea produselor care conțin termenul de căutare în numele produsului
    $query = "SELECT * FROM menu WHERE item_name LIKE ? ORDER BY date_added DESC";
    $stmt = $conn->prepare($query);
    $search_param = "%" . $search_query . "%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifică dacă există rezultate
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    } else {
        $message = "Nu au fost găsite produse pentru '$search_query'.";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Căutare Produse - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sweet Treats - Căutare Produse</h1>
    </header>

    <main>
        <section class="search">
            <h2>Căutați Produse</h2>
            <form action="search.php" method="GET">
                <label for="search">Căutare:</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search_query); ?>" required>
                <button type="submit">Căutare</button>
            </form>

            <?php if (!empty($search_results)) { ?>
                <h3>Rezultatele Căutării:</h3>
                <ul class="product-list">
                    <?php foreach ($search_results as $product) { ?>
                        <li>
                            <h4><?php echo htmlspecialchars($product['item_name']); ?></h4>
                            <p><?php echo htmlspecialchars($product['item_description']); ?></p>
                            <p>Preț: <?php echo htmlspecialchars($product['item_price']); ?> Lei</p>
                        </li>
                    <?php } ?>
                </ul>
            <?php } elseif (isset($message)) { ?>
                <p class="error"><?php echo $message; ?></p>
            <?php } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
