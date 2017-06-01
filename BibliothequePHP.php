<?php

$Categorie_Options = array("CS","TM","ME","EC","HT","NPML","ST");
$Affectation_Options = array("TC","TCBR","FCBR");
$Boolean_Options = array("Oui","Non");
$Resultats_Options = array("A","B","C","D","E","F","FX","ABS","EQU","ADM");

function inputSelect($options, $name) {
    $line = "<select name='.$name.'>";
    $line .= "";
    foreach ($options as $key=>$value) {
        $line .= "<option value='$value'>$value</option>";
    }  
    $line .= "</select>";
    return $line;
}

function inputRadio($options, $name) {
    $line = "";
    foreach($options as $value){
        $line .= "<div><input type='radio' name='$name' value='$value'>$value</div>";
    }
    return $line;
}

function saveCSV($tab,$nom){
    $filename = "./".$nom.".csv";
    if(!file_exists($filename)){
        touch ($filename);
        $ligne = implode(";",$tab);
        file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
    }else{
        $ligne = implode(";",$tab);
        file_put_contents($filename, $ligne."\r\n", FILE_APPEND);
        }
}

function readCSV($nom){
    echo'<ul>';
    $handle = fopen("$nom.csv",'r');
    while ( ($data = fgetcsv($handle) ) !== FALSE ) {
	foreach($data as $value){
            $ligne = str_replace(";", " ", $value);
            echo '<li>'.$ligne.'</li>';
	}
    }
    echo'</ul>';
}

?>