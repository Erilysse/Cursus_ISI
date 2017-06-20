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
            $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus =".$cursus['id']."";
            $answer2 = $bd->query($request2);
            if (!empty($answer2)) {
                while ($data = $answer2->fetch()) {
                    array_push($list_UV, [$data['sem_seq'],$data['sem_label'],$data['categorie'],$data['sigle'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
                }
            array_push($list_cursus, [$cursus['nom'],$list_UV]);
            unset($list_UV);
            $list_UV = [];
            }
            $bulats = "SELECT * INTO elt_de_formation where sigle=NPML and id_cursus=".$cursus['id']."";
            $tn09 = "SELECT * INTO elt_de_formation WHERE sigle=TN09 and id_cursus=".$cursus['id']."";
            $tn10 ="SELECT * INTO elt_de_formation WHERE sigle=TN10 and id_cursus=".$cursus['id']."";
            $tn30 ="SELECT * INTO elt_de_formation WHERE sigle=TN30 and id_cursus=".$cursus['id']."";
        }
    }
}

function affichageCursus($list_cursus,$bulats,$tn10,$tn30,$tn09,$bd) {
    foreach ($list_cursus as $key => $cursus) {
        echo "<table cellpadding='5px' cellspacing='5px' rules='all' style='border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;'>
                <tr><th>Nom du Cursus</th><th>Semestre</th>
                <th>Libellé du Semestre</th><th>Catégorie</th><th>UV</th>
                <th>Faite à l'UTT</th><th>Dans le profil</th><th>Résultat</th>
                <th>Crédits</th></tr>";
        foreach ($cursus[1] as $key => $UV) {
            echo "<tr>";
            echo "<th>".$cursus[0]."</th>";
            foreach($UV as $key => $value) {
                echo "<th>" . $value . "</th>";
            }
        echo "</tr>";
        }
        echo "</table><br>";
        analyseCursus($bulats,$tn10,$tn30,$tn09,$bd);
    }
}

function analyseCursus($bulats,$tn10,$tn30,$tn09,$bd) {
        echo "BULATS :";
        if(execute_requete($bd,$bulats)) { 
            echo "OK";
        } else {
            echo "Manquant <br>";
        }
        echo "Stages : ";
        if ((execute_requete($bd,$tn10) || execute_requete($bd,$tn30)) && execute_requete($bd,$tn09)) {
            echo " OK ";
        } else {
            echo "TN09 ou TN10/TN30 Manquant <br><br>";
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
    affichageCursus($list_cursus,$bulats,$tn10,$tn30,$tn09,$bd); ?>
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