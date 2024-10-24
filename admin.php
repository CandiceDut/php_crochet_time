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
            <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
            <title>Page choix action admin</title>
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

        <p>Que souhaitez-vous faire ?</p>

            <button class="btn btn-primary" onclick="window.location.href='ajout.php'">Ajouter</button>
            <!-- <button class="btn btn-primary" onclick="window.location.href='suppression.php'">Supprimer</button> -->
            <h1>Articles disponibles :</h1>
    
            
                <!--création tableau enregistrements-->
                <table class="table">
                        <tr>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Description</th>
                            <th class=d-none> Edit<th>
                            <th class=d-none> Suppr<th>
                        </tr>
                    
    
                    <?php
                    
                    // Afficher  enregistrements
                    echo "<tbody>";
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['titre'] . "</td>";
                        echo "<td>" . $row['prix'] . "</td>";
                        echo "<td>" . $row['quantite'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td> 
                            <form action='editer.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' class='btn btn-info' name='edit' value='Modifier'>
                            </form>
                            </td>";
                        echo "<td> 
                            <form action='suppression.php' method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' class='btn btn-danger' name='suppr' value='Supprimer'>
                            </form>
                            </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    ?>
                </table>
                <br>
            
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