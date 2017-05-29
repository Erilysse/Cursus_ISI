<?php
$Etu_Nom = $_POST['nom']; 
$Etu_Prenom = $_POST['prenom'];
$Etu_Numero = $_POST['numetu'];
$Etu_Admission = $_POST['admission'];
$Etu_Filiere = $_POST['filiere'];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible d'enregistrer l'étudiant";
}
else {
    $reg_insert="insert into etudiant values (".$Etu_Numero.",".$Etu_Nom.",".$Etu_Prenom.",".$Etu_Admission.",".$Etu_Filiere.")";
    if (!(execute_requete($bd,$reg_insert))) {
        echo "ERREUR: L'étudiant n'a pas pu être enregistré";
    }
    else{
        echo "L'étudiant a été enregistré";
    }
}

?>