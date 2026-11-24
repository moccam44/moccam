<?php

function get_intitule_liste_by_code ($liste, $code, $defaut="") {
    $code=(string)$code;
    if (!isset ($GLOBALS["glob_listes"][$liste][$code])) {
        return ($defaut);
    }
    return ($GLOBALS["glob_listes"][$liste][$code]);
}



?>

