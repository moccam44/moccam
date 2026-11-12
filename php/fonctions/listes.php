<?php

function get_intitule_liste_by_code ($liste, $code, $defaut="") {
    global $glob_listes;
    $code=(string)$code;
    if (!isset ($glob_listes[$liste][$code])) {
        return ($defaut);
    }
    return ($glob_listes[$liste][$code]);
}



?>

