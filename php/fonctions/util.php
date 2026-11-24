<?php

function traite_EAN ($chaine) {
    $clef="";
    $chaine=trim($chaine);
    $chaine=str_replace ("-","",$chaine);
    $chaine=str_replace ("_","",$chaine);
    $chaine=str_replace ("\.","",$chaine);
    $chaine=str_replace (" ","",$chaine);

    if (strlen($chaine)==10) { // ISBN 10 complet avec clef de controle
        $chaine=substr($chaine,0,9); // On enlève la clef de controle
        $chaine="978".$chaine;
        $clef=get_clef_ean($chaine);
        $chaine.=$clef;
        return($chaine);
    } elseif (strlen($chaine)==9) { // ISBN sans clef de controle
        $chaine="978".$chaine;
        $clef=get_clef_ean($chaine);
        $chaine.=$clef;
        return($chaine);
    } elseif (strlen($chaine)==13) {  // Code barres commercial
            if (preg_match ("/[^0-9]/i",$chaine)) {
                return("");
            }
            return($chaine);
    } elseif (strlen($chaine)==12) {  // Code barres commercial sans clef de controle
            if (preg_match ("/[^0-9]/i",$chaine)) {
                return("");
            }
            $clef=get_clef_ean($chaine);
            $chaine.=$clef;
            return($chaine);
    } else { // ISBN erronné
        return("");
    }
    
}

function get_clef_ean($chaine) {
    // Vérifie qu'il n'y a que des chiffres
    if (preg_match ("/[^0-9]/i",$chaine)) {
        return("");
    }

    // On récupère les 12 caractères
    $car1=substr($chaine,0,1);
    $car2=substr($chaine,1,1);
    $car3=substr($chaine,2,1);
    $car4=substr($chaine,3,1);
    $car5=substr($chaine,4,1);
    $car6=substr($chaine,5,1);
    $car7=substr($chaine,6,1);
    $car8=substr($chaine,7,1);
    $car9=substr($chaine,8,1);
    $car10=substr($chaine,9,1);
    $car11=substr($chaine,10,1);
    $car12=substr($chaine,11,1);

    // On multiplie les caractères paires par 3
    $car2=$car2*3;
    $car4=$car4*3;
    $car6=$car6*3;
    $car8=$car8*3;
    $car10=$car10*3;
    $car12=$car12*3;

    // On fait la somme de tout
    $somme=$car1+$car2+$car3+$car4+$car5+$car6+$car7+$car8+$car9+$car10+$car11+$car12;

    // On complète jusqu'à un multiple de 10
    for ($i=0;$i<10;$i++) {
        if (($somme+$i)%10==0) {
                    return($i);
            }
    }
}

/**
 * 
 * @param string $chaine
 * @return int
 * extrait l'année d'une chaine de caractères et vérifie qu'elle a bien le format année (4 chiffres compris entre 1900 et l'année n+1)
 */
function date_str_2_int ($chaine) {
    $chiffres = preg_replace('/[^0-9]/', '', $chaine);
    if (strlen($chiffres) === 8) { // si date précise du type 01/01/2000 => 8 caractères
        $chiffres = substr ($chiffres, 3, 4);
    }
    if (strlen($chiffres === 4)) {
        $annee=(int)$chiffres;
        $anne_en_cours=(int)date("Y");
        if ($annee < 1900 OR $annee > $anne_en_cours+1) {
            return (0);
        } else {
            return ($annee);
        }
    } else {
        return (0);
    }
    
}



?>

