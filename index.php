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
            <a class="navbar-brand" href="index.php">Crochet Time</a>
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
        <h1>Les doudous au crochet</h1>
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

        <div id="zone_cartes" class="row row-cols-3">

            <?php
            foreach ($result as $result) {
                ?>

                <!--Les cartes
                <a href="recettes.php?id_categorie=<?= $result['id'] ?>" class="col mb-3">-->
                    <div class="card" style="width: 10rem;">
                        <img src="<?= "Images/" . $result['image'] ?>" class="card-img-top" alt="" width="900" weight="800">
                        <div class="card-body bg-primary">
                            <h5><?= $result['titre'] ?></h5>
                        </div>
                    </div>
                <!--</a>-->


            <?php } ?>

        </div>
    </main>

        

</body>
</html>