<?php
// Récupère le numéro de l'étudiant afin d'avoir accès à son cursus

$numero_etudiant = $_POST['numetu'];

$request = "select ListUV, id_etu as etudiant from cursus where id_etu = $numero_etudiant";
$answer = $database->query($request);
/*while ($data = $answer->fetch()) {
    array_push(, [$data[""], $data[""], $data[""], $data[""], $data[""]]);
}

function affichageCursus($num_etudiant) {
    foreach ($l as $key => $UV) {
        echo "<tr>";
        foreach ($UV as $value) {
            echo "<th>" . $value . "</th>";
        }
        echo "<th></th>";
        echo "</tr>";
    }
}
 * 
 * PAS FINI
 */
?>

<html>
    <head>
        <title>Cursus de l'étudiant</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <table cellpadding="5px" cellspacing="5px" rules="all" style="border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;">
            <tr>
                <th>Semestre</th>
                <th>Libellé du Semestre</th>
                <th>Catégorie</th>
                <th>UV</th>
                <th>Faite à l'UTT</th>
                <th>Dans le profil</th>
                <th>Résultat</th>
                <th>Crédits</th>
            </tr>
            <?php afficheStudent($list_etudiant) ?>
    </table>
    </body>
</html>