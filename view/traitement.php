<?php

include("../inc/init.inc.php");

// Supposons que $bdd est votre objet PDO pour la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $euros = isset($_POST['euros']) ? floatval($_POST['euros']) : 0;
    $libelle = isset($_POST['libelle']) ? htmlspecialchars($_POST['libelle']) : '';

    // Assurez-vous que les données sont valides
    if ($euros > 0 && !empty($libelle)) {

        // Ajoutez la nouvelle transaction à la base de données
        $sql = "INSERT INTO transactions (euros, label) VALUES (:euros, :libelle)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':euros', $euros, PDO::PARAM_STR);
        $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
        $stmt->execute();

        // Redirigez l'utilisateur vers la page principale ou une autre page après l'ajout
        header("Location: index.php");
        exit;
    } else {
        echo "Veuillez fournir des données valides.";
    }
} else {
    echo "Méthode de requête invalide.";
}
