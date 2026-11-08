<?php

class iso5426 {
    var $tableau_encode=array();
    var $tableau_decode=array();
    var $correspondances = <<<TEXT
{
    "9_apostrophe_entity": {
        "a": "27",
        "b": "26 72 73 71 75 6f 3b",
        "sens_unique": "ba"
    },
    "ae": {
        "a": "E6",
        "b": "f1"
    },
    "AE_maj": {
        "a": "C6",
        "b": "e1"
    },
    "Amaj_aigu": {
        "a": "C1",
        "b": "c2 41"
    },
    "Amaj_circ": {
        "a": "C2",
        "b": "c3 41"
    },
    "Amaj_grave": {
        "a": "C0",
        "b": "c1 41"
    },
    "Amaj_rond": {
        "a": "C5",
        "b": "ca 41"
    },
    "Amaj_tilde": {
        "a": "C3",
        "b": "c4 41"
    },
    "Amaj_trema": {
        "a": "C4",
        "b": "c9 41"
    },
    "apostrophe_apostrophe": {
        "a": "DE",
        "b": "ec"
    },
    "a_aigu": {
        "a": "E1",
        "b": "c2 61"
    },
    "a_circ": {
        "a": "E2",
        "b": "c3 61"
    },
    "a_grave": {
        "a": "E0",
        "b": "c1 61"
    },
    "a_rond": {
        "a": "E5",
        "b": "ca 61"
    },
    "a_tilde": {
        "a": "E3",
        "b": "c4 61"
    },
    "a_trema": {
        "a": "E4",
        "b": "c8 61"
    },
    "beta": {
        "a": "DF",
        "b": "fb"
    },
    "Cmaj_cedille": {
        "a": "C7",
        "b": "d0 43"
    },
    "c_cedille": {
        "a": "E7",
        "b": "d0 63"
    },
    "Emaj_aigu": {
        "a": "C9",
        "b": "c2 45"
    },
    "Emaj_circ": {
        "a": "CA",
        "b": "c3 45"
    },
    "Emaj_grave": {
        "a": "C8",
        "b": "c1 45"
    },
    "Emaj_trema": {
        "a": "CB",
        "b": "c9 45"
    },
    "e_aigu": {
        "a": "E9",
        "b": "c2 65"
    },
    "e_circ": {
        "a": "EA",
        "b": "c3 65"
    },
    "e_grave": {
        "a": "E8",
        "b": "c1 65"
    },
    "e_trema": {
        "a": "EB",
        "b": "c8 65"
    },
    "Imaj_aigu": {
        "a": "CD",
        "b": "c2 49"
    },
    "Imaj_circ": {
        "a": "CE",
        "b": "c3 49"
    },
    "Imaj_grave": {
        "a": "CC",
        "b": "c1 49"
    },
    "Imaj_trema": {
        "a": "CF",
        "b": "c8 49"
    },
    "i_aigu": {
        "a": "ED",
        "b": "c2 69"
    },
    "i_circ": {
        "a": "EE",
        "b": "c3 69"
    },
    "i_grave": {
        "a": "EC",
        "b": "c1 69"
    },
    "i_trema": {
        "a": "EF",
        "b": "c8 69"
    },
    "Nmaj_tilde": {
        "a": "D1",
        "b": "c4 4e"
    },
    "n_tilde": {
        "a": "F1",
        "b": "c4 6e"
    },
    "Omaj_aigu": {
        "a": "D3",
        "b": "c2 4f"
    },
    "Omaj_circ": {
        "a": "D4",
        "b": "c3 4f"
    },
    "Omaj_grave": {
        "a": "D2",
        "b": "c1 4f"
    },
    "Omaj_tilde": {
        "a": "D5",
        "b": "c4 4f"
    },
    "Omaj_trema": {
        "a": "D6",
        "b": "c9 4f"
    },
    "o_aigu": {
        "a": "F3",
        "b": "c2 6f"
    },
    "o_barre": {
        "a": "F8",
        "b": "f9"
    },
    "o_circ": {
        "a": "F4",
        "b": "c3 6f"
    },
    "o_exposant": {
        "a": "B0",
        "b": "6F",
        "sens_unique": "ab"
    },
    "o_grave": {
        "a": "F2",
        "b": "c1 6f"
    },
    "o_tilde": {
        "a": "F5",
        "b": "c4 6f"
    },
    "o_trema": {
        "a": "F6",
        "b": "c8 6f"
    },
    "Umaj_aigu": {
        "a": "DA",
        "b": "c2 55"
    },
    "Umaj_circ": {
        "a": "DB",
        "b": "c3 55"
    },
    "Umaj_grave": {
        "a": "D9",
        "b": "c1 55"
    },
    "Umaj_trema": {
        "a": "DC",
        "b": "c9 55"
    },
    "u_aigu": {
        "a": "FA",
        "b": "c2 75"
    },
    "u_circ": {
        "a": "FB",
        "b": "c3 75"
    },
    "u_grave": {
        "a": "F9",
        "b": "c1 75"
    },
    "u_trema": {
        "a": "FC",
        "b": "c8 75"
    },
    "XX": {
        "a": "FE",
        "b": "ec"
    },
    "Ymaj_aigu": {
        "a": "DD",
        "b": "c2 59"
    },
    "y_aigu": {
        "a": "FD",
        "b": "c2 79"
    },
    "y_trema": {
        "a": "FF",
        "b": "c8 79"
    }
}
TEXT;
    
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    
    function init() {
        $tmp=json_decode($this->correspondances, true);
        foreach ($tmp as $bidon => $info) {
            $a=$infos["a"];
            $b=$infos["b"];
            $sens_unique=$infos["sens_unique"];
            $a=$this->hex2chr($a);
            $b=$this->hex2chr($b);
            if ($sens_unique == "" OR $sens_unique == "ab") {
                array_push($this->tableau_encode, array($a=>$b));
            }
            if ($sens_unique == "" OR $sens_unique == "ba") {
                array_push($this->tableau_decode, array($b=>$a));
            }
        }
    }
    
    function hex2chr($chaine) {
        $retour="";
        $tmp=explode (" ", $chaine);
        foreach ($tmp as $elem) {
            $retour.=chr(hexdec($elem));
        }
        return ($retour);
    }
    
    function encode ($chaine) {
        $retour=strstr($chaine, $this->tableau_encode);
        return ($retour);
    }
    
    function decode ($chaine, $bool_encode_utf8=false) {
        $retour=strstr($chaine, $this->tableau_decode);
        if ($bool_encode_utf8 === true) {
            $retour= utf8_encode($retour);
        }
        return ($retour);
    }
            
    
    
    
    
} // fin de la classe

?>

