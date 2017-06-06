<?php
include('\include\MYSQL\config.php');
include('\include\MYSQL\bibli_bdd.php');
include ('BibliothequePHP.php');

$Etu_Numero=$_POST['numetu'];
$ID_Cursus = $_POST['id_cursus'];

// Connexion et test de connexion
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible de se connecter";
}
else {
    $reg_insert="SELECT * from etudiant where num_etudiant = $Etu_Numero";
    if (!(execute_requete($bd,$reg_insert))) {
        echo "ERREUR: L'étudiant n'a pas pu être récupéré";
    }
    else{
        echo "On a récupéré les données de l'étudiant";
    }
}
//On récupère toutes les données concernant l'étudiant
$etudiant = new etudiant($cursus->getIDetu(),NULL,NULL,NULL,NULL,$database);
$elements = $cursus->getelem($database);
echo "Cursus ",$cursus->getnomCursus(),' de ';
echo $etudiant->getprenom(),' ',$etudiant->getnom();
//Ouverture du fichier
$fichierCursus = fopen('cursus.csv', 'a+');
//On vide le fichier cursus.csv
ftruncate($fichierCursus,0);
//Inscription des premières lignes
fputs($fichierCursus , "ID;");
fputs($fichierCursus , $etudiant->getID());
fputs($fichierCursus , ";;;;;;;;$retourLigne");
fputs($fichierCursus , "NO;");
fputs($fichierCursus , $etudiant->getnom());
fputs($fichierCursus , ";;;;;;;;$retourLigne");
fputs($fichierCursus , "PR;");
fputs($fichierCursus , $etudiant->getprenom());
fputs($fichierCursus , ";;;;;;;;$retourLigne");
fputs($fichierCursus , "AD;");
fputs($fichierCursus , $etudiant->getadmission());
fputs($fichierCursus , ";;;;;;;;$retourLigne");
fputs($fichierCursus , "FI;");
fputs($fichierCursus , $etudiant->getfiliere());
fputs($fichierCursus , ";;;;;;;;$retourLigne");
fputs($fichierCursus , "==;s_seq;s_label;sigle;categorie;affectation;utt;profil;credit;resultat$retourLigne");
//On inscrit tous les éléments de formations
foreach ($elements as $values){
	$requete = "SELECT * FROM `element_de_formation` WHERE (`sigle` = '$values[ELEMENT_DE_FORMATION_sigle]' AND `sem_seq` = $values[ELEMENT_DE_FORMATION_sem_seq] AND `sem_label` = '$values[ELEMENT_DE_FORMATION_sem_label]' AND `resultat` = '$values[ELEMENT_DE_FORMATION_resultat]' AND `profil` = '$values[ELEMENT_DE_FORMATION_profil]')";
		$resultat = requete($database,$requete);
		$ligne = mysqli_fetch_array($resultat,MYSQLI_ASSOC);
		fputs($fichierCursus, "EL;$ligne[sem_seq];$ligne[sem_label];$ligne[sigle];$ligne[categorie];$ligne[affectation];$ligne[utt];$ligne[profil];$ligne[credit];$ligne[resultat]$retourLigne");
		echo " ";
}
//Fin du fichier csv
fputs($fichierCursus, "END;;;;;;;;;$retourLigne");
fputs($fichierCursus, "$retourLigne");
fputs($fichierCursus, "$retourLigne");
fputs($fichierCursus, "$retourLigne");
fclose($fichierCursus);
Saut();
echo"<a href='cursus.csv' dowload='cursus' > Cliquer ici pour télécharger le fichier </a>";

Revenir($IDetudiant);

mysqli_close($database);