<?php
/**
 * Cette classe gère le format marc iso essentiellement pour le convertir en json
 * 
 */

class marc {
    var $separateur_ss_champs=""; // séparateur des sous-champs dazns un champ
    var $separateur_champs=""; // séparateur des champs dans une notice 
    var $repertoire_notices; // le répertoire des notices contenues dans un fichier avec pour chacune la pos du 1er et du dernier caractère
    var $file; // pointeur vers le fichier de notices
    
    /**
     * notice_marc_2_json
     * convertit une chaine de caractère en format marc en array
     * @param array $parametres
     *   [notice] => la notice (chaine de caractères)
     * 
     */
    function notice_marc_2_array ($parametres) {
        $notice=$parametres["notice"];
        $notice_array=array();
        $notice_array["champs"]=array();
        $adresse_1e_car=substr($notice,12,5);
	$zone_adresse=substr($notice, 24, $adresse_1e_car-25);
	$zone_champs=substr($notice, $adresse_1e_car-1, strlen($notice)-$adresse_1e_car+1);
        $str_label=substr($notice,0,24);
        $notice_array["label"]=$str_label;
        
        for ($i=0;$i<strlen($zone_adresse)/12;$i++) {//////////////////////////////   POUR CHAQUE CHAMP...
            $nom_champ=substr($zone_adresse,$i*12,3);
            $sous_champs=$this->get_ss_champs ($i, $zone_adresse, $zone_champs);
            $nbre_ss_champs=count($sous_champs);
            $champ=array("tag"=>$nom_champ, "id1"=>"", "id2"=>"", "sous_champs"=>array(), "valeur"=>"");
            // Gestion des indicateurs
            if ($nbre_ss_champs>1) { // S'il y a des indicateurs et des sous-champs
                $champ["id1"]=substr($sous_champs[0],1,1);
                $champ["id1"]=substr($sous_champs[0],2,1);

                for ($j=1;$j<=$nbre_ss_champs-1;$j++) {    ////////////////   POUR CHAQUE SOUS CHAMP...
                    $str_ss_champ=substr($sous_champs[$j], 1, strlen($sous_champs[$j])-1);
                    $code_ss_champ=substr($sous_champs[$j], 0, 1);
                    array_push($champ["sous_champs"], array("code"=>$code_ss_champ, "valeur"=>$str_ss_champ));
                }
            } else { // un seul élément
                $champ["valeur"]=$sous_champs[0];
            }
            array_push($notice_array["champs"], $champ);
        
        } // fin du pour chaque champ...
        return ($notice_array);

    }
    
    /**
     * get_ss_champs
     * convertit une chaine de caractère en format marc en array
     * @param int idx_champ le n° du champ à extraire
     * @param string zone_adresse la zone d'adresse sous forme de chaine
     * @param string zone_adresse la zone des champs sous forme de chaine
     * 
     * @return array sous-champs 
     * 
     */
    function get_ss_champs ($idx_champ, $zone_adresse, $zone_champs) {
        $pos=$idx_champ*12+3;
        $longueur_champ=substr($zone_adresse,$pos,4);
        $pos=$pos+4;
        $adresse_champ=substr($zone_adresse,$pos,5);
        $valeur_champ=substr($zone_champs, $adresse_champ, $longueur_champ);
        $sous_champs=explode ($this->separateur_ss_champs, $valeur_champ);
        return ($sous_champs);
    }
    
    function open_file ($chemin_fichier) {
        $this->file=fopen($chemin_fichier, "rb");
        if ($this->file === false) {
            throw new Exception("impossible d'ouvrir $chemin_fichier");
        }
    }
    
    /**
     * genere_rep_notices
     * génère un répertoire de toutes les notices contenues udans un fichier marc avec à chaque fois la position du 1er caractère et du dernier caractère de la notice
     * 
     */
    function genere_rep_notices () {
        $last="";//dernier caractère lu
        $car="";// caractère à lire
        $pos_last=0;
        $idx=0;
        $rep=array();
        while (!feof($this->file)) {
            $last=$car;
            $car=fgetc($this->file);
            if ($last.$car==$this->separateur_champs) {
                array_push($rep, array("debut"=>$pos_last, "fin"=>$idx-2));
                $pos_last=$idx+1;
            }
            $idx++;
        }
        if (count ($rep)==0) {
            throw new Exception("aucune notice trouvée dans le fichier");
        }
        return ($rep);
    }
    
     /**
     * get_notice
     * récupère une notice du fichier à partir de son index. le répertoire doit avoir été généré avant
     * @param int idx => n° de notice 

     */
    function get_notice_from_file ($idx) {
        $infos=$this->repertoire_notices[$idx];
        $debut=$infos["debut"];
        $fin=$infos["fin"];
        $longueur=($fin-$debut)+1;
        fseek($this->file, $debut, SEEK_SET);
        $notice=fread($this->file, $longueur);
        return ($notice);
        
    }
    
    function setup_file ($chemin_fichier) {
        $this->open_file($chemin_fichier);
        $this->repertoire_notices=$this->genere_rep_notices();
        
    }
    
    
    
} // fin de la classe







?>
