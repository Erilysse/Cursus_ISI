<?php
$UV_Semestre_Numero = $_POST['numsem'];
$UV_Semestre_Label = $_POST['labelsem'];
$UV_Categorie = $_POST['categorie'];
$UV_Affectation = $_POST['affectation'];
$UV_inUTT = $_POST['inUTT'];
$UV_inProfil = $_POST['inProfil'];
$UV_Credit_Numero = $_POST['numcredit'];
$UV_Resultat = $_POST['result'];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible de se connecter à la base de données";
}
else {
    $reg_insert="insert into etudiant values (".$Etu_Numero.",".$Etu_Nom.",".$Etu_Prenom.",".$Etu_Admission.",".$Etu_Filiere.")";
    if (!(execute_requete($bd,$reg_insert))) {
        echo "ERREUR: L'UV n'a pas pu être enregistré";
    }
    else{
        echo "L'UV a été enregistré";
    }
}

?>