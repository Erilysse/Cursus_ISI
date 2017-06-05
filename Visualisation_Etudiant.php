<?php
// Créer la liste d'étudiant avec les données de la table etudiant de la base de données 
include('\include\MYSQL\config.php');
include('\include\MYSQL\bibli_bdd.php');

$list_etudiant = [];
$request = "select * from etudiant";
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
$answer = $bd->query($request);
while ($data = $answer->fetch()) {
    array_push($list_etudiant, [$data["numetu"], $data["nom"], $data["prenom"], $data["admission"], $data["filiere"]]);
}

function affichageEtudiants($list_etudiant) {
    foreach ($list_etudiant as $key => $etudiant) {
        echo "<tr>";
        foreach ($etudiant as $value) {
            echo "<th>" . $value . "</th>";
        }
        // Il manque le lien vers son cursus utiliser un lien avec le numero etudiant
        echo "<th><form method='POST' name='Cursus' action='Visualisation_Cursus_Etudiant.php'>
            <hidden
  <a href='Visualisation_Cursus_Etudiant.php'><input type='submit' value='Voir le cursus' /></a></th>";
        echo "</tr>";
    }
}
?>

<html>
    <head>
        <title>Liste des étudiants</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
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