<?php

if (isset($_POST['Titre'], $_POST['Prix'], $_FILES['image'])) {
    $uploadDir = 'Images/';
    $fileKey = 'image';

    if ($_FILES[$fileKey]['error'] == 0) {
        $filename = basename($_FILES[$fileKey]['name']);
        $uploadFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadFile)) {
            echo "<p>Le fichier $filename a été téléchargé avec succès dans le dossier $uploadDir.</p>";                
        }
        else {
            echo "<p>Erreur lors du téléchargement du fichier $filename.</p>";
        }

        $titre = $_POST['Titre'];
        $prix = (int)$_POST['Prix'];
        $image = $_FILES['image'];
        
        $bdd= "zdavaud_bd"; 
            $host= "lakartxela.iutbayonne.univ-pau.fr";
            $user= "zdavaud_bd"; 
            $pass= "zdavaud_bd"; 
            $link= new mysqli($host,$user,$pass,$bdd);
            if ($link->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }
            $stmt = $link->prepare("INSERT INTO CROCHET (titre, prix, image) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die("Erreur lors de la préparation de la requête : " . $link->error);
            }

            $stmt->bind_param("sib", $titre, $prix, $image);
            // Exécuter la requête
            if ($stmt->execute()) {
                echo "Nouvel enregistrement inséré avec succès.";
            } else {
                echo "Erreur lors de l'insertion : " . $stmt->error;
            }

            // Fermer la requête et la connexion
            $stmt->close();
            
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }
            $query = "SELECT * FROM CROCHET C WHERE C.titre = $titre";
            $result= mysqli_query($link,$query);
            mysqli_close($link);
    } 
    else 
    {
        print "<p> Aucun fichier de téléchargé ou une erreur est survenue.</p>";
    }

}


?>