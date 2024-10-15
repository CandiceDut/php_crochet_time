<?php
    // On démarre la session
    session_start (); ?>

<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
            <title>Panier</title>
        </head>
        <body>
        <h1>Articles choisis :</h1>

<?php
    // On récupère nos variables de session
        $bdd= "zdavaud_bd"; 
        $host= "lakartxela.iutbayonne.univ-pau.fr";
        $user= "zdavaud_bd"; 
        $pass= "zdavaud_bd"; 
        $link= new mysqli($host,$user,$pass,$bdd);
        if ($link->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }
    
        // Récupérer les enregistrements de la table
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
        
        $panier = implode(',', $_SESSION['panier']);

        $sql = "SELECT * FROM CROCHET WHERE id IN ($panier)";
        $result = $link->query($sql);
        ?>
    
            <form method="post" action="">
                <!--création tableau enregistrements-->
                <table>
                        <tr>
                            <th>Titre</th>
                            <th>Prix (en €)</th>
                        </tr>
                    
    
                    <?php
                    // Afficher  enregistrements
                    $total = 0;
                    while($row = $result->fetch_assoc()){
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $row['titre'] . "</td>";
                        echo "<td>" . $row['prix'] . "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                        $total = $total + $row['prix'];
                    }
                    ?>
                </table>
                <br>
    
            </form>

            <?php
            // Afficher le prix total 
            echo "prix total : " . $total . "€";?>
            
            <form method="post" action="paiement.php">
                <input type="hidden" name="prix" value="<?= $total ?>"><br>
                <button type="submit" class="btn btn-secondary">Payer</button>
            </form>
           
            <?php
            $link->close();
            

        } else {
            echo "Votre panier est vide.";
        }?>
       

           <br><a href="./logout.php">Déconnection</a>
    
        </body>
        </html>
        <?php
  