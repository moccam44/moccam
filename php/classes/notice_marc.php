<?php

class notice_marc {
    var $notice;
    
    function __construct ($notice) {
        $this->notice=$notice;
    }
    
    /**
     * get_champs
     * retourne un tableau de champs
     * @param array|string $tags : tag ou tableau de tags
     * @return array liste de champs trouvés  
     * 
     */
    function get_champs ($tags, $bool_first_only=false) {
        $retour=array();
        if (!is_array($tags)) {
            $tags=array($tags);
        }
        
        foreach ($this->notice["champs"] as $idx => $champ) {
            $tag=$champ["tag"];
            if (in_array($tag, $tags)) {
                $champ["idx"]=$idx;
                array_push($retour, $champ);
                if ($bool_first_only === true) {
                    return ($retour);
                }
            }
        }
        return ($retour);
    }
    
    function get_champ ($tags) {
        return($this->get_champs($tags, true));
    }
    
    /**
     * get_ss_champs
     * retourne un tableau de sous-champs
     * @param array champs : tableau de champs dans lesquels chercher les sous-champs OU bien 1 seul champ
     * @param array|string $codes : code ou tableau de codes
     * @return array liste de strings des valeurs ss-champs trouvés  
     * 
     */
    function get_ss_champs ($champs, $codes, $bool_first_only=false) {
        $retour=array();
        if (!is_array($codes)) {
            $codes=array($codes);
        }
        // si 1 seul champ fourni, on crée une liste de 1 champ
        if (isset($champs["tag"])) {
            $champs=array($champs);
        }
        foreach ($champs as $champ) {
            foreach ($champ["sous_champs"] as $sous_champ) {
                $code=$sous_champ["code"];
                $valeur=$sous_champ["valeur"];
                if (in_array($code, $codes)) {
                    array_push($retour, $valeur);
                    if ($bool_first_only === true) {
                        return ($retour);
                    }
                }
            }
        }
        return ($retour);
    }
    
    /**
     * get_ss_champ
     * retourne le premier sous-champ correspondant sous formed e string
     * @param array champs : tableau de champs dans lesquels chercher les sous-champs OU bien 1 seul champ
     * @param array|string $codes : code ou tableau de codes
     * @return string : 1er sous champ correspondant sous forme de string (ou "") 
     * 
     */
    function get_ss_champ ($champs, $codes) {
        $valeurs=$this->get_ss_champs($champs, $codes, true);
        if (count($valeurs) > 0) {
            return ($valeurs[0]);
        } else {
            return("");
        }
    }
    
    function get ($tag, $code) {
        $champs=$this->get_champ($tag);
        $val=$this->get_ss_champ($champs, $code);
        return ($val);
    }
    
    // nettoie les listes. Enlève les éléments vides
    function nettoie_liste ($liste) {
        $retour=array();
        foreach ($liste as $elem) {
            if ($elem !== "") {
                array_push ($retour, $elem);
            }
        }
    }
    
    function formate_chaine ($chaine, $avant, $avant_verif, $apres, $concat="") {
        if ($chaine === "") {
            return ($chaine);
        }
        
        $chaine=$avant.$chaine.$apres;
        
        if ($concat !== "" AND $avant_verif !== "") {
            $chaine=$avant_verif.$chaine;
        } 
        
        
        
        return ($chaine);
        
    }
    
    
    
    
} // fin de la classe
?>

