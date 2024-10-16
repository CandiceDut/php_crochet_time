<?php
    session_start (); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['carte']) && isset($_POST['date'])) {
        $inputDate = $_POST['date'];
        $inputDateTime = DateTime::createFromFormat('m/y', $inputDate);
        
        $currentDate = new DateTime();
        $threeMonthsLater = clone $currentDate;
        $threeMonthsLater->modify('+3 months');
        
        if ($inputDateTime > $threeMonthsLater /*&& $_POST['carte'][0]==$_POST['carte'][-1]*/) {
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
                echo "<h3>Prix : ".$prix."€</h3>";
            }
        ?>
            <form action="paiement.php" method="post">
            Numero de carte : <input type="text" name="carte" required minlength=16 maxlength=16 placeholder="Ex : 12345678925478931"> 
            <br />
            Date : <input type="text" class="form-control" name="date" id="date" pattern="(0[1-9]|1[0-2])/\d{2}" placeholder="Ex : 01/26"><br />
            <input type="submit" name="payer" value="Payer">
        </body>
        
