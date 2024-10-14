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
            <title>Gestion des enregistrements</title>
        </head>
        <body>
    
            <h1>Articles disponibles :</h1>
    
            <form method="post" action="">
                <!--création tableau enregistrements-->
                <table>
                    <tr>
                        <th>Selectionner</th>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Image</th>
                    </tr>
    
                    <?php
                    // Afficher  enregistrements
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><input type=checkbox name=ids[] value=" . $row['id'] . "></td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['titre'] . "</td>";
                        echo "<td>" . $row['prix'] . "</td>";
                        echo "<td>" . $row['urlimage'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <br>
                <input type="submit" name="delete" value="Supprimer la selection">
            </form>
           <br><a href="./logout.php">Déconnection</a>
    
        </body>
        </html>
    
        <?php
        // Supprimer les enregistrements 
        if (isset($_POST['delete'])) {
            if (!empty($_POST['ids'])) {
                $ids = implode(",", $_POST['ids']);
                $sql = "DELETE FROM CROCHET WHERE id IN ($ids)";
                if ($link->query($sql) == TRUE) {
                    print "Enregistrements supprimés";
                } else {
                    print "Erreur suppression : " . $link->error;
                }
            } else {
                print "Aucun enregistrement sélectionné.";
            }
        }
        $link->close();

        
    }

    else 
    {
        header("Location: identification.html");
    }
    ?>
