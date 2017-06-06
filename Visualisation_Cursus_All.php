<?php
include('\include\MYSQL\config.php');
include('\include\MYSQL\bibli_bdd.php');
$list_cursus = [];
$list_UV = [];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible de se connecter à la base de données";
}
else {
    $reg_insert1 = "SELECT * FROM cursus";
    if (execute_requete($bd,$reg_insert1)) {
        $answer = $bd->query($request1);
        while ($cursus = $answer->fetch()) {
            $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus = $id_cursus";
            $answer2 = $bd->query($request2);
            while ($data = $answer2->fetch()) {
                array_push($list_UV, [$data['sem_seq'],$data['sem_label'],$data['sigle'],$data['categorie'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
            }
        array_push($list_cursus, [$cursus['id'],$cursus['id_etu'],$list_UV]);
        }
    }
}

function affichageCursus($list_cursus) {
 foreach ($list_cursus as $key => $cursus) {
            echo "<tr>";
            foreach ($cursus as $value) {
                echo "<th>" . $value . "</th>";
            }
            echo "</tr>";
            }
}
?>
<html>
    <head>
        <title>Cursus des étudiants</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <table cellpadding="5px" cellspacing="5px" rules="all" style="border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;">
            <tr>
                <th>Numéro du Cursus</th>
                <th>Numéro Etudiant</th>
                <th>Semestre</th>
                <th>Libellé du Semestre</th>
                <th>Catégorie</th>
                <th>UV</th>
                <th>Faite à l'UTT</th>
                <th>Dans le profil</th>
                <th>Résultat</th>
                <th>Crédits</th>
            </tr>
            <?php affichageCursus($list_cursus); ?>
    </table>
    </body>
</html>