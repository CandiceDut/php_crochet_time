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
        <body class='container'>
                        <header>
                        <nav class="navbar navbar-expand-lg bg-body-tertiary">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="index.php">Crochet'Time</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Doudous</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="identification.html">Admin</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="panier.php">Panier</a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </nav>
                        </header>
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
  