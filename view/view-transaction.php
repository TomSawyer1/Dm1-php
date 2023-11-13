<?php

// Inclure le fichier d'initialisation de la base de données
include("../inc/init.inc.php");

try {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
        header("Location: login.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }

    // Se connecter à la base de données
    $bdd = connectDB();

    // Sélectionner toutes les transactions depuis la base de données
    $stmt = $bdd->query("SELECT * FROM transactions");
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Gérer les erreurs de connexion à la base de données ou de requête
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Liste des Transactions</title>
</head>

<body>

    <h1>Liste des Transactions</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Label</th>
            <th>Amount</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($transactions as $transaction) : ?>
            <tr>
                <td><?= $transaction['transaction_id']; ?></td>
                <td><?= $transaction['user_id']; ?></td>
                <td><?= $transaction['label']; ?></td>
                <td><?= $transaction['amount']; ?></td>
                <td><?= $transaction['created_at']; ?></td>
                <td><?= $transaction['updated_at']; ?></td>
                <td>
                    <form action="modifier_transaction.php" method="post" style="display:inline;">
                        <input type="hidden" name="transaction_id" value="<?= $transaction['transaction_id']; ?>">
                        <button type="submit">Modifier</button>
                    </form>
                    <form action="supprimer_transaction.php" method="post" style="display:inline;">
                        <input type="hidden" name="transaction_id" value="<?= $transaction['transaction_id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>