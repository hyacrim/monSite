<?php
$servername = "localhost"; // Remplace par le nom du serveur de base de données
$username = "root"; // Remplace par ton nom d'utilisateur de base de données
$password = ""; // Remplace par ton mot de passe de base de données
$dbname = "mon site"; // Remplace par le nom de ta base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>
