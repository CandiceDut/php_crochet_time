<?php
    // On démarre la session
    session_start ();

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
    
            <form method="post" action="">
                <!--création tableau enregistrements-->
                <table>
                    <tr>
                        <th>Titre</th>
                        <th>Prix (en €)</th>
                        <th>Image</th>
                    </tr>
    
                    <?php
                    // Afficher  enregistrements
                    $total = 0;
                    
                    while($row = $result->fetch_assoc()) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . $row['titre'] . "</td>";
                        echo "<td>" . $row['prix'] . "</td>";
                        echo "<td>" . $row['urlimage'] . "</td>";
                        echo "<td> <input type='submit' name='delete' value='Supprimer'> </td>";
                        echo "</tr>";
                        echo "</tbody>";
                        $total = $total + $row['prix'];
                    }
                    ?>
                </table>
                <br>
    
            </form>

            <?php
            // Supprimer les enregistrements qd on clique sur le bouton suppriemr à coté d'un enregistrement
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
            // Afficher le prix total 
            echo "<h5>prix total : " . $total . "€</h5>";
            $link->close();
            ?>
            
           <br><a href="./logout.php">Retour à l'accueil</a>
    
        </body>
        </html>
        <?php
    
    ?>