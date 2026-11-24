<?php

function secure_sql($inputs) {
    if (!is_array($inputs)) {
        if (is_string($inputs)) {
            return (mysqli_real_escape_string($GLOBALS["db"], $inputs));
        } else {
            return (inputs);
        }
    }
    $retour=array();
    foreach ($inputs as $clef => $input) {
        if (is_string($input)) {
            $retour[$clef]=mysqli_real_escape_string($GLOBALS["db"], $input);
        } else {
            $retour[$clef]=$input;
        }
    }
    return($retour);
}

function sql_query ($sql) {
    $retour=$GLOBALS["db"]->query($sql);
    return ($retour);    
}


?>

