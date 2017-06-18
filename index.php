<?php
//Affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
    <head>
        <title>Site de Projet</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="bandeau">Accueil</div>
        <div><a href="Visualisation_Cursus_All.php">Voir les cursus</a></div>
        <br>
        <div><a href="Visualisation_Etudiant.php">Voir les étudiants</a></div>
        <br>
        <div><a href="Ajout_Etudiant.php">Ajouter un étudiant</a></div>
        <br>
        <div><a href="Ajout_Cursus.php">Ajouter un cursus</a></div>
        <br>
        <div><a href="Formulaire_Modification.php">Modifier un cursus</a></div>
        <br>
        <div><a href="Supprimer_Cursus.php">Supprimer un cursus</a></div>
        <br>
        <div><a href="Dupliquer_Cursus.php">Dupliquer un cursus</a></div>
        <br>
    </body>
</html>