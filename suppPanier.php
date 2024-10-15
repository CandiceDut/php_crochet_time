<?php
session_start(); 

// Vérifier si l'ID de l'article est envoyé via le formulaire
if (isset($_POST['id_article'])) {
    $id_article = $_POST['id_article'];

    // Vérifier existence du panier
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = []; 
    }

    // suppression id du panier
    if (array_key_exists($id_article, $_SESSION['panier'])) {
        unset($_SESSION['panier'][$id_article]);
    }
}    

// Rediriger vers la page précédente ou une autre page
header('Location: panier.php'); 
exit();
?>