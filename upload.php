<?php

if (isset($_POST['Titre'], $_POST['Prix'], $_POST['Quantite'], $_FILES['image'])) {
    $uploadDir = 'Images/';
    $fileKey = 'image';

    if ($_FILES[$fileKey]['error'] == 0) {
        $filename = basename($_FILES[$fileKey]['name']);
        $uploadFile = $uploadDir . $filename;

        move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadFile);
 

        $titre = $_POST['Titre'];
        $prix = (int)$_POST['Prix'];
        $quantite = (int)$_POST['Quantite'];
        $image = $_FILES['image'];
        
        $bdd= "zdavaud_bd"; 
            $host= "lakartxela.iutbayonne.univ-pau.fr";
            $user= "zdavaud_bd"; 
            $pass= "zdavaud_bd"; 
            $link= new mysqli($host,$user,$pass,$bdd);
            if ($link->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            //recherche du prochain identifiant
            $query = "SELECT max(id)+1 as newId FROM CROCHET";
            $result= mysqli_query($link,$query);
            $newId = $result->fetch_assoc()['newId'];
            
            //Insertion du nouvel article
            $stmt = $link->prepare("INSERT INTO CROCHET (id, titre, prix, quantite, urlimage) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Erreur lors de la préparation de la requête : " . $link->error);
            }
            $stmt->bind_param("isiis", $newId, $titre, $prix, $quantite, $filename);
            $stmt->execute();
            // Exécuter la requête
            // if ($stmt->execute()) {
            //     echo "Nouvel enregistrement inséré avec succès.";
            // } else {
            //     echo "Erreur lors de l'insertion : " . $stmt->error;
            // }

            // Fermer la requête et la connexion
            $stmt->close();
            
            // if (mysqli_connect_errno())
            // {
            //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
            //     exit();
            // }
            // Redirection vers la page de l'admin
            header("Location: admin.php");
            exit(); 
            
            mysqli_close($link);
    } 
    else 
    {
        print "<p> Aucun fichier de téléchargé ou une erreur est survenue.</p>";
    }
}

?>