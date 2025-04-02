<?php
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "UPDATE site_settings SET monday_hours=?, tuesday_hours=?, wednesday_hours=?, thursday_hours=?, friday_hours=?, saturday_hours=?, sunday_hours=? WHERE id = 1";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param(
            "sssssss", 
            $_POST['monday_hours'], $_POST['tuesday_hours'], $_POST['wednesday_hours'],
            $_POST['thursday_hours'], $_POST['friday_hours'], $_POST['saturday_hours'], $_POST['sunday_hours']
        );

        if ($stmt->execute()) {
            echo "✅ Orele de lucru au fost actualizate pentru fiecare zi!";
        } else {
            echo "❌ Eroare la actualizare: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "❌ Eroare SQL: " . $conn->error;
    }
    
    $conn->close();
}
?>