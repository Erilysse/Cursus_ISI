<?php
$Etu_Numero = $_POST['numetu'];
$UV_Numero = $_POST['numUV'];

include('BibliothequePHP.php');
?>

<html>
<head>
        <title>Ajouter un cursus</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script type="text/JavaScript" src="include/javascript/AjoutElement.js"></script>
    <table>
        <form method="POST" id='FormAjoutCursus2' name='FormAjoutCursus2' action="Ajout_Cursus_2_Action.php">
    <fieldset id='UV'>
            <div>N° du Semestre : <input type='text' name='numsem' size='10' maxlength='10' value='' /></div>
            <div>Label du Semestre :<input type='text' name='labelsem' size='10' maxlength='10' value='' /></div>
            <div>Sigle :<input type='text' name='sigle' size='5' maxlength='4' value='' /></div>
            <div>Catégorie :<?php inputSelect($Categorie_Options,"categorie");?></div>
            <div>Affectation :<?php inputRadio($Affectations_Options,"affectation");?></div>
            <div>A-t-elle a été passé à l'UTT ?
                <?php inputRadio($Boolean_Options,"inUTT"); ?></div>
            <div>Correspond-t-elle a votre profil ?
                <?php inputRadio($Boolean_Options,"inProfil"); ?></div>
            <div>Nombre de crédit obtenu :<input type='number' name='numcredit' size='5' maxlength='4' value='' /></div>
            <div>Résultat à l'UV :<?php inputSelect($Resultats_Options,"result"); ?></div>
    </fieldset>
        <div><button type='button' value="Ajouter une UV" onClick= "ajouterElement(UV);"></button></div>
        <br>   
        <div><a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a></div>
        <div><input type='reset' value='Réinitialiser' /></div
        </form>        
    </table>
</body>
</html>
