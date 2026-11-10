<?php

class notice extends notice_marc {
    var $infos=array();
    

    public function __construct($notice) {
        parent::__construct($notice);
    }
    
    function get_infos () {
        $this->infos["titre"]=$this->get_titre();
        $this->infos["titres"]=$this->get_titres();
        
        
        print_r($this->infos);
    }
    
    function get_titre () {
        return($this->get("200", "a"));
    }
    
    function get_titres () {
        $champ_200=$this->get_champ("200");
        $ss_champs_200=$this->get_ss_champs($champ_200, array("a", "c", "d", "e", "i"));
        $champs_400=$this->get_champs(array("430", "431", "432", "433", "434", "435", "436", "437", "440", "441", "442", "443", "444", "445", "446", "447", "448", "453", "454", "461", "462", "463", "464"));
        $ss_champs_400=$this->get_ss_champ($champs_400, "t");
        $retour=array_merge ($ss_champs_200, $ss_champs_400);
        return ($this->nettoie_liste($retour));
        
    }
    
    
    
    
} // fin de la classe
?>

