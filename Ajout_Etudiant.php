<html>
<head>
        <title>Ajouter un étudiant</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="menu"><?php include('index.php'); ?></div>
    <table>
        <form method="POST" id='FormAjoutEtudiant' name='FormAjoutEtudiant' action="Ajout_Etudiant_Action.php">
            <fieldset legend="A propos de vous">
                <div><h>Nom :</h> <input type='text' name='nom' size='10' maxlength='10' value='' /></div>
                <div><h>Prénom :</h> <input type='text' name='prenom' size='10' maxlength='10' value='' /></div>
                <div><h>Numéro d'étudiant :</h><input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
                <div><h>Admission :</h>
            <input type='radio' name='admission' value='TC'/><u>Tronc Commun</u>
            <input type='radio' name='admission' value='BR'/><u>Branche</u>
                <div><h>Filière:</h><select name='filiere'>
                    <option>MPL</option>
                    <option>MSI</option>
                    <option>MRI</option>
                    <option>LIB</option>
                    <option>?</option>
                </select></div>
            </fieldset>
            <div><a href="Ajout_Etudiant_Action.php"><input type='submit' value='Envoyer' /></a></div>
        <div><input type='reset' value='Réinitialiser' /></div
        </form>        
    </table>
</body>
</html>    