<?php
// Include fișierul de configurare pentru conexiunea la baza de date
include('config.php');

// Funcție pentru adăugarea unui produs în meniul zilnic
function add_menu_item($name, $description, $price) {
    global $conn;  // Accesăm conexiunea la baza de date

    // Pregătim și executăm interogarea SQL pentru a adăuga un produs
    $stmt = $conn->prepare("INSERT INTO menu (item_name, item_description, item_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Funcție pentru actualizarea unui produs în meniul zilnic
function update_menu_item($id, $name, $description, $price) {
    global $conn;

    // Pregătim și executăm interogarea SQL pentru a actualiza un produs existent
    $stmt = $conn->prepare("UPDATE menu SET item_name = ?, item_description = ?, item_price = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $name, $description, $price, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Funcție pentru obținerea meniului zilnic
function get_menu_items() {
    global $conn;

    $query = "SELECT * FROM menu ORDER BY date_added DESC"; // Selectăm toate produsele și le ordonăm după data adăugării
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);  // Returnăm produsele sub formă de array asociativ
    } else {
        return [];  // Dacă nu sunt produse, returnăm un array gol
    }
}

// Funcție pentru adăugarea unui feedback din partea clienților
function add_feedback($name, $email, $feedback) {
    global $conn;

    // Pregătim și executăm interogarea SQL pentru a adăuga feedback-ul
    $stmt = $conn->prepare("INSERT INTO feedback (customer_name, customer_email, feedback_text) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Funcție pentru obținerea feedback-ului
function get_feedback() {
    global $conn;

    $query = "SELECT * FROM feedback ORDER BY date_submitted DESC"; // Selectăm feedback-urile ordonate după data trimiterii
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);  // Returnăm feedback-urile sub formă de array asociativ
    } else {
        return [];  // Dacă nu sunt feedback-uri, returnăm un array gol
    }
}

// Funcție pentru autentificarea administratorului
function authenticate_admin($username, $password) {
    global $conn;

    // Verificăm dacă administratorul există în baza de date
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, md5($password)); // Parola este criptată cu MD5 (ar trebui să folosești un algoritm mai sigur, de exemplu password_hash)
    $stmt->execute();
    $result = $stmt->get_result();

    // Dacă există un administrator cu acest nume de utilizator și parolă
    if ($result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}
?>
