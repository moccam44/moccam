<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
header('Content-type: text/html; charset=UTF-8');
//header('Content-type: text/html; charset=iso-8859-1');
include_once ("php/conf/listes.php");

include_once ("php/classes/marc.php");
include_once ("php/classes/iso5426.php");
include_once ("php/classes/notice_marc.php");
include_once ("php/classes/notice.php");

include_once ("php/fonctions/listes.php");
include_once ("php/fonctions/util.php");

print ("debut <br> \n");
// initialisation de iso5426
$iso5426=new iso5426();
$iso5426->init();

try {
    $marc=new marc(array("encodage"=>"iso5426"));
    print ("ouverture de /var/marc/panier.pan <br>\n");
    $marc->setup_file("/var/marc/panier.pan");

    /**
    foreach ($marc->repertoire_notices as $idx => $infos) {
        $chaine=$marc->get_notice_from_file($idx);
        $tableau=$marc->notice_marc_2_array(array("notice"=>$chaine));
        print ("<br> <b> NOTICE $idx </b></br> \n");
        print_r($tableau);
    }
     * 
     */
    
    $limite=5;
    foreach ($marc->repertoire_notices as $idx => $infos) {
        $notice_str=$marc->get_notice_from_file($idx);
        $notice_array=$marc->notice_marc_2_array(array("notice"=>$notice_str));
        print_r($notice_array);
        $notice=new notice($notice_array);
        $notice->get_infos();
        
        if ($idx >= $limite) {
            die ("limite $limite atteinte");
        }
        
        
    }
    //$notice_str=$marc->get_notice_from_file(5);
    //$notice_array=$marc->notice_marc_2_array(array("notice"=>$notice_str));
    //print_r($notice_array);
    //$notice=new notice_marc($notice_array);
    
    //print ("\n<br>titre : ".$notice->get("200", "a"));
    //$champ_200=$notice->get_champ(200);
    //print_r($champ_200);
    
    //$titre=$notice->get_ss_champ($champ_200, "a");
    //print_r($titre);
    //$notice=new notice($notice_array);
    //$notice->get_infos();
    

    
    
} catch (Exception $e) {
    print($e->getMessage());
}


print ("fin <br> \n");


?>
