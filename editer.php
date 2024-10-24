<?php
// On démarre la session
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='node_modules/bootstrap/dist/css/bootstrap.css'>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <title>Modifier un article</title>
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
    // Informations de connexion à la base de données
    $bdd = "zdavaud_bd";
    $host = "lakartxela.iutbayonne.univ-pau.fr";
    $user = "zdavaud_bd";
    $pass = "zdavaud_bd";
    
    // Connexion à la base de données
    $link = new mysqli($host, $user, $pass, $bdd);
    
    if ($link->connect_error) {
        die("Échec de la connexion : " . $link->connect_error);
    }

    // Éditer les enregistrements
    if (isset($_POST['id'])) {
        $idToEdit = (int)$_POST['id'];
        $sql = "SELECT * FROM CROCHET WHERE id = $idToEdit";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            ?>
            <h1>Modifier le doudou <?= $item['titre'] ?></h1>
            <div>
                <img src="imagesPetites.php?image=<?= $item['urlimage'] ?>" alt="Image de l'article">
                <h5><?= $item['titre'] ?> <br><?= $item['description']?>
                <br> <br> <?= $item['prix'] ?> €</h5>
                <p>Quantité : <?= $item['quantite'] ?></p>                
            </div>
            <form action="update_article.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="titre" value="<?= $item['titre'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="titre" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="<?= $item['description'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" name="prix" value="<?= $item['prix'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" class="form-control" name="quantite" value="<?= $item['quantite'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Sauvegarder</button> <br>
            </form>
            <?php
        } else {
            echo "Aucun article trouvé.";
        }
    }

    $link->close();
    ?>
</main>
</body>
</html>