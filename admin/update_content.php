<?php
require_once 'db.php'; // Conectare la baza de date

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Gestionarea încărcării imaginii
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Verificăm și mutăm fișierul încărcat
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $conn->query("UPDATE site_content SET title='$title', description='$description', image='$image_name' WHERE id=1");
        }
    } else {
        // Dacă nu se încarcă o nouă imagine, actualizăm doar textul
        $conn->query("UPDATE site_content SET title='$title', description='$description' WHERE id=1");
    }

    header("Location: admin.php");
    exit();
}
?>
