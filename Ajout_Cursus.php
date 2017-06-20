<?php
include('BibliothequePHP.php');
?>

<html>
<head>
        <title>Ajouter un cursus</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script type="text/JavaScript" src="include\javascript\AjoutElement.js"></script>
    <div id="bandeau">Ajouter un cursus</div>
    <div id="menu"><?php include('index.php'); ?></div>
        <h1>Ajouter manuellement votre cursus</h1>
        <?php if (!isset($_POST['compteur'])) {?>
        <form method="POST" name='FormNbCursus' action="Ajout_Cursus.php">
            Combien d'UV voulez-vous ajouter ? : <input type='number' name='compteur' size='10' maxlength='10' value='' />
             <a href="Ajout_Cursus.php"><input type='submit' value='Envoyer' />
                 <br><br>
        </form>
        <?php } else { $compteur = $_POST['compteur'] ?>
        <form method="POST" id='FormAjoutCursus' name='FormAjoutCursus' action="Ajout_Cursus_Action.php">
    <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='' /></div>    
    <div id='NomCursus'>Nom du Cursus: <input type='text' name='nomcursus' size='20' maxlength='20' value='' /></div>    
    <br>
    <div id='ListeUV'>
        <?php  for ($i=0;$i<$compteur;$i++) { ?>
    <div id=<?php echo 'UV'.$compteur;?>>
    <fieldset>
            <div>N° du Semestre : <input type='text' name='numsem[]' size='10' maxlength='10' value='' /></div>
            <div>Label du Semestre :<input type='text' name='labelsem[]' size='10' maxlength='10' value='' /></div>
            <div>Sigle :<input type='text' name='sigle[]' size='5' maxlength='4' value='' /></div>
            <div>Catégorie :<?php echo inputSelect($Categorie_Options,"categorie[]");?></div>
            <div>Affectation :<?php echo inputSelect($Affectation_Options,"affectation[]");?></div>
            <div>A-t-elle a été passé à l'UTT ?
                <?php echo inputSelect($Boolean_Options,"inUTT[]"); ?></div>
            <div>Correspond-t-elle a votre profil ?
                <?php echo inputSelect($Boolean_Options,"inProfil[]"); ?></div>
            <div>Nombre de crédit obtenu :<input type='number' name='numcredit[]' size='5' maxlength='4' value='' /></div>
            <div>Résultat à l'UV :<?php echo inputSelect($Resultat_Options,"result[]"); ?></div>
            <input type="hidden" id="compteur[]" name="compteur[]" value="<?php echo $i ?>">
            <?php echo $i ?>
    </fieldset>
    </div>
    <?php } ?>
    </div>
        <div><button type='button' value="Ajouter une UV" onClick= "ajouterUV();">Ajouter une UV</button>
            <input type="hidden" name="compteur2" value="<?php echo $compteur ?>">
            <a href="Ajout_Cursus_Action.php"><input type='submit' value='Envoyer' />
            </a> <input type='reset' value='Réinitialiser' /></div>
        </form>  
        <?php } ?>
___________________________________________________________
    <br><h1>Importer votre cursus</h1>
        <fieldset>
        <form method="POST" id='FormAjoutCursus' name='FormAjoutCursus' action="Importation_Cursus.php">
        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' id="numetu" size='10' maxlength='10' value='' /></div>    
        <div id='NomCursus'>Nom du Cursus: <input type='text' name='nomcursus' id="nomcursus" size='20' maxlength='20' value='' /></div>
        <br>
             <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
             <div id='Cursus'> Cursus (format csv) : <input type="file" name="cursus" id="cursus" /></div>
        </fieldset>
        <div><a href="Importation_Cursus.php"><input type='submit' value='Envoyer' /></a></div>
        </form>
    </body>
</html>