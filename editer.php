
<?php
    // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
    session_start ();

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
            <main>
            <?php
            $bdd= "zdavaud_bd"; 
            $host= "lakartxela.iutbayonne.univ-pau.fr";
            $user= "zdavaud_bd"; 
            $pass= "zdavaud_bd";
            $link= new mysqli($host,$user,$pass,$bdd);
            if ($link->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }
            // editer les enregistrements 
            if (isset($_POST['id'])) {
                $idToEdit = $_POST['id'];?>
                <h1>Modifier le doudou <?= $_POST['titre']?> </h1>
                <?php
                $sql = "SELECT * FROM CROCHET WHERE id = $idToEdit";
                $titre = $_POST['Titre'];
                $prix = (int)$_POST['Prix'];
                $quantite = (int)$_POST['Quantite'];
                $image = $_FILES['image'];
                if ($link->query($sql) == TRUE) {
                    print "ok";
                } else {
                    print "Erreur suppression : " . $link->error;
                }
            }           
    
            $link->close();
            
            ?>

                    <!-- <a href="imagesGrde.php?image=<?=$item['urlimage'] ?>"> -->
                    <div>
                        <img src="imagesPetites.php?image=<?= $item['urlimage'] ?>">
                        <div>
                            <h5><?= $item['titre']?> <br> <?=$item['prix'] ?> € </h5>
                            <p> Qte : <?= $item['quantite']?> </p>
                            </form>
                        </div>
                    </div>
                    <!-- </a> -->



            </div>
        </main>
</body>
</html>
