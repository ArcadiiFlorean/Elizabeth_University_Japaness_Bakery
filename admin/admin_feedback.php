<?php
session_start();

// Verifică dacă utilizatorul este autentificat ca admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include('../includes/config.php');

// Verifică conexiunea
if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

// Selectează toate feedback-urile
$query = "SELECT id, name, email, feedback, submission_date FROM feedback ORDER BY submission_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Feedback</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/normallisation.css">
</head>
<body>

<header class="header-admin">
    <nav class="navbar">
        <a href="#" class="navbar__logo" aria-label="Sweet Treats homepage">
            <img src="../img/logo.jpg" alt="Sweet Treats Logo" class="logo">
        </a>
        <div class="navbar__menu">
            <ul class="navbar__items">
                <li class="navbar__list">
                    <a class="navbar__link" href="../index.php" aria-label="Daily menu">Home</a>
                </li>
                <li class="navbar__list">
                    <a class="navbar__link" href="../index.php#featured-products" aria-label="Daily menu">Daily Menu</a>
                </li>
                <li class="navbar__list">
                    <a class="navbar__link" href="feedback.php" aria-label="Submit feedback">Submit Feedback</a>
                </li>
                <li class="navbar__list">
                    <a class="navbar__link" href="contact.php" aria-label="Contact us">Contact</a>
                </li>
                <li class="navbar__list">
                    <button class="back-button" onclick="window.history.back();" aria-label="Go back">Back</button>
                </li>
            </ul>
            <div class="hamburger-menu" onclick="toggleMenu()" aria-label="Open menu">
                &#9776; <!-- Hamburger menu character -->
            </div>
        </div>
    </nav>
</header>

<h1>Admin - Feedback Utilizatori</h1>
<a href="dashboard.php">Înapoi la Panoul de Control</a>

<section class="admin_feedback">
    <div class="container">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nume</th>
                <th>Email</th>
                <th>Feedback</th>
                <th>Data</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['feedback'])); ?></td>
                    <td><?php echo $row['submission_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>

<?php mysqli_close($conn); ?>

</body>
</html>
