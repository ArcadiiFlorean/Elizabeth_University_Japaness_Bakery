<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Parola introdusă este incorectă.";
            }
        } else {
            $_SESSION['login_error'] = "Nume utilizator incorect.";
        }
    } else {
        $_SESSION['login_error'] = "Toate câmpurile sunt obligatorii.";
    }
} else {
    $_SESSION['login_error'] = "Acces nepermis.";
}

header("Location: login.php");
exit();
?>
