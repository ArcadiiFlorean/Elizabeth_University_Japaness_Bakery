<?php
// Configurarea datelor de conectare la baza de date
$host = 'localhost';     // Gazda bazei de date (de obicei localhost)
$dbname = 'sweet_treats'; // Numele bazei de date
$username = 'root';      // Numele de utilizator pentru accesul la baza de date
$password = '';          // Parola pentru utilizatorul bazei de date (golă dacă folosești XAMPP sau un server local)

// Crearea conexiunii la baza de date
$conn = new mysqli($host, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

// Setarea charset-ului pentru a preveni probleme de codificare
$conn->set_charset("utf8");
?>
