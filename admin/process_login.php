<?php
session_start();
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Selectează doar username-ul și hash-ul parolei din baza de date
    $query = "SELECT id, username, password FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verifică parola introdusă cu hash-ul din baza de date
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: admin_menu.php"); // Redirecționează spre pagina adminului
            exit();
        } else {
            echo "Parolă incorectă!";
        }
    } else {
        echo "Nume de utilizator inexistent!";
    }
}
?>
