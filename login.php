<?php
    // On définit un login et un mot de passe de base
    $login_valide = "root";
    $pwd_valide = "rooteur";

    // on teste si nos variables sont définies
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        // on vérifie les informations saisies
        if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
            session_start ();
            // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd)
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['pwd'] = $_POST['pwd'];
            header ('location: accueil.php');
        }
        else {
            echo '<body onLoad="alert(\'Tu fais partie des membres toi ?\')">';
            echo '<meta http-equiv="refresh" content="0;URL=identification.html">';
        }
    }
    else {
        echo 'T\'as pas saisi les bons.';
    }
?>