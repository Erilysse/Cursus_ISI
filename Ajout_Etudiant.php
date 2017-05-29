<!DOCTYPE html>
<html>
<head>
        <title>Ajouter un étudiant</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <table>
        <form method="POST" id='FormAjoutEtudiant' name='FormAjoutEtudiant' action="Formulaire_Ajout_Action.php">
            <fieldset legend="A propos de vous">
                <div><h>Nom :</h> <input type='text' name='nom' size='10' maxlength='10' value='' /></div>
                <div><h>Prénom :</h> <input type='text' name='prenom' size='10' maxlength='10' value='' /></div>
                <div><h>Numéro d'étudiant :</h><input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
                <div><h>Admission :</h>
            <input type="radio" name='admission' value='TC'/><u>Tronc Commun</u>
            <input type="radio" name='admission' value='BR'/><u>Branche</u>
                <div><h>Filière:</h><select name='filiere'>
                    <option>MPL</option>
                    <option>MSI</option>
                    <option>MRI</option>
                    <option>LIB</option>
                    <option>?</option>
                </select></div>
            </fieldset>
        </form>
    </table>
</body>
</html>
    