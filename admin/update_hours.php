<?php
include('../includes/config.php');

$message = "";
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "UPDATE site_settings SET monday_hours=?, tuesday_hours=?, wednesday_hours=?, thursday_hours=?, friday_hours=?, saturday_hours=?, sunday_hours=? WHERE id = 1";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param(
            "sssssss", 
            $_POST['monday_hours'], $_POST['tuesday_hours'], $_POST['wednesday_hours'],
            $_POST['thursday_hours'], $_POST['friday_hours'], $_POST['saturday_hours'], $_POST['sunday_hours']
        );

        if ($stmt->execute()) {
            $message = "✅ Working hours have been successfully updated!";
            $success = true;
        } else {
            $message = "❌ Update error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "❌SQL ErrorL: " . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultat actualizare</title>
    <style>
        body {
            background: #f0f4f8;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
        }
        .success {
            color: green;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 18px;
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        a.button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="<?= $success ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        <a href="./dashboard.php" class="button">Back to the form</a>
    </div>
</body>
</html>
