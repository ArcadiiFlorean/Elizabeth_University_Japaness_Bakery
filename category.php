<?php
include('includes/config.php');

$category_id = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT * FROM products WHERE category_id = $category_id";
$result = $conn->query($query);

$category_name = ''; // Vom înlocui cu numele categoriei
if ($category_id) {
    $category_query = "SELECT name FROM categories WHERE id = $category_id";
    $category_result = $conn->query($category_query);
    if ($category_result->num_rows > 0) {
        $category_name = $category_result->fetch_assoc()['name'];
    }
}

$menu_items = [];
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
    <title><?php echo $category_name; ?> - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?php echo $category_name; ?> - Produse</h1>
    <div class="products-list">
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
</body>
</html>
