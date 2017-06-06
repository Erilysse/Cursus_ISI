<?php
// Récupération des éléments du formulaire ajoutCursus

$Etu_Numero = $_POST['numetu'];

$UV_Semestre_Numero[] = $_POST['numsem'];
$UV_Semestre_Label[] = $_POST['labelsem'];
$UV_Sigle[] = $_POST['sigle'];
$UV_Categorie[] = $_POST['categorie'];
$UV_Affectation[] = $_POST['affectation'];
$UV_inUTT[] = $_POST['inUTT'];
$UV_inProfil[] = $_POST['inProfil'];
$UV_Credit_Numero[] = $_POST['numcredit'];
$UV_Resultat[] = $_POST['result'];

// Récupération de la bibliothèque BDD et de la config pour se connecter à la bdd

include ('config.php');
include ('bibli_bdd.php');
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible de se connecter à la base de données";
}
else {
    // Création du cursus d'après le numéro étu
    $reg_insert1="insert into cursus values (NULL,".$Etu_Numero.")";
    // Récupération de l'id du cursus afin de créer les éléments de formation qui le composent
    $id_cursus=mysql_insert_id();
    if (!(execute_requete($bd,$reg_insert1))) {
        echo "ERREUR: Le cursus n'a pas été enregistré";
        // Boucle pour créer les éléments de formation dans la table
        for ($i = 0; $i <= count($UV_Sigle); $i++) {
            $reg_insert2="insert into elt_de_formation values (NULL,$id_cursus,".$UV_Semestre_Numero[$i].",".$UV_Semestre_Label[$i].","
                .$UV_Sigle[$i].",".$UV_Categorie[$i].",".$UV_Affectation[$i].",".$UV_inUTT[$i].",".$UV_inProfil[$i].","
                .$UV_Credit_Numero[$i].",".$UV_Resultat[$i].")";
            if (!(execute_requete($bd,$reg_insert2))) {
                echo "ERREUR: L'element de formation n'a été enregistré";
            }
            else{
                echo "L'element a été enregistré";
            }
        }
    }
    else{
        echo "Le cursus a été enregistré";
    }
}
?>