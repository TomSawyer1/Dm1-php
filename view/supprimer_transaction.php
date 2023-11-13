<?php


// Inclure le fichier d'initialisation de la base de données
include("../inc/init.inc.php");

try {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
        header("Location: login.php");
        exit();
    }

    // Vérifier si l'ID de la transaction est fourni
    if (isset($_POST['transaction_id'])) {
        // Se connecter à la base de données
        $bdd = connectDB();

        // Récupérer l'ID de la transaction depuis le formulaire
        $transaction_id = $_POST['transaction_id'];

        // Préparer la requête de suppression
        $stmt = $bdd->prepare("DELETE FROM transactions WHERE transaction_id = :transaction_id");
        $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);

        // Exécuter la requête de suppression
        $stmt->execute();

        // Rediriger l'utilisateur vers la page principale après la suppression
        header("Location: view-transaction.php");
        exit();
    } else {
        // Rediriger l'utilisateur vers la page principale en cas d'ID manquant
        header("Location: view-transaction.php");
        exit();
    }
} catch (Exception $e) {
    // Gérer les erreurs de connexion à la base de données ou de requête
    die("Erreur : " . $e->getMessage());
}
