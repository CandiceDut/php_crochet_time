<?php

if (isset($_POST['submit'])) 
{
    $uploadDir = 'Images/';

    if (is_uploaded_file($_FILES[$filename]['tmp_name'])) 
    {   print "<p> Le fichier $filename a été téléchargé avec succès dans le dossier uploads.</p>";
        
        $filename = basename($_FILES[$filename]['name']);
        $uploadFile = $uploadDir . $filename; 

        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadFile)) 
        {
            print "<p> Le fichier $filename a été téléchargé avec succès dans le dossier uploads.</p>";
        } 
        else 
        {
            print "<p> Erreur lors du téléchargement du fichier $filename.</p>";
        }
    } 
    else 
    {
        print "<p> Aucun fichier de téléchargé ou une erreur est survenue.</p>";
    }

}


?>