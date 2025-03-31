<?php
// Conectare la baza de date
include('includes/config.php');

// Verifică dacă există un ID de produs
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Șterge produsul din baza de date
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=Produsul a fost șters cu succes.");
        exit;
    } else {
        echo "A apărut o eroare la ștergerea produsului.";
    }
} else {
    echo "Produsul nu a fost găsit.";
}
?>
