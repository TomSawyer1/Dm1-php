<?php
if ($_SESSION['user_logged_in'] = "1") {
    session_destroy();
    $_SESSION['message']['connexion'] = 'vous etes deconnectés';
    header("Location: login.php");
}
