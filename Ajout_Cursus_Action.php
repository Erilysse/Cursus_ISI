<?php
// Récupération des éléments du formulaire ajoutCursus

$UV_Semestre_Numero[] = array();
$UV_Semestre_Label[] = array();
$UV_Sigle[] = array();
$UV_Categorie[] = array();
$UV_Affectation[] = array();
$UV_inUTT[] = array();
$UV_inProfil[] = array();
$UV_Credit_Numero[] = array();
$UV_Resultat[] = array();

for($i=0;$i<$compteur;$i++){

    $UV_Semestre_Label[$i] = $_POST['labelsem'.$i];
    $UV_Sigle[$i] = $_POST['sigle'.$i];
    $UV_Categorie[$i] = $_POST['categorie'.$i];
    $UV_Affectation[$i] = $_POST['affectation'.$i];
    $UV_inUTT[$i] = $_POST['inUTT'.$i];
    $UV_inProfil[$i] = $_POST['inProfil'.$i];
    $UV_Credit_Numero[$i] = $_POST['numcredit'.$i];
    $UV_Resultat[$i] = $_POST['result'.$i];
}

$Etu_Numero = $_POST['numetu'];
$Cursus_Nom = $_POST['nomcursus'];

// Récupération de la bibliothèque BDD et de la config pour se connecter à la bdd

include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
    // Création du cursus d'après le numéro étu
    $request1="INSERT INTO `cursus`(`id`, `id_etu`, `nom`) values (NULL,".$Etu_Numero.",'".$Cursus_Nom."')";
    if (!(execute_requete($bd,$request1))) {
        echo "ERREUR: Le cursus n'a pas été enregistré";
    }
    else{
        // Récupération de l'id du cursus afin de créer les éléments de formation qui le composent
        $id_cursus=lastInsertId();
        // Boucle pour créer les éléments de formation dans la table
        for ($i = 0; $i <= count($UV_Sigle); $i++) {
            $request2="INSERT INTO `elt_de_formation`(`id`, `id_cursus`, `sem_seq`, `sem_label`, `sigle`, `categorie`, `affectation`, `inutt`, `inprofil`, `credit`, `resultat`)"
                    . " values (NULL,".$id_cursus.",".$UV_Semestre_Numero[$i].",'".$UV_Semestre_Label[$i]."','"
                .$UV_Sigle[$i]."','".$UV_Categorie[$i]."','".$UV_Affectation[$i]."','".$UV_inUTT[$i]."','".$UV_inProfil[$i]."',"
                .$UV_Credit_Numero[$i].",'".$UV_Resultat[$i]."')";
            if (!(execute_requete($bd,$request2))) {
                echo "ERREUR: L'element de formation n'a été enregistré";
            }
            else{
                echo "L'element a été enregistré";
            }
        }
        echo "Le cursus a été enregistré";
    }
}
else {
        echo "Impossible de se connecter à la base de données";
}
?>