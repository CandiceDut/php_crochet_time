<?php
    // On démarre la session
    session_start ();

    // On récupère nos variables de session
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
    {
        $bdd= "zdavaud_bd"; 
        $host= "lakartxela.iutbayonne.univ-pau.fr";
        $user= "zdavaud_bd"; 
        $pass= "zdavaud_bd"; 
        $link= new mysqli($host,$user,$pass,$bdd);
        if ($link->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }
    
        // Récupérer les enregistrements de la table
        $sql = "SELECT * FROM CROCHET";
        $result = $link->query($sql);
        ?>
    
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
    
            <form method="post" action="">
                <!--création tableau enregistrements-->
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Image</th>
                        </tr>
                    </thead>
    
                    <?php
                    // Afficher  enregistrements
                    $compteur = 0;
                    $row = $result->fetch_assoc();
                    foreach($row as $ligne) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $ligne['id'] . "</td>";
                        echo "<td>" . $ligne['titre'] . "</td>";
                        echo "<td>" . $ligne['prix'] . "</td>";
                        $compteur++;
                        echo "<td>" . $ligne['urlimage'] . "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    ?>
                </table>
                <br>
    
            </form>

            <?php
            // Afficher le prix total 
            $total = 0;
            for($i = 0; $i < $compteur; $i++) {
                $total = $total + $row['prix'];
            }
            echo "prix total : " . $total . "€";
            $link->close();
            ?>
            
           <br><a href="./logout.php">Déconnection</a>
    
        </body>
        </html>
        <?php
        
    }

    else 
    {
        header("Location: identification.html");
    }
    ?>