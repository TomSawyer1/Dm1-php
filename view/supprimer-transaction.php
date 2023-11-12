<?php
// supprimer_transaction.php

// Vous devrez inclure votre logique de connexion à la base de données ici
// include("connexion.php");

// Supposons que $bdd est votre objet PDO pour la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez l'ID de la transaction à partir du formulaire
    $transaction_id = isset($_POST['transaction_id']) ? intval($_POST['transaction_id']) : 0;

    // Assurez-vous que l'ID de la transaction est valide (suppose que l'ID ne peut pas être zéro)
    if ($transaction_id > 0) {
        // Supprimez la transaction de la base de données
        $sql = "DELETE FROM transactions WHERE id = :transaction_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigez l'utilisateur vers la page principale ou une autre page après la suppression
        header("Location: index.php");
        exit;
    } else {
        echo "ID de transaction invalide.";
    }
} else {
    echo "Méthode de requête invalide.";
}
