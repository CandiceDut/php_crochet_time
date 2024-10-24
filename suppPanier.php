<?php
session_start();
if (isset($_POST['id']) && isset($_SESSION['panier'])) {
    $idToRemove = $_POST['id'];

   if (isset($_SESSION['panier'][$idToRemove])) {
        unset($_SESSION['panier'][$idToRemove]);
    }
    
    // Redirection vers la page du panier après suppression
    header("Location: panier.php");
    exit();
}
?>