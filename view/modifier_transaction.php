<?php
include("../inc/init.inc.php");

// Supposons que $bdd est votre objet PDO pour la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez l'ID de la transaction à partir du formulaire
    $transaction_id = isset($_POST['transaction_id']) ? intval($_POST['transaction_id']) : 0;

    // Assurez-vous que l'ID de la transaction est valide (suppose que l'ID ne peut pas être zéro)
    if ($transaction_id > 0) {
        // Récupérez les détails de la transaction depuis la base de données
        $sql = "SELECT * FROM transactions WHERE id = :transaction_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);
        $stmt->execute();
        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($transaction) {
            // Le formulaire de modification de la transaction
?>
            <!DOCTYPE html>
            <html lang="fr">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
                <title>Modifier la Transaction</title>
            </head>

            <body>
                <h1>Modifier la Transaction</h1>
                <form action="traitement_modifier_transaction.php" method="post">
                    <input type="hidden" name="transaction_id" value="<?= $transaction['id']; ?>">

                    <label for="libelle">Libellé de la transaction :</label>
                    <input type="text" id="libelle" name="libelle" value="<?= $transaction['label']; ?>" required>

                    <label for="euros">Montant en euros :</label>
                    <input type="number" id="euros" name="euros" step="0.01" value="<?= $transaction['amount']; ?>" required>

                    <button type="submit">Enregistrer les modifications</button>
                </form>
            </body>

            </html>
<?php
        } else {
            echo "Transaction non trouvée.";
        }
    } else {
        echo "ID de transaction invalide.";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>