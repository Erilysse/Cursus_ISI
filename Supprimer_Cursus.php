<?php
include('BibliothequePHP.php');
include ('include/MYSQL/config.php');
include ('include/MYSQL/bibli_bdd.php');
$bd = connect_bdd($serveur, $utilisateur, $mot_de_passe);
?>
    <html>
        <head>
            <title>Modifier un cursus</title>
            <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div id="menu"><?php include('index.php'); ?></div>
            <table>
                <?php
                if (!isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    ?>
                    <form method="POST" id='SupprCursusEtu' name='SupprCursusEtu' action="Supprimer_Cursus.php">
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='' />
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php 
                } else if (isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    $etu = $_POST['numetu'];
                    $reqCursus = "SELECT nom FROM cursus WHERE id_etu=$etu";
                ?>
                    <form method="POST" id='SupprCursusNb' name='SupprCursusNb' action="Supprimer_Cursus.php">
                        <!--<input type="hidden" name="numetu" value="<?php //echo $_POST['numetu'];  ?>" /> -->
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='<?php echo $_POST['numetu'] ?>' /></div>
                        <div id='Cursus'>Numéro cursus:<?php echo inputRadioReq($bd, $reqCursus, "cursus"); ?>
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php
                }
                if (isset($_POST['numetu'], $_POST['cursus'])) {
                    if ($bd) {
                        $id_cursus = $_POST['cursus'];
                        $request_suppr_elt="DELETE * FROM `elt_de_formation` WHERE id_cursus = ".$id_cursus."";
                        if (!(execute_requete($bd,$request_suppr_elt))) {
                            echo "ERREUR: Les éléments de formations n'ont pas été supprimé";
                        }
                        $request_suppr_cursus="DELETE * FROM `cursus` WHERE id = ".$id_cursus."";
                        if (!(execute_requete($bd,$request_suppr_cursus))) {
                            echo "ERREUR: Le cursus n'a pas été supprimé";
                        }     
                    }
                }
                    ?>
                </form>       
            </table>
        </body>
    </html>