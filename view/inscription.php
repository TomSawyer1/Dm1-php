<?php

include("../inc/init.inc.php");

// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Vérifier si tous les champs sont remplis
    if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
        echo 'Tous les champs sont obligatoires.';
    }
    // Vérifier la longueur du mot de passe
    elseif (strlen($password) < 8) {
        echo 'Le mot de passe doit contenir au moins 8 caractères.';
    }
    // Vérifier si l'adresse email est valide
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'L\'adresse email n\'est pas valide.';
    }
    // Vérifier si les mots de passe correspondent
    elseif ($password !== $confirm_password) {
        echo 'Les mots de passe ne correspondent pas.';
    } else {
        // Exemple de hachage du mot de passe avec bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Préparer la requête SQL avec des déclarations préparées
        connectDB();
        $stmt = $bdd->prepare("INSERT INTO users (`name`, `password`, `email`) VALUES (?, ?, ?)");

        // Vérifier la préparation de la requête
        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL.');
        }

        // Liaison des paramètres
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        // Exécuter la requête
        if ($stmt->execute()) {
            $_SESSION['message']['inscription'] = 'Inscription réussie, veuillez vous connecter !';
            // Fermer la connexion et la requête
            $stmt->close();

            // Rediriger vers la page de connexion après l'inscription
            header("Location: login.php");
            exit();
        } else {
            // En cas d'échec, rediriger vers la page d'inscription
            $_SESSION['message']['inscription'] = 'Inscription échouée ! Veuillez vérifier vos informations.';
            header("Location: inscription.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>

    <p>
        <?php
        // Afficher le message d'inscription s'il existe
        echo isset($_SESSION['message']['inscription']) ? $_SESSION['message']['inscription'] : '';
        ?>
    </p>

    <!-- Utiliser la même page pour le traitement du formulaire -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" value="Register">
    </form>
</body>

</html>