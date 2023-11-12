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

    <?php
    // Supposons que $transactions est un tableau avec les données des transactions provenant de votre base de données
    $transactions = [
        ['id' => 1, 'user_id' => 1, 'label' => 'Achat', 'amount' => 50.00, 'created_at' => '2023-06-01 12:00:00', 'updated_at' => '2023-06-01 12:30:00'],
        ['id' => 2, 'user_id' => 1, 'label' => 'Vente', 'amount' => 30.50, 'created_at' => '2023-06-02 14:00:00', 'updated_at' => '2023-06-02 14:30:00'],
        // Ajoutez d'autres transactions ici
    ];
    ?>

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
                <td><?= $transaction['id']; ?></td>
                <td><?= $transaction['user_id']; ?></td>
                <td><?= $transaction['label']; ?></td>
                <td><?= $transaction['amount']; ?></td>
                <td><?= $transaction['created_at']; ?></td>
                <td><?= $transaction['updated_at']; ?></td>
                <td>
                    <form action="modifier_transaction.php" method="post" style="display:inline;">
                        <input type="hidden" name="transaction_id" value="<?= $transaction['id']; ?>">
                        <button type="submit">Modifier</button>
                    </form>
                    <form action="supprimer_transaction.php" method="post" style="display:inline;">
                        <input type="hidden" name="transaction_id" value="<?= $transaction['id']; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>