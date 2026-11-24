<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$GLOBALS["db"] = new mysqli($GLOBALS["conf"]["mysql_server"], $GLOBALS["conf"]["mysql_user"], $GLOBALS["conf"]["mysql_pwd"], $GLOBALS["conf"]["mysql_db"]);
if ($GLOBALS["db"]->connect_errno) {
    die ("impossible de se connecter à la base de données");
}
$GLOBALS["db"]->set_charset('utf8mb4');


function init_db () {
    $sqls=array();
    $sqls[]="DROP TABLE IF EXISTS notices";
    $sqls[]="CREATE TABLE notices ("
            . "ID int PRIMARY KEY "
            . ", EAN VARCHAR (20) UNIQUE"
            . ", titre VARCHAR (255) "
            . ", titres TEXT "
            . ", auteur VARCHAR (255) "
            . ", auteurs TEXT "
            . ", editeur VARCHAR (255) "
            . ", date INT "
            . ", collection VARCHAR (255) "
            . ", serie VARCHAR (255) "
            . ", ID_serie VARCHAR (255) "
            . ", tome VARCHAR (255) "
            . ", sujets TEXT "
            . ", resume TEXT "
            . ", tousmots TEXT "
            . ", categories TEXT "
            . ", json TEXT "
            . ", embedding VECTOR(384) NOT NULL "
            . ", qualite INT "
            . ", origine VARCHAR (255) "
            . ", type_doc VARCHAR (20) "
            . ", public VARCHAR (20) "
            . ", date_import DATE "
            . ", date_modif DATE "
            . ", date_embedding DATE "
            . " ) "
            . "DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $sqls[]="ALTER TABLE notices"
            ." ADD FULLTEXT INDEX titres (titres) "
            .", ADD FULLTEXT INDEX auteurs (auteurs) "
            .", ADD FULLTEXT INDEX tousmots (tousmots) "
            .", ADD FULLTEXT INDEX editeur (editeur) "
            .", ADD FULLTEXT INDEX collection (collection) "
            .", ADD FULLTEXT INDEX categories (categories) "
            .", ADD INDEX date (date) "
            .", ADD INDEX type_doc (type_doc) "
            .", ADD INDEX public (public) "
            .", ADD INDEX date_importe (date_import) "
            .", ADD INDEX date_modif (date_modif) "
            .", ADD INDEX date_embedding (date_embedding) "
            .", ADD VECTOR INDEX embedding (embedding) M=8 DISTANCE=cosine;";

    foreach ($sqls as $sql) {
        print ($sql);
        $resultat=$GLOBALS["db"]->query($sql);
        if ($resultat===false) {
            die ("ERREUR SQL : ".$GLOBALS["db"]->error);
        }
        
        
    }
    
}






?>

