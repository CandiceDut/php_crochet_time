<?php
    // On démarre la session
    session_start (); ?>

<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
            <title>Paiement</title>
        </head>
        <body>
        <?php
            if (isset($_POST['prix'])) {
                $prix = $_POST['prix'];
                echo "<h3>Prix : ".$prix."€</h3>";
            }
        ?>
            <form action=verifPaiement.php method="post">
            Numero de carte : <input type="text" name="carte" required minlength=16 maxlength=16>
            <br />
            Date : <input type="date" name="date" required><br />
            <input type="submit" name="payer" value="Payer">
        </body>
        
