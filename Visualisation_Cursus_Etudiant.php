<?php
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');
$list_UV = [];
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);

if ($bd) {
     $etu_numero = $_POST['numetu'];
    $reg_insert1 = "SELECT id FROM cursus WHERE id_etu = $etu_numero";
    if (isset($etu_numero)) {
        $answer = $bd->query($request1);
        $id_cursus = $answer->fetch();
        $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus = $id_cursus";
        $answer2 = $bd->query($request2);
        while ($data = $answer2->fetch()) {
            array_push($list_UV, [$data['sem_seq'],$data['sem_label'],$data['sigle'],$data['categorie'],$data['inutt'],$data['inprofil'],$data['credit'],$data['resultat']]) ;
        }
    }
}
else {
           echo "Impossible de se connecter à la base de données";
}

function affichageUV($list_UV) {
    foreach ($list_UV as $key => $UV) {
        echo "<tr>";
        foreach ($UV as $value) {
            echo "<th>" . $value . "</th>";
        }
        echo "</tr>";
    }
}
?>
<html>
<head>
        <title>Visualiser un cursus</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Rechercher :</h1>
    <form method="POST" id='VoirCursus' name='VoirCursus' action="Visualisation_Cursus.php">
                <div>Numéro de l'étudiant :<input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
                <div>
                    <a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a>
                    <input type='reset' value='Annuler' />
                </div>
    </form>
     <table cellpadding="10px" cellspacing="10px" rules="all" style="border:solid 1px black; border-collapse:collapse; background-color:lightgrey; text-align:center;">
            <tr>
                <th>Semestre</th>
                <th>Libellé du Semestre</th>
                <th>Catégorie</th>
                <th>Sigle de l'UV</th>
                <th>Faite à l'UTT</th>
                <th>Dans le profil</th>
                <th>Résultat</th>
                <th>Crédits Obtenus</th>
            </tr>
            <?php affichageUV($list_UV);?>
    </table>
    <div>
         <a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a>
        <button type='button' value="Dupliquer le Cursus" onClick= "dupliquerCursus();">Dupliquer</button>
        <button type='button' value="Supprimer le Cursus" onClick= "supprimerCursus();">Supprimer</button>
        <button type='button' value="Exporter le Cursus" onClick= "exporterCursus();">Exporter</button>
    </div>
</body>
</html>