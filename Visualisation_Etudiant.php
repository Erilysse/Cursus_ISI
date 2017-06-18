<?php
// Créer la liste d'étudiant avec les données de la table etudiant de la base de données 
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');

$list_etudiant = [];
$request = "select * from etudiant";
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
$etudiants = $bd->query($request);
while ($data = $etudiants->fetch()) {
    array_push($list_etudiant, [$data["num_etudiant"], $data["nom"], $data["prenom"], $data["admission"], $data["filiere"]]);
}

function affichageEtudiants($list_etudiant) {
    foreach ($list_etudiant as $key => $etudiant) {
        echo "<tr>";
        foreach ($etudiant as $value) {
            echo "<th>" . $value . "</th>";
        }
        echo "<th><form method='POST' id='VoirCursus' name='VoirCursus' action='Visualisation_Cursus_Etudiant.php'>
             <input type='hidden' name='numetu' value='".$etudiant[0]."'>
  <a href='Visualisation_Cursus_Etudiant.php'><input type='submit' value='Voir le cursus' /></a></th>";
        echo "</tr>";
    }
}
?>

<html>
    <head>
        <title>Liste des étudiants</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="bandeau"><a href='Ajout_Etudiant.php'>Ajouter un étudiant</a></div>
        <div id="menu"><?php include('index.php'); ?></div>
        <table cellpadding="5px" cellspacing="5px" rules="all" style="border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;">
            <tr>
                <th>Numéro étudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Admission</th>
                <th>Filière</th>
                <th>Voir Cursus</th>
            </tr>
            <?php affichageEtudiants($list_etudiant) ?>
    </table>
  </body>
</html>