<?php
include('../includes/config.php');
include('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];  // 'admin' sau 'user'

    if (register_user($username, $password, $role)) {
        $success_message = "Utilizatorul a fost înregistrat cu succes!";
    } else {
        $error_message = "Eroare la înregistrare. Încercați din nou!";
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Înregistrare Utilizator</h2>
    
    <?php if (isset($error_message)) echo "<div>$error_message</div>"; ?>
    <?php if (isset($success_message)) echo "<div>$success_message</div>"; ?>

    <form action="register.php" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>

        <label>Role:</label><br>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <input type="submit" value="Înregistrează-te">
    </form>
</body>
</html>
