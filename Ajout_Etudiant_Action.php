<html>
<head>
        <title>Ajouter un étudiant</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="menu"><?php include('index.php'); ?></div>
<?php
// Ajout des fichiers pour la connexion à la bdd
include('include\MYSQL\config.php');
include('include\MYSQL\bibli_bdd.php');

// Récupération des éléments du formulaire
if (isset($_POST)) {
    $Etu_Nom= $_POST['nom']; 
    $Etu_Prenom = $_POST['prenom'];
    $etu = $_POST['numetu'];
    $Etu_Admission = $_POST['admission'];
    $Etu_Filiere = $_POST['filiere'];
    if (!preg_match('#a-Z#', $_POST['nom'] && $_POST['prenom'])) {
        echo 'Veuillez écrire votre nom et prénom avec des caractères et non des chiffres.';
    }
    else {
        // Connexion et test de connexion
        $bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
        if ($bd) {
            // Ajout des éléments du formulaire dans la base de données étudiant avec test erreur
            $request="insert into `etudiant`(`num_etudiant`, `nom`, `prenom`, `admission`, `filiere`) values (".$etu.",'".$Etu_Nom."','".$Etu_Prenom."','".$Etu_Admission."','".$Etu_Filiere."')";
            if (!(execute_requete($bd,$request))) {
                echo "ERREUR: L'étudiant n'a pas pu être enregistré";
            }
            else{
                echo "L'étudiant a été enregistré";
            }
        }
        else {
            echo "Impossible de se connecter à la Base de Données.";
        }
    }
}
?>
</body>
</html>
