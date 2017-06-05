<?php
// Récupération des éléments du formulaire
$Etu_Nom= $_POST['nom']; 
$Etu_Prenom = $_POST['prenom'];
$Etu_Numero = $_POST['numetu'];
$Etu_Admission = $_POST['admission'];
$Etu_Filiere = $_POST['filiere'];

// Ajout des fichiers pour la connexion à la bdd
include ('config.php');
include ('bibli_bdd.php');

// Connexion et test de connexion
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible d'enregistrer l'étudiant";
}
else {
    // Ajout des éléments du formulaire dans la base de données étudiant avec test erreur
    $reg_insert="insert into etudiant values (".$Etu_Numero.",".$Etu_Nom.",".$Etu_Prenom.",".$Etu_Admission.",".$Etu_Filiere.")";
    if (!(execute_requete($bd,$reg_insert))) {
        echo "ERREUR: L'étudiant n'a pas pu être enregistré";
    }
    else{
        echo "L'étudiant a été enregistré";
    }
}

?>