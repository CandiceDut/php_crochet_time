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
        }
        else {
            echo "<p>Aucun fichier téléchargé ou une erreur est survenue.</p>";
        }
    }
    else {
        echo "<p>Veuillez remplir tous les champs du formulaire.</p>";
    }

?>