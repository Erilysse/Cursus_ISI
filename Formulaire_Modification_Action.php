<?php

include('BibliothequePHP.php');
include ('include/MYSQL/config.php');
include ('include/MYSQL/bibli_bdd.php');
$bd = connect_bdd($serveur, $utilisateur, $mot_de_passe);

if (!$bd) {
    echo "Impossible d'enregistrer l'étudiant";
} else {
    $cpt = 0;
    foreach ($_POST['id'] as $i) {
        if (isset($_POST['numsem'][$cpt], $_POST['labelsem'][$cpt], $_POST['sigle'][$cpt], $_POST['categorie'.$cpt.''],
                $_POST['affectation'.$cpt.''], $_POST['inUTT'.$cpt.''], $_POST['inProfil'.$cpt.''], $_POST['numcredit'][$cpt],
                $_POST['result'.$cpt.''], $_POST['action'.$cpt.''])) {
            $numsem = $_POST['numsem'][$cpt];
            $labelsem = $_POST['labelsem'][$cpt];
            $sigle = $_POST['sigle'][$cpt];
            $categorie = $_POST['categorie'.$cpt.''];
            $affectation = $_POST['affectation'.$cpt.''];
            $inUTT = $_POST['inUTT'.$cpt.''];
            $inProfil = $_POST['inProfil'.$cpt.''];
            $numcredit = $_POST['numcredit'][$cpt];
            $result = $_POST['result'.$cpt.''];
            $action = $_POST['action'.$cpt.''];
            echo $action;
            if ($action == "Modification") {
                $req = "UPDATE elt_de_formation SET sem_seq=$numsem, sem_label='$labelsem', sigle='$sigle', categorie='$categorie', affectation='$affectation', inutt=$inUTT, inprofil=$inProfil, credit=$numcredit, resultat='$result'  WHERE id=$i";
            } else {
                $req = "DELETE FROM elt_de_formation WHERE id=$i";
            }
            echo $req;
            echo execute_requete($bd, $req);
        } else {
            echo "veuillez remplir tous les champs de toutes les UE : $i";
        }

        $cpt++;
    }
    header("Location: index.php");
}
?>
