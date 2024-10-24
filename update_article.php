<?php
session_start();

// Informations de connexion à la base de données
$bdd = "zdavaud_bd";
$host = "lakartxela.iutbayonne.univ-pau.fr";
$user = "zdavaud_bd";
$pass = "zdavaud_bd";

// Connexion à la base de données
$link = new mysqli($host, $user, $pass, $bdd);

// Vérification de la connexion
if ($link->connect_error) {
    die("Échec de la connexion : " . $link->connect_error);
}

// Vérification que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $titre = $link->real_escape_string(trim($_POST['titre']));
    $prix = (float)$_POST['prix'];
    $quantite = (int)$_POST['quantite'];
    
    // Gestion de l'image
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Vérifier le type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $image = 'uploads/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        } else {
            //echo "Type de fichier non autorisé.";
            exit;
        }
    }

    // Mise à jour de l'article
    $sql = "UPDATE CROCHET SET titre = '$titre', prix = $prix, quantite = $quantite" . ($image ? ", urlimage = '$image'" : "") . " WHERE id = $id";
    $link->query($sql);
    // if ( === TRUE) {
    //     echo "Article mis à jour avec succès.";
    // } else {
    //     echo "Erreur lors de la mise à jour : " . $link->error;
    // }
    header("Location: admin.php");
}

// Fermeture de la connexion
$link->close();
?>