<?php
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');
$etudiant = [];
$list_cursus = [];
$list_UV_etu = [];
$list_all = [];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);

if ($bd) {
    $request_etu = "SELECT * FROM etudiant";
    $answer_etu = $bd->query($request_etu);
    if (!empty($answer_etu)) {
        while ($etu = $answer_etu->fetch()) {
            array_push($etudiant, [$etu['nom'],$etu['prenom'],$etu['admission'],$etu['filiere']]);
            $request_cursus = "SELECT * FROM cursus WHERE id_etu=".$etu['num_etudiant']."";
            $answer_cursus = $bd->query($request_cursus);
            if (!empty($answer_cursus)) {
                while ($cursus_etu = $answer_cursus->fetch()) {
                    $request_UV_etu = "SELECT * FROM elt_de_formation WHERE id_cursus = ".$cursus_etu['id']."";
                    $answer_UV = $bd->query($request_UV_etu);
                    if (!empty($answer_UV)) {
                        while ($data = $answer_UV->fetch()) {
                            array_push($list_UV_etu, [$data['sem_seq'],$data['sem_label'],$data['categorie'],$data['sigle'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
                        }
                    array_push($list_cursus, [[$cursus_etu['nom'],$list_UV_etu]]);
                    }
                }
            array_push($list_all,[$etudiant,$list_cursus]);
            }
        }
    }
else {
     echo "Impossible de se connecter à la base de données";
}
}

function affichage($list_all) {
    foreach ($list_all as $value) {
        affichageEtu($value[0], $value[1]);
    }
}

function affichageEtu($etudiant, $list_cursus) {
    foreach ($etudiant as $key => $etu) {
        echo "".$etu[0]." ".$etu[1].", Etudiant admis en ".$etu[2].", actuellement en Filière ".$etu[3].".<br>";
        affichageCursus($list_cursus);
    }   
}
function affichageCursus ($list_cursus) {
            foreach($list_cursus as $key => $cursus) {
                foreach($cursus as $key => $value) {
                    echo "Cursus ".$value[0]."";
                    echo "<table cellpadding='5px' cellspacing='5px' rules='all' style='border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;'>";
                    affichageUV($value[1]);
                    echo "</table><br>";
                }
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
        <h1>Cursus de tout les étudiants</h1>
        <?php affichage($list_all); ?>
        <br>
    </body>
</html>