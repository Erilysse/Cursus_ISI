<?php

$Categorie_Options = array("CS", "TM", "ME", "EC", "HT", "NPML", "ST");
$Affectation_Options = array("TC", "TCBR", "FCBR");
$Boolean_Options = array("Oui", "Non");
$Resultat_Options = array("A", "B", "C", "D", "E", "F", "FX", "ABS", "EQU", "ADM");

function debug($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function inputSelect($options, $name) {
    $line = "<select name='$name'>";
    $line .= "";
    foreach ($options as $key => $value) {
        $line .= "<option value='$value'>$value</option>";
    }
    $line .= "</select>";
    return $line;
}

function inputSelectDef($options, $name, $default) {
    $line = "<select name='.$name.'>";
    $line .= "";
    foreach ($options as $key => $value) {
        if ($value == $default) {
            $line .= "<option value='$value' checked='checked' >$value</option>";
        } else {
            $line .= "<option value='$value' >$value</option>";
        }
    }
    $line .= "</select>";
    return $line;
}

function inputRadio($options, $name) {
    $line = "";
    foreach ($options as $value) {
        $line .= "<input type='radio' name='$name' value='$value'>$value";
    }
    return $line;
}

function inputRadioDef($options, $name, $default) {
    $line = "";
    $tmp = "";
    foreach ($options as $value) {
        $tmp = $value;
        if ($tmp == $default) {
            $line .= "<input type='radio' checked='checked' name='$name' value='$tmp'>$value";
        } else {
            $line .= "<input type='radio' name='$name' value='$tmp'>$value";
        }
    }
    return $line;
}

function inputRadioReq($bd, $req, $name) {
    $line = "";
    //$options=array();
    //array_push($options,execute_select_ss_view($bd,$req));
    //print_r($options);
    foreach (execute_select_ss_view($bd, $req) as $value) {
        foreach ($value as $temp) {
            $line .= "<input type='radio' name='$name' value='$temp'>$temp";
        }
    }
    return $line;
}

function saveCSV($tab, $nom) {
    $filename = "./" . $nom . ".csv";
    if (!file_exists($filename)) {
        touch($filename);
        $ligne = implode(";", $tab);
        file_put_contents($filename, $ligne . "\r\n", FILE_APPEND);
    } else {
        $ligne = implode(";", $tab);
        file_put_contents($filename, $ligne . "\r\n", FILE_APPEND);
    }
}

function readCSV($nom) {
    echo'<ul>';
    $handle = fopen("$nom.csv", 'r');
    while (($data = fgetcsv($handle) ) !== FALSE) {
        foreach ($data as $value) {
            $ligne = str_replace(";", " ", $value);
            echo '<li>' . $ligne . '</li>';
        }
    }
    echo'</ul>';
}

?>