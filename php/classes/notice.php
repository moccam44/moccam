<?php

class notice extends notice_marc {
    var $infos=array();
    

    public function __construct($notice) {
        parent::__construct($notice);
    }
    
    function get_infos () {
        $this->infos["titre"]=$this->get_titre();
        $this->infos["titres"]=$this->get_titres();
        $this->infos["auteurs"]=$this->get_auteurs("simple");
        $this->infos["auteurs_affichage"]=$this->get_auteurs("complet");
        $this->infos["auteur"]=$this->get_auteur("simple");
        $this->infos["auteur_affichage"]=$this->get_auteur("complet");
        
        
        print_r($this->infos);
    }
    
    function get_titre () {
        return($this->get("200", "a"));
    }
    
    function get_titres () {
        $champ_200=$this->get_champ("200");
        print_r($champ_200);
        $ss_champs_200=$this->get_ss_champs($champ_200, array("a", "c", "d", "e", "i"));
        print_r($ss_champs_200);
        $champs_400=$this->get_champs(array("430", "431", "432", "433", "434", "435", "436", "437", "440", "441", "442", "443", "444", "445", "446", "447", "448", "453", "454", "461", "462", "463", "464"));
        print_r($champs_400);
        $ss_champs_400=$this->get_ss_champs($champs_400, "t");
        print_r($ss_champs_400);
        $retour=array_merge ($ss_champs_200, $ss_champs_400);
        return ($this->nettoie_liste($retour));
        
    }
    
    function get_auteurs ($mode="simple") {
        $champs_700=$this->get_champs(array("700","701", "702", "710", "711", "712", "720", "721", "722"));
        $retour=array();
        foreach ($champs_700 as $champ_700) {
            $vedette="";
            $ss_champ_a=$this->get_ss_champ($champ_700, "a");
            $ss_champ_b=$this->get_ss_champ($champ_700, "b");
            $vedette="$ss_champ_a, $ss_champ_b";
            if ($mode === "complet") {
                $ss_champ_f=$this->get_ss_champ($champ_700, "f");
                $ss_champ_4=$this->get_ss_champ($champ_700, "4");
                $fonction=get_intitule_liste_by_code("fonction_auteur", $ss_champ_4);
                $vedette=$vedette.$this->formate_chaine($ss_champ_f, " (", "", ")").$this->formate_chaine($ss_champ_4, " (", "", ")");
            } 
            array_push($retour, $vedette);
        }
        return ($retour);
        
    }
    
    
    function get_auteur($mode="simple") {
        if ($mode=="complet") {
            if (!isset($this->infos["auteurs_affichage"])) {
                $this->get_auteurs("complet");
            }
            if (!isset($this->infos["auteurs_affichage"][0])) {
                return("");
            } else {
                return ($this->infos["auteurs_affichage"][0]);
            }
        } else {
            if (!isset($this->infos["auteurs"])) {
                $this->get_auteurs("simple");
            }
            if (!isset($this->infos["auteurs"][0])) {
                return("");
            } else {
                return ($this->infos["auteurs"][0]);
            }
        }
    }
    
    
    
    
} // fin de la classe
?>

