<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valider les informations d'identification
    if ($email === 'user@example.com' && $password === 'password') {
        // Connexion réussie, vous pouvez maintenant rediriger vers la page d'accueil ou afficher un message de bienvenue
        echo "Bienvenue, " . $email;
    } else {
        // Informations d'identification incorrectes, vous pouvez afficher un message d'erreur
        echo "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>

</html>