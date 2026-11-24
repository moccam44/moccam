<?php

class notice_db {
    function prepara_data ($infos) {
        $retour=array();
        $retour=$infos; // beaucoup d'infos ne bougent pas
        $retour["titres"]=implode (" | ", $retour["titres"]);
        $retour["auteurs"]=implode (" | ", $retour["auteurs"]);
        $retour["sujets"]=implode (" | ", $retour["sujets"]);
        if (is_array($retour["categories"])) {
            $retour["categories"]=implode (" | ", $retour["categories"]);
        }
        $retour["embedding"]=json_encode($retour["embedding"]);
        $retour= secure_sql($retour);
        return ($retour);

    }
    

    
    function add ($infos) {
        $infos=$this->prepara_data($infos);
        extract($infos);
        try {
            $sql = "insert into notices values (NULL, '$EAN', '$titre', '$titres', '$auteur', '$auteurs', '$nom_editeur', '$date_editeur_int', '$collection', '$serie', '$ID_serie', '$tome', '$sujets', '$resume', '$tousmots', '$categories', '$json', VEC_FromText('$embedding'), '$qualite', '$origine', '$type_doc', '$public', now(), now(), '$date_embedding', 0)";   
            sql_query($sql);
        } catch (mysqli_sql_exception $e){
            print ("<b>Erreur SQL</b><br>\n");
            print ($sql."<br> \n ");
        }
        
        
    }
    
    
    
    
    
    
    
} // fin de la classe
?>
