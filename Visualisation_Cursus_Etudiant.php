<!DOCTYPE html>
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
                <div><a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a></div>
                <div><input type='reset' value='Annuler' /></div
    </form>
    <table>
        <?php
        $id_etu = $_POST[numetu];
        if (isset($id_etu)) {
            echo
        }
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
// Récupération de la bibliothèque BDD et de la config pour se connecter à la bdd

include ('config.php');
include ('bibli_bdd.php');
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if ($bd) {
        echo "Impossible de se connecter à la base de données";
}
else {
    // Création du cursus d'après le numéro étu
    $reg_insert1="insert into cursus values (NULL,".$Etu_Numero.")";
    // Récupération de l'id du cursus afin de créer les éléments de formation qui le composent
    $id_cursus=mysql_insert_id();
    if (!(execute_requete($bd,$reg_insert1))) {
        echo "ERREUR: Le cursus n'a pas été enregistré";
    }
    else{
        echo "Le cursus a été enregistré";
    }
    // Boucle pour créer les éléments de formation dans la table
    for ($i = 0; $i <= count($UV_Sigle); $i++) {
        $reg_insert2="SELECT * from cursus"
        if (!(execute_requete($bd,$reg_insert2))) {
            echo "ERREUR: L'element de formation n'a été enregistré";
        }
        else{
            echo "L'element a été enregistré";
        }
    }
}
        ?>
    </table>
</body>
</html>