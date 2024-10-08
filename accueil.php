<!-- http://lakartxela.iutbayonne.univ-pau.fr/~cdutourni001/crochet_time/ -->

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crochet Time</title>
</head>
<body>
    <?php
        // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
        //session_start ();

        // On affiche un lien pour fermer notre session
        echo '<br />';
        echo '<br> <a href="./logout.php">Déconnection</a>';
        
        if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
            // echo 'T\'es pas connecté. <br>';
            // echo '<a href="./logout.php">Se connecter</a>';
            header ('location: identification.html');
        }
    ?>
</body>
</html>