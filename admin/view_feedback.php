<?php
session_start();
include('../includes/config.php');

// Verifică dacă utilizatorul este autentificat
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Obține feedback-ul din baza de date
$query = "SELECT * FROM feedback ORDER BY submission_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare Feedback</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-dashboard">
        <h1>Feedback-ul Clienților</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Feedback</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['feedback'])); ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($row['submission_date'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nu există feedback-uri.</p>
        <?php endif; ?>

        <a href="dashboard.php">Înapoi la panou de administrare</a>
    </div>
</body>
</html>
