<?php

include("../inc/init.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Votre logique de vérification du mot de passe
    if (verifyPassword($username, $password, connectDB())) {
        $_SESSION['message']['connexion'] = 'Connexion réussie !';
        $_SESSION['user_logged_in'] = true;
        $result['id'] = $_SESSION['id'];
        // Rediriger vers la page d'accueil ou toute autre page souhaitée après la connexion
        header("Location: transactions.php");
        exit();
    } else {
        $_SESSION['message']['connexion'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
        // Rediriger vers la page de connexion en cas d'échec de connexion
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <p style="color:red;">
        <?php

        echo isset($_SESSION['message']['connexion']) ? $_SESSION['message']['connexion'] : '';
        ?>
    </p>
</body>

</html>