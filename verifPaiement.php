<?php
        if (isset($_POST['payer'])) {
            if ($_POST['carte'][0]==$_POST['carte'][-1]) {
                print "Carte ok";
            }


            $date=$_POST['date'];

            
            $dateOk = DateTime::createFromFormat($date);
            $dateOk->modify('+3 months');

            if ($date >= $dateOk) {
                echo "La date est ok";
            } else {
                echo "La date n'est PAS ok";
            }
        }
?>