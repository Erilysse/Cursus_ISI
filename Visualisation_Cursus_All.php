<?php
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');
$list_cursus = [];
$list_UV = [];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);

if ($bd) {
    $request1 = "SELECT * FROM cursus";
    $answer1 = $bd->query($request1);
    if (!empty($answer1)) {
        while ($cursus = $answer1->fetch()) {
            $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus = ".$cursus['id']."";
            $answer2 = $bd->query($request2);
            if (!empty($answer2)) {
                while ($data = $answer2->fetch()) {
                    array_push($list_UV, [$data['sem_seq'],$data['sem_label'],$data['categorie'],$data['sigle'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
                }
            array_push($list_cursus, [$cursus['id_etu'],$cursus['nom'],$list_UV]);
            }
        }
    }
}
else {
     echo "Impossible de se connecter à la base de données";
}

function affichageCursus($list_cursus) {
    foreach ($list_cursus as $key => $cursus) {
        echo "<table cellpadding='5px' cellspacing='5px' rules='all' style='border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;'>";
        echo "<tr>
                <th>Numéro Etudiant</th>
                <th>Nom du Cursus</th>
             </tr>";
        echo "<tr><th>".$cursus[0]."</th>";
        echo "<th>".$cursus[1]."</th></tr></table>";
        echo "<table cellpadding='5px' cellspacing='5px' rules='all' style='border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;'>";
        affichageUV($cursus[2]);
        echo "</table><br>";
    }
}

function affichageUV($list_UV) {
    echo "<tr>
                <th>Semestre</th>
                <th>Libellé du Semestre</th>
                <th>Catégorie</th>
                <th>UV</th>
                <th>Faite à l'UTT</th>
                <th>Dans le profil</th>
                <th>Résultat</th>
                <th>Crédits</th>
            </tr>";
    foreach ($list_UV as $key => $UV) {
         echo "<tr>";
         foreach($UV as $key => $value) {
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
            <h2>Rechercher :</h2>
    <form method="POST" id='VoirCursus' name='VoirCursus' action="Visualisation_Cursus_Etudiant.php">
                <div>Numéro de l'étudiant :<input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
                <div>
                    <a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a>
                    <input type='reset' value='Annuler' />
                </div>
    </form>
        <h1>Cursus de tout les étudiants</h1>
    <?php affichageCursus($list_cursus); ?>
    </body>
</html>