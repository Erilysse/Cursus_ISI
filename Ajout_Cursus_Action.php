<?php
// Récupération de la bibliothèque BDD et de la config pour se connecter à la bdd

include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');

$compteur = $_POST['compteur'];
$Etu_Numero = $_POST["numetu"];
$Cursus_Nom = $_POST["nomcursus"];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
    // Création du cursus d'après le numéro étu
    $request1="INSERT INTO `cursus`(`id`, `id_etu`, `nom`) values (NULL,".$Etu_Numero.",'".$Cursus_Nom."')";
    if (!(execute_requete($bd,$request1))) {
        echo "ERREUR: Le cursus n'a pas été enregistré";
    }
    else{
        echo "Le cursus a ete enregistre, au tour des elements";
        // Récupération de l'id du cursus afin de créer les éléments de formation qui le composent
        $id_cursus=table_max_id($bd,'cursus','id');
                 
            foreach ($_POST['compteur'] as $i) {
            // Récupération des éléments du formulaire ajoutCursus

            $UV_Semestre_Numero = $_POST['numsem'][$i];
            $UV_Semestre_Label = $_POST["labelsem"][$i];
            $UV_Sigle = $_POST["sigle"][$i];
            $UV_Categorie = $_POST['categorie'][$i];
            $UV_Affectation = $_POST['affectation'][$i];
            $UV_inUTT = $_POST["inUTT"][$i];
            $UV_inProfil = $_POST["inProfil"][$i];
            $UV_Credit_Numero = $_POST["numcredit"][$i];
            $UV_Resultat = $_POST["result"][$i];
            $request2="INSERT INTO `elt_de_formation`(`id`, `id_cursus`, `sem_seq`, `sem_label`, `sigle`, `categorie`, `affectation`, `inutt`, `inprofil`, `credit`, `resultat`)"
                    . " values (NULL,$id_cursus,$UV_Semestre_Numero,'$UV_Semestre_Label','$UV_Sigle','"
                    . "$UV_Categorie','$UV_Affectation','$UV_inUTT','$UV_inProfil',$UV_Credit_Numero,'$UV_Resultat')";
            echo $request2;
            if (!(execute_requete($bd,$request2))) {
                echo "ERREUR: L'element de formation n'a été enregistré";
            }
            else{
                echo "L'element a été enregistré";
            }
        }
        }
    }
else {
        echo "Impossible de se connecter à la base de données";
}
?>