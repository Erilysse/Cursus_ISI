<?php
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');

$list_cursus = [];
$list_UV_etu = [];

$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
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
        <?php
        if ($bd) {
            $request_etu = "SELECT * FROM etudiant";
            $answer_etu = $bd->query($request_etu);
            if (!empty($answer_etu)) {
                $etudiants = array();
                while ($etu = $answer_etu->fetch()) {
                    array_push($etudiants, [$etu['nom'],$etu['prenom'],$etu['admission'],$etu['filiere'],$etu['num_etudiant']]);
                }
            }
            foreach ($etudiants as $etudiant) {
                echo "".$etudiant[0]." ".$etudiant[1].", Etudiant admis en ".$etudiant[2].", actuellement en Filière ".$etudiant[3]."."
                . " Numéro Etudiant : ".$etudiant[4]."";
                echo "<br><br>";
                $request_cursus = "SELECT * FROM cursus WHERE id_etu=".$etudiant[4]."";
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
                foreach ($list_cursus as $key => $cursus) {
                    foreach($cursus as $key => $curs) {
                    echo "Cursus : ".$curs[0]."";
                    echo "<table cellpadding='5px' cellspacing='5px' rules='all'>";
                    affichageUV($curs[1]);
                    echo "</table><br>";
                }
                }
                }
            }
        }
        else {
            echo "Impossible de se connecter à la base de données";
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
        <br>
    </body>
</html>