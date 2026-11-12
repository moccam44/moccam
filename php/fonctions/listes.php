<?php

function get_intitule_liste_by_code ($liste, $code, $defaut="") {
    global $glob_listes;
    if (!isset ($glob_listes[$liste][$code])) {
        return ($defaut);
    }
    return ($glob_listes[$liste][$code]);
}



?>

