<?php
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');


$list_cursus = [];
$list_UV = [];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);

if ($bd && isset($_POST['numetu'])) {
    $etu_numero = $_POST['numetu'];
    $request1 = "SELECT * FROM cursus where id_etu = ".$etu_numero."";
    $answer1 = $bd->query($request1);
    if (!empty($answer1)) {
        while ($cursus = $answer1->fetch()) {
            $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus = ".$cursus['id']."";
            $answer2 = $bd->query($request2);
            if (!empty($answer2)) {
                while ($data = $answer2->fetch()) {
                    array_push($list_UV, [$data['sem_seq'],$data['sem_label'],$data['categorie'],$data['sigle'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
                }
            array_push($list_cursus, [$cursus['nom'],$list_UV]);
            }
        }
    }
}

function affichageCursus($list_cursus) {
    foreach ($list_cursus as $key => $cursus) {
        echo "<table cellpadding='5px' cellspacing='5px' rules='all' style='border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;'>
                <tr>
                <th>Nom du Cursus</th>
                <th>Semestre</th>
                <th>Libellé du Semestre</th>
                <th>Catégorie</th>
                <th>UV</th>
                <th>Faite à l'UTT</th>
                <th>Dans le profil</th>
                <th>Résultat</th>
                <th>Crédits</th>
                </tr>";
        foreach ($cursus[1] as $key => $UV) {
        echo "<tr>";
        echo "<th>".$cursus[0]."</th>";
        foreach($UV as $key => $value) {
            echo "<th>" . $value . "</th>";
        }
        echo "</tr>";
        }
        echo "</table><br>";
    }
}
?>
<html>
    <head>
        <title>Cursus des étudiants</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="bandeau">Rechercher :
            <form method="POST" id='VoirCursus' name='VoirCursus' action="Visualisation_Cursus_Etudiant.php">
            <div>Numéro de l'étudiant :<input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
            <div>
                <a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a>
                <input type='reset' value='Annuler' />
            </div>
            </form>
        </div>
        <div id="menu"><?php include('index.php'); ?></div>
        <h1>Vos cursus</h1>
    <?php if (isset($etu_numero)) {
    affichageCursus($list_cursus); ?>
    <div>
        <form
            <input type="hidden" name="numetu" value="<?php if (isset($etu_numero)) { $etu_numero; } ?>">
            <a href="Formulaire_Modification.php"><input type='submit' value='Modifier le Cursus' /></a>
            <a href="Supprimer_Cursus.php"><input type='submit' value='Supprimer le Cursus' /></a>
            <a href="Dupliquer_Cursus.php"><input type='submit' value='Dupliquer le Cursus' /></a>
        </form>
    </div>
    <?php } ?>
</body>
</html>