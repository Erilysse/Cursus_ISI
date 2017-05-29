<?php
$Etu_Numero = $_POST['numetu'];
$UV_Numero = $_POST['numUV'];
?>

<html>
<head>
        <title>Ajouter un cursus</title>
        <link type='text/CSS' href='../include/CSS/style.js'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <form method="POST" id='FormAjoutCursus2' name='FormAjoutCursus' action="Formulaire_Ajout_Action.php">
            <div>N° du Semestre : <input type='text' name='numsem' size='10' maxlength='10' value='' /></div>
                    <div>Label du Semestre :<input type='text' name='labelsem' size='10' maxlength='10' value='' /></div>
                    <div>Sigle :<input type='text' name='sigle' size='5' maxlength='4' value='' /></div>
                    <div>Catégorie :<select name='categorie'>
                    <option>CS</option>
                    <option>TM</option>
                    <option>ME</option>
                    <option>EC</option>
                    <option>HT</option>
                    <option>NPML</option>
                    <option>ST</option>
                    </select></div>
                    <div>Affectation :
                        <input type="radio" name='affectation' value='TC'/>Tronc Commun
                        <input type="radio" name='affectation' value='TCBR'/>Tronc Commun de Branche
                        <input type="radio" name='affectation' value='FCBR'/>Branche
                    <div>A-t-elle a été passé à l'UTT ?
                        <input type="radio" name='inUTT' value='true'/>Oui
                        <input type="radio" name='inUTT' value='false'/>Non
                    <div>Correspond-t-elle a votre profil ?
                        <input type="radio" name='inProfil' value='true'/><u>Oui</u>
                        <input type="radio" name='inProfil' value='false'/><u>Non</u>
                    <div>Nombre de crédit obtenu :<input type='number' name='numcredit' size='5' maxlength='4' value='' /></div>
                    <div>Résultat à l'UV :><select name='result'>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                    <option>FX</option>
                    <option>F</option>
                    <option>EQ</option>
                    <option>ADM</option>
                    <option>ABS</option>
                    </select></div>
                    <div><button type='button' value="Ajouter une UV" id="AjoutElement"></button></div>
        </fieldset>
            
        <div><a href="Visualisation_Cursus.php"><input type='submit' value='Envoyer' /></a></div>
        <div><input type='reset' value='Annuler' /></div
        </form>"*/
            }
            ?>         
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script type="text/JavaScript" src="include/javascript/AjoutElement.js"></script>
        </table>
    </body>
</html>
