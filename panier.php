<?php
    session_start (); 

    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id = $_POST['id'];

        if ($_POST['action'] == 'plus' && $_SESSION['panier'][$id] < $_POST['qt']) {
            $_SESSION['panier'][$id]++;
        } 
        elseif ($_POST['action'] == 'moins' && $_SESSION['panier'][$id] > 1) //diminuer sans aller en dessous de 1
        {

            $_SESSION['panier'][$id]--;
        }

        header('Location: panier.php');
    }

?>

<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
            <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
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
        
        
        $panier = implode(',', array_keys($_SESSION['panier']));

        $sql = "SELECT * FROM CROCHET WHERE id IN ($panier)";
        $result = $link->query($sql);
        ?>
    
            <table class='table'>
                    <tr>
                        <th>Titre </th>
                        <th> Qte </th>
                        <th> Prix (en €) </th>
                        <th class=d-none> Suppr<th>
                    </tr>
                

                    <?php
                
                // Afficher  enregistrements
                $total = 0;
                echo "<tbody>";
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row['titre'] . "</td>";
                    echo "<td>
                        <form action='panier.php' method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' name='action' value='moins' class='btn btn-light'>-</button>
                        </form>
                        " . $_SESSION['panier'][$row['id']] . "
                        <form action='panier.php' method='post' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='hidden' name='qt' value='" . $row['quantite'] . "'>
                            <button type='submit' name='action' value='plus' class='btn btn-light'>+</button>
                        </form>
                        </td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td> 
                        <form action='suppPanier.php' method='post'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' class='btn btn-danger' name='suppr' value='X'>
                        </form>
                        </td>";
                    echo "</tr>";
                    $total = $total + $row['prix']* $_SESSION['panier'][$row['id']];
                }
                echo "</tbody>";
                ?>
                </table>
                <br>
    

            <?php
            // Afficher le prix total 
            echo "prix total : " . $total . "€";?>
            
            <form method="post" action="paiement.php">
                <input type="hidden" name="prix" value="<?= $total ?>"><br>
                <button type="submit" class="btn btn-secondary">Payer</button>
            </form>
            <br><a href="./logout.php">Tout supprimer</a>
            <?php
            $link->close();
            

        } else {
            echo "Votre panier est vide.";
        }?>
       

           
    
        </body>
        </html>
  