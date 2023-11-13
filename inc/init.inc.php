<?php
session_start();

// Fonction pour se connecter à la base de données
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
        return $bdd;  // Ajout de cette ligne pour retourner l'objet de base de données
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}


// Fonction pour vérifier le mot de passe
function verifyPassword($username, $password, $bdd)
{
    $stmt = $bdd->prepare("SELECT `password`,`id` FROM users WHERE `name` = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $hashed_password = $result['password'];


    // Vérifier si le mot de passe est correct
    return password_verify($password, $hashed_password);
}
