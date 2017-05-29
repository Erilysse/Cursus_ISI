<!DOCTYPE html>
<html>
<head>
        <title>Ajouter un cursus</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form method="POST" id='FormAjoutCursus1' name='FormAjoutCursus1' action="Ajout_Cursus_2.php">
    <table>
            <fieldset legend="A propos de votre cursus">
                <div>Numéro de l'étudiant :<input type='number' name='numetu' size='10' maxlength='10' value='' /></div>
                <div>Combien d'UV voulez-vous ajouter à votre cursus ? :<input type='number' name='numUV' size='10' maxlength='10' value='' /></div>
            </fieldset>
    </table>
                <div><a href="Ajout_Cursus_2.php"><input type='submit' value='Envoyer' /></a></div>
                <div><input type='reset' value='Annuler' /></div
    </form>
</body>
</html>