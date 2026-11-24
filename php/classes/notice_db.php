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
    
    function get ($parametres) {
        $criteres=$parametres["criteres"];
        $tris=$parametres["tris"];
        $limite=$parametres["limite"];
        $page=$parametres["page"];
        $nb=$parametres["nb"];

      
        $sql_criteres="";
        foreach ($criteres as $idx_critere => $critere) {
            $sql_criteres.=$this->critere_2_sql($critere, $idx_critere);
        }
        
        $sql_tris="";
        foreach ($tris as $idx_tri => $tri) {
            $sql_tris.=$this->tri_2_sql($tri, $idx_tri);
        }
        
        $sql="SELECT * from notices $sql_criteres $sql_tris limit $limite";
        try {
            $resultat=sql_query($sql);
            $retour=mysqli_fetch_all($resultat);
           print ($sql);
            return ($retour);
        } catch (Exception $ex) {
            print ("<b>Erreur SQL</b><br>\n");
            print ($sql."<br> \n ");
        }

        
    }
    
    function critere_2_sql ($critere, $idx_critere) {
        $sql="";
        if ($idx_critere > 0) {
            $sql.=" ".$critere["booleen"]." ";
        } else {
            $sql.=" WHERE ";
        }
        if ($critere["type"] === "embedding") {
            $embedding=new embedding();
            $vector=$embedding->getEmbedding($critere["valeur"]);
            $vector_str=json_encode($vector);
            $sql.="VEC_DISTANCE(embedding, VEC_FromText('$vector_str')) <= ".$GLOBALS["conf"]["embedding_limite_min"]." ";
        }
        
        return ($sql);
    }
    
    function tri_2_sql ($tri, $idx_tri) {
        $sql="";
        if ($idx_tri > 0) {
            $sql.=", ";
        } else {
            $sql.=" ORDER BY ";
        }
        if ($tri["type"] == "embedding") {
            $embedding=new embedding();
            $vector=$embedding->getEmbedding($tri["valeur"]);
            $vector_str=json_encode($vector);
            $sql.="VEC_DISTANCE(embedding, VEC_FromText('$vector_str')) ";
        }
        return ($sql);
    }
    
    
    
    
    
    
    
    
    
} // fin de la classe
?>
