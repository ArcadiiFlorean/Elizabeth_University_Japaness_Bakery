<?php
// Conectează-te la baza de date
include('includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preia datele din formular
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Procesarea imaginii
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";  // Directorul unde vor fi salvate imaginile
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifică dacă fișierul este o imagine reală
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "Fișierul este o imagine - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }
    }

    // Verifică dacă imaginea deja există
    if (file_exists($target_file)) {
        echo "Ne pare rău, fișierul există deja.";
        $uploadOk = 0;
    }

    // Limitează dimensiunea fișierului
    if ($_FILES["image"]["size"] > 500000) { // 500 KB
        echo "Ne pare rău, fișierul este prea mare.";
        $uploadOk = 0;
    }

    // Permite doar anumite formate de fișiere
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Ne pare rău, doar fișiere JPG, JPEG, PNG și GIF sunt permise.";
        $uploadOk = 0;
    }

    // Verifică dacă upload-ul a avut succes
    if ($uploadOk == 0) {
        echo "Fișierul nu a fost încărcat.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Fișierul " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a fost încărcat.";

            // Adaugă produsul în baza de date
            $query = "INSERT INTO menu (item_name, description, price, image) VALUES ('$item_name', '$description', '$price', '$target_file')";
            if ($conn->query($query) === TRUE) {
                echo "Produsul a fost adăugat cu succes!";
            } else {
                echo "Eroare la adăugarea produsului: " . $conn->error;
            }
        } else {
            echo "Ne pare rău, a apărut o problemă la încărcarea fișierului.";
        }
    }
}
?>
