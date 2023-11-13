<?php

include("../inc/init.inc.php");
if (!$_SESSION['user_logged_in']) {
    header("Location: login.php");
}
// Vérifiez si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $euros = isset($_POST['euros']) ? floatval($_POST['euros']) : 0;
    $libelle = isset($_POST['libelle']) ? htmlspecialchars($_POST['libelle']) : '';

    // Assurez-vous que les données sont valides
    if ($euros > 0 && !empty($libelle)) {
        // Assurez-vous que $bdd est disponible (connexion à la base de données)
        $bdd = connectDB(); // Ajoutez cette ligne pour obtenir l'objet PDO
        session_start();
        $id = $_SESSION['id'];
        // Ajoutez la nouvelle transaction à la base de données
        $sql = "INSERT INTO transactions (amount, label , user_id) VALUES (:euros, :libelle , :id)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':euros', $euros, PDO::PARAM_STR);
        $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);



        if ($stmt->execute()) {
            // Redirigez l'utilisateur vers la page principale ou une autre page après l'ajout
            header("Location: view-transaction.php");
            exit;
        } else {
            echo "Erreur lors de l'ajout de la transaction.";
        }
    } else {
        echo "Veuillez fournir des données valides.";
    }
} else {
    echo "Méthode de requête invalide.";
}
