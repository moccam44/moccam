<?php

class notice extends notice_marc {
    var $infos=array();
    // var $notice est hérité de notice_marc
    

    public function __construct($notice) {
        parent::__construct($notice);
    }
    
    function get_infos () {
        $this->infos=array(); // raz
        $this->infos["titre"]=$this->get_titre();
        $this->infos["titres"]=$this->get_titres();
        $this->infos["auteurs"]=$this->get_auteurs("simple");
        $this->infos["auteurs_affichage"]=$this->get_auteurs("complet");
        $this->infos["auteur"]=$this->get_auteur("simple");
        $this->infos["auteur_affichage"]=$this->get_auteur("complet");
        $infos_editeur=$this->get_infos_editeur();
        $this->infos["nom_editeur"]=$infos_editeur["editeur"];
        $this->infos["lieu_editeur"]=$infos_editeur["lieu"];
        $this->infos["date_editeur"]=$infos_editeur["date"];
        $this->infos["date_editeur_int"]=date_str_2_int($this->infos["date_editeur"]);
        $this->infos["EAN"]=$this->get_EAN();
        $this->infos["resume"]=$this->get_resume();
        $this->infos["sujets"]=$this->get_sujets();
        $this->infos["collection"]=$this->get_collection();
        $infos_collation=$this->get_infos_collation();
        $this->infos["pagnation"]=$infos_collation["pagination"];
        $this->infos["format"]=$infos_collation["format"];
        $this->infos["deweys"]=$this->get_deweys();
        $infos_langue=$this->get_infos_langue();
        $this->infos["langue_texte"]=$infos_langue["langue_texte"];
        $this->infos["langue_origine"]=$infos_langue["langue_origine"];
        $infos_label=$this->get_infos_label();
        $this->infos["type_doc"]=$infos_label["type_doc"];
        $this->infos["niveau_biblio"]=$infos_label["niveau_biblio"];
        $this->infos["niveau_hierarchique"]=$infos_label["niveau_hierarchique"];
        $this->infos["origine"]="inconnu";
        $this->infos["qualite"]=1;

        $this->infos["tousmots"]=$this->get_tous_mots($this->infos);
        $str_embedding=$this->get_str_embedding($this->infos);
        try {
            $this->infos["embedding"]=$this->get_embedding($str_embedding);
            $this->infos["date_embedding"]=date("Y-m-d");
        } catch (Exception $e) {
            $this->infos["embedding"]="";
            $this->infos["date_embedding"]="0000-00-00";
            print($e->getMessage());
        } 
        $this->infos["json"]=json_encode($this->notice);
 
        
        //print_r($this->infos);
        return ($this->infos);
    }
    
    function get_titre () {
        return($this->get("200", "a"));
    }
    
    function get_titres () {
        $champ_200=$this->get_champ("200");
        $ss_champs_200=$this->get_ss_champs($champ_200, array("a", "c", "d", "e", "i"));
        $champs_400=$this->get_champs(array("430", "431", "432", "433", "434", "435", "436", "437", "440", "441", "442", "443", "444", "445", "446", "447", "448", "453", "454", "461", "462", "463", "464"));
        $ss_champs_400=$this->get_ss_champs($champs_400, "t");
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
                $vedette=$vedette.$this->formate_chaine($ss_champ_f, " (", "", ")").$this->formate_chaine($fonction, " (", "", ")");
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
    
    function get_infos_editeur () {
        $retour=array();
        
        // tentative avec le champ 214 ayant id2==0
        $champs_214=$this->get_champs("214");
        foreach ($champs_214 as $champ_214) {
            if ($champ_214["id2"]=="0") {
                $retour["editeur"]=$this->get_ss_champ($champ_214,"c");
                $retour["lieu"]=$this->get_ss_champ($champ_214,"a");
                $retour["date"]=$this->get_ss_champ($champ_214,"d");
                return ($retour);
            }
        }
        
        // si pas trouvé, tentative avec champ 210
        $champ_210=$this->get_champ("210");
        $retour["editeur"]=$this->get_ss_champ($champ_210,"c");
        $retour["lieu"]=$this->get_ss_champ($champ_210,"a");
        $retour["date"]=$this->get_ss_champ($champ_210,"d");
        
        return ($retour);
    }
    
    function get_EAN () {
        $elem=$this->get("010", "a");
        if ($elem == "") {
            $elem=$this->get("073", "a");
        }
        return(traite_EAN($elem));
    }
    
    function get_resume () {
        return ($this->get("330", "a"));
    }
    
    function get_sujets () {
        $retour=array();
        $champs_600=$this->get_champs(array("600", "601", "602", "604", "605", "606", "607", "608", "610", "615", "616", "620", "626"));
        foreach ($champs_600 as $champ_600) { // pour chaque champ
            $chaine="";
            foreach ($champ_600["sous_champs"] as $ss_champ) {
                
                $code=$ss_champ["code"];
                $valeur=$ss_champ["valeur"];
                if (!is_numeric($code)) {
                    $chaine.=$this->formate_chaine($valeur, "", ". ","", $chaine);
                }
            } // fin du pour chaque sous-champ
            array_push($retour, $chaine);
        } // fin du pour chaque champ
        return ($retour);
    }
    
    function get_collection () {
        $collection_410=$this->get("410", "t");
        if ($collection_410 !== "") {
            return ($collection_410);
        } else {
            return ($this->get("225", "a"));
        }
    }
    
    function get_infos_collation () {
        $retour=array();
        $champ_215=$this->get_champ("215");
        $retour["pagination"]=$this->get_ss_champ($champ_215, "a");
        $retour["format"]=$this->get_ss_champ($champ_215, "d");
        return ($retour);
    }
    
    function get_deweys () {
        $retour=array();
        $champs_676=$this->get_champs("676");
        foreach ($champs_676 as $champ_676) {
            array_push($retour, $this->get_ss_champ($champ_676, "a"));
        }
        return($this->nettoie_liste($retour));
    }
    
    function get_infos_langue () {
        $retour=array();
        $champ_101=$this->get_champ("101");
        $code_langue_texte=strtolower($this->get_ss_champ($champ_101, "a"));
        $code_langue_origine=strtolower($this->get_ss_champ($champ_101, "c"));
        $retour["langue_texte"]=get_intitule_liste_by_code("langue",$code_langue_texte, $code_langue_texte);
        $retour["langue_origine"]=get_intitule_liste_by_code("langue",$code_langue_origine, $code_langue_origine);

        return ($retour);
    }
    
    function get_infos_label () {
        $retour=array();
        $retour["type_doc"]=substr($this->notice["label"], 6, 1);
        $retour["niveau_biblio"]=substr($this->notice["label"], 7, 1);
        $retour["niveau_hierarchique"]=substr($this->notice["label"], 8, 1);
        return ($retour);
    }
    
    function get_str_embedding ($infos) {
        $retour="";
        $intro="Le titre du livre est : ";
        if ($infos["type_doc"] === "g") {
            $intro="Le titre de la vidéo est : ";
        } elseif ($infos["type_doc"] === "i" OR $infos["type_doc"] === "j") {
            $intro="Le titre du CD est : ";
        }
        
        $retour.=$intro;
        $retour.=implode(". ", $infos["titres"]).". ";
        
        if (count($infos["sujets"]) > 0) {
            $retour.="Les sujets abordés sont les suivants : ";
            $retour.=implode(". ", $infos["sujets"]).". ";
        } 
        
        if ($infos["resume"] != "") {
            $retour.="Le résumé est le suivant : ".$infos["resume"];
        }
        
        return ($retour);     
    }
    
    function get_embedding ($chaine) {
        $embedding=new embedding();
        return ($embedding->getEmbedding($chaine));
    }
    
    function get_tous_mots ($infos) {
        print_r($infos);
        $retour="";
        $retour.=implode(" | ", $infos["titres"])." | ";
        if (count($infos["sujets"]) > 0) {
            $retour.=implode(" | ", $infos["sujets"]);
            $retour.=" | ";
        }
        if (count($infos["auteurs"]) > 0) {
            $retour.=implode(" | ", $infos["auteurs"]);
            $retour.=" | ";
        }
        if ($infos["editeur"] != "") {
            $retour.=$infos["editeur"]." | ";
        }
        if ($infos["resume"] != "") {
            $retour.=$infos["resume"]." | ";
        }
        return ($retour);
    }
    
    
    
    
} // fin de la classe
?>

