<?php
session_start();

// Fonction pour se connecter à la base de données
function connectDB()
{
    $dbHost = 'localhost';
    $dbName = 'schema';
    $dbUser = 'root';
    $dbPassword = '';

    try {

        $bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
        // Activer les erreurs PDO
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    /*define("URL", "http://localhost/PHP/Dm1/");*/
}

// Fonction pour vérifier le mot de passe
function verifyPassword($username, $password, $bdd)
{
    $stmt = $bdd->prepare("SELECT `password` FROM users WHERE `name` = ?");
    $stmt->execute([$username]);
    $hashed_password = $stmt->fetchColumn();

    // Vérifier si le mot de passe est correct
    return password_verify($password, $hashed_password);
}
