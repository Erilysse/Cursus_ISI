<?php

function execute_requete($bd,$la_requete){
    $reponse = $bd->exec($la_requete);
    if ($reponse === FALSE) {
        return false;
    } else {
        return true;
    }
}

function execute_select_ss_view($bd,$la_requete){
    $reponse = $bd->query($la_requete);
    if ($reponse === FALSE) {
        echo "<br><b>".$la_requete."</b><br>";
        $errInfos = $bd->errorInfo();
        echo 'La requete a echouee pour la raison suivante: '.$errInfos[2];
        return false;
    } else {
        $tab_res=$reponse->fetchAll(PDO::FETCH_ASSOC);
        return $tab_res;
    }
}

function execute_select($bd,$la_requete,$aff_req=true){
    $reponse = $bd->query($la_requete);
    if ($reponse === FALSE) {
        $errInfos = $bd->errorInfo();
        echo 'La requete a echouee pour la raison suivante: '.$errInfos[2];
        return false;
    } else {
        $tab_res=$reponse->fetchAll(PDO::FETCH_ASSOC);
        $i=1;
        if ($aff_req)
            echo "<br><b>".$la_requete."</b><br>";
        echo "<table>";
        foreach($tab_res as $un_res){
            if ($i==1){
                echo "<tr><th>".implode('</th><th>',array_keys($un_res))."</th></tr>";
                $i++;
            }
            echo "<tr><td>".implode('</td><td>',$un_res)."</td></tr>";
        }
        echo "</table>";
        return true;
    }
}

function connect_bdd($serveur, $utilisateur, $mot_de_passe){

   
    try {
        $bd = new PDO($serveur, $utilisateur, $mot_de_passe);
        // echo "BDD connectee";
        return $bd;
    } catch (PDOException $e) {
        echo "La connexion a la base via la chaine [".$serveur."] a echouee".
            " pour la raison suivante: ".$e->getMessage();
        return false;
    }
}

function execute_insert($bd,$un_fichier){
    $fic = fopen($un_fichier, "r");
    $i=0;
    $j=0;
    if ($fic) {
        while (!feof($fic)) {
            $ligne = fgets($fic, 4096);
            if (!(execute_requete($bd,$ligne))){
                echo "<p>".$ligne." : non executee</p>";
                $j++;
            }else
                $i++;
        }
        fclose($fic);
        echo "<p>Nb. de ligne(s) ajoutee(s) : ".$i."<br>Nb. de ligne(s) ignoree(s) : ".$j."</p>";
        return true;
    }else{
        echo "<p>fichier non trouvee</p>";
        return false;
    }
}

function table_max_id($bd,$table,$chp){
    $req_max="select IFNULL(max(".$chp."),0) AS L_ID from ".$table;
    $reponse = $bd->query($req_max);
    if ($reponse === FALSE) {
        $errInfos = $bd->errorInfo();
        echo "<p>".$req_max."</p>";
        echo "<p>La requete a echouee pour la raison suivante: ".$errInfos[2]."</p>";
        echo "<p>erreur de recuperation l'identifiant</p>";
        return false;
    } else {
        $tab_res=$reponse->fetch(PDO::FETCH_ASSOC);
        return $tab_res['L_ID'];
    }
}

?>
