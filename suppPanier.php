<?php
session_start();



if (isset($_POST['id']) && isset($_SESSION['panier'])) {
    $idToRemove = $_POST['id'];
    if (($key = array_search($idToRemove, $_SESSION['panier'])) !== false) {
    unset($_SESSION['panier'][$key]);}
    

    // Redirection vers la page du panier après suppression
    header("Location: panier.php");
    exit();
}
?>

