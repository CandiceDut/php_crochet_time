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
            <title>Gestion des enregistrements</title>
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
    // On récupère nos variables de session
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
    {

        print "<form action='upload.php' method='POST' enctype='multipart/form-data'>";
        print "Titre <br><INPUT TYPE='TEXT' NAME='Titre' SIZE='20' MAXSIZE='50' ><BR>";
        print "Prix<br><INPUT TYPE='TEXT' NAME='Prix' SIZE='20' MAXSIZE='50' ><BR>";
        print "Quantité<br><INPUT TYPE='INT' NAME='Quantite' SIZE='20' MAXSIZE='50' ><BR>";
        print "Description<br><INPUT TYPE='TEXT' NAME='Description' SIZE='20' MAXSIZE='500' ><BR>";
        print "Image<br><input type='file' name='image'<br><br><BR>";
       
        print "<br><INPUT TYPE='SUBMIT' VALUE='OK'></form>";


        print '<br><a href="./logout.php">Déconnection</a>';
    }
    else 
    {
        header("Location: identification.html");
    }
?>