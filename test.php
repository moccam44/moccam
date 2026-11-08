<?php
include_once ("php/classes/marc.php");

print ("debut <br> \n");
try {
    $marc=new marc();
    print ("ouverture de /var/marc/panier.pan <br>\n");
    $marc->setup_file("/var/marc/panier.pan");
    print ("répertoire <br>\n");
    print_r($marc->repertoire_notices);
    foreach ($marc->repertoire_notices as $idx => $infos) {
        $chaine=$marc->get_notice_from_file($idx);
        $tableau=$marc->notice_marc_2_array(array("notice"=>$chaine));
        print ("<br> <b> NOTICE $idx </b></br> \n");
        print_r($tableau);
    }
} catch (Exception $e) {
    print($e->getMessage());
}


print ("fin <br> \n");


?>
