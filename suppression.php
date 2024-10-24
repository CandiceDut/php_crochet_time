<?php
session_start();
        $bdd= "zdavaud_bd"; 
        $host= "lakartxela.iutbayonne.univ-pau.fr";
        $user= "zdavaud_bd"; 
        $pass= "zdavaud_bd";
        $link= new mysqli($host,$user,$pass,$bdd);
        if ($link->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }
        // Supprimer les enregistrements 
        if (isset($_POST['id'])) {
            $idToRemove = $_POST['id'];
            $sql = "DELETE FROM CROCHET WHERE id = $idToRemove";
            $link->query($sql);
            // if ($link->query($sql) == TRUE) {
            //     print "Enregistrements supprimés";
            // } else {
            //     print "Erreur suppression : " . $link->error;
            // }
            // Redirection vers la page de l'admin
            header("Location: admin.php");
            exit(); 
        }           

        $link->close();
?>



