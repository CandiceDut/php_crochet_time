<?php
    // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
    session_start ();

    // On récupère nos variables de session
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
    {

        print "<form action='upload.php' method='POST' enctype='multipart/form-data'>";
        print "Titre <br><INPUT TYPE='TEXT' NAME='Titre' SIZE='20' MAXSIZE='50' ><BR>";
        print "Prix<br><INPUT TYPE='TEXT' NAME='Prix' SIZE='20' MAXSIZE='50' ><BR>";
        print "Image<br><input type='file' name='image' required><br><br><BR>";
       
        print "<br><INPUT TYPE='SUBMIT' VALUE='OK'></form>";


        print '<br><a href="./logout.php">Déconnection</a>';
    }
    else 
    {
        header("Location: identification.html");
        exit();
    }
?>