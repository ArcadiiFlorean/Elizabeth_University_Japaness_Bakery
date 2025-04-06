<?php
include('includes/config.php');

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$query = "SELECT name, feedback, submission_date FROM feedback ORDER BY submission_date DESC LIMIT 10 OFFSET $offset";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()): ?>
        <div class="feedback-item">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($row['feedback'])); ?></p>
            <small><?php echo date("F j, Y, g:i a", strtotime($row['submission_date'])); ?></small>
        </div>
    <?php endwhile;
}
