<?php

function get_intitule_liste_by_code ($liste, $code, $defaut="") {
    print ("liste : $liste <br> \n");
    print ("code : $code <br> \n");
    global $glob_listes;
    $code=(string)$code;
    print_r($glob_listes);
    print ($glob_listes[$liste][$code]);
    if (!isset ($glob_listes[$liste][$code])) {
        return ($defaut);
    }
    return ($glob_listes[$liste][$code]);
}



?>

