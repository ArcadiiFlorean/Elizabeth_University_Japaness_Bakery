<?php
include('includes/config.php');

// Obține meniul zilnic din baza de date
$query = "SELECT * FROM daily_menu ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meniul Zilnic - Sweet Treats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Sweet Treats - Meniul Zilnic</h1>
        <nav>
            <ul>
                <li><a href="index.php">Pagina Principală</a></li>
                <li><a href="feedback.php">Trimite Feedback</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="menu">
            <h2>Meniul Zilnic</h2>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produs</th>
                            <th>Descriere</th>
                            <th>Preț</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($row['item_description'])); ?></td>
                                <td><?php echo htmlspecialchars($row['item_price']); ?> Lei</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nu există produse disponibile astăzi. Vă rugăm reveniți mai târziu!</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Sweet Treats. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>
