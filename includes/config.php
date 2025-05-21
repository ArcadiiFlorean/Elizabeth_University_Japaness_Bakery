<?php
// Configurarea datelor de conectare la baza de date
$host = 'localhost';
$dbname = 'sweet_treats';
$username = 'root';
$password = '';

// Crearea conexiunii
$conn = new mysqli($host, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
