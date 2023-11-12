<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Formulaire de transaction</title>
</head>

<body>

    <h2>Formulaire de transaction</h2>

    <?php
    // Assumez que vous avez récupéré la transaction à modifier depuis votre base de données
    // $transaction est supposée contenir les données de la transaction à modifier
    $isEditing = isset($transaction['id']);
    ?>

    <form action="<?php echo $isEditing ? 'modifier_transaction.php' : 'traitement.php'; ?>" method="post">
        <?php if ($isEditing) : ?>
            <!-- Champ caché pour l'ID de la transaction lors de la modification -->
            <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
        <?php endif; ?>

        <label for="euros">Montant en euros :</label><br>
        <input type="number" id="euros" name="euros" step="0.01" value="<?php echo $isEditing ? $transaction['amount'] : ''; ?>" required><br>

        <label for="libelle">Libellé de la transaction :</label><br>
        <input type="text" id="libelle" name="libelle" value="<?php echo $isEditing ? $transaction['label'] : ''; ?>" required><br>

        <input type="submit" value="<?php echo $isEditing ? 'Modifier' : 'Ajouter'; ?>">
    </form>

</body>

</html>