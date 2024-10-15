<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <title>Crochet Time</title>
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
        <h1>Les doudous en crochet</h1>
        <?php
        $bdd= "zdavaud_bd"; 
        $host= "lakartxela.iutbayonne.univ-pau.fr";
        $user= "zdavaud_bd"; 
        $pass= "zdavaud_bd"; 
        $link=mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de données");
        $query = "SELECT * FROM CROCHET";
        $result= mysqli_query($link,$query);
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        mysqli_close($link);
        
        ?>

        <div id="zone_cartes" class="row row-cols-5">

            <?php
            foreach ($result as $item) {
                ?>
                <a href="imagesGrde.php?image=<?=$item['urlimage'] ?>"class ="col mb-3">
                <div class="card" style="width: 10rem;">
                    <img src="imagesPetites.php?image=<?= $item['urlimage'] ?>" class="card-img-top">
                    <div class="card-body bg-primary">
                        <h5><?= $item['titre']?> <br> <?=$item['prix'] ?> € </h5>
                        <button type="button" class="btn btn-secondary">Ajouter au panier</button>
                    </div>
                </div>
                </a>



            <?php } ?>

        </div>
    </main>

        

</body>
</html>