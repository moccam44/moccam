<?php
include_once ("php/classes/marc.php");

print ("debut <br> \n");
try {
    $marc=new marc();
    print ("ouverture de /var/marc/panier.pan <br>\n");
    $marc->open_file("/var/marc/panier.pan");
    print ("génération du répertoire <br>\n");
    $toto=$marc->genere_rep_notices();
    print_r($toto);
} catch (Exception $e) {
    print($e->getMessage());
}


print ("fin <br> \n");


?>
