<?php
    session_start (); 

    $bdd= "zdavaud_bd"; 
    $host= "lakartxela.iutbayonne.univ-pau.fr";
    $user= "zdavaud_bd"; 
    $pass= "zdavaud_bd"; 
    $link = new mysqli($host, $user, $pass, $bdd);
    if ($link->connect_error) {
        die("Échec de la connexion : " . $link->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['carte']) && isset($_POST['date'])) {
        $inputDate = $_POST['date'];
        $inputDateTime = DateTime::createFromFormat('m/y', $inputDate);
        
        $dateAjd = new DateTime();
        $dateLimite = clone $dateAjd;
        $dateLimite->modify('+3 months');
        
        if ($inputDateTime > $dateLimite && $_POST['carte'][0]==$_POST['carte'][-1]) 
        {
            foreach ($_SESSION['panier'] as $id => $qt) {
                $sql = "SELECT quantite FROM CROCHET WHERE id = $id";
                $result= mysqli_query($link,$sql);
                if (mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }
        
                
                if ($result) {
                    $reste = $result->fetch_assoc()['quantite'];
                    // Calculer la nouvelle quantité
                    $qtMaJ = $reste - $qt;

                    // Mettre à jour la quantité dans la base de données
                    $mAj = "UPDATE CROCHET SET quantite = $qtMaJ WHERE id = $id";
                    $updateStmt = $link->prepare($mAj);
                    $updateStmt->execute();
                }

            }
        

            mysqli_close($link);
            

            session_unset ();
            $_SESSION['notification'] = "Paiement enregistré";
            header("Location: index.php");
            exit();
        } else {
            header("Location: panier.php");
            exit();
        }
    }
    
?>


<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
            <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
            <title>Paiement</title>
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
        <?php
            if (isset($_POST['prix'])) {
                $prix = $_POST['prix'];
                echo "<br><h3>Prix : ".$prix."€</h3><br>";
            }
        ?>
            <form action="paiement.php" method="post">
            Numero de carte : <input type="text" class="form-control" name="carte" required minlength=16 maxlength=16 placeholder="Ex : 12345678925478931"> 
            <br />
            Date : <input type="text" class="form-control" name="date" id="date" pattern="(0[1-9]|1[0-2])/\(0-9){2}" placeholder="Ex : 01/26"><br />
            <input type="submit" name="payer" value="Payer">
        </body>
        
