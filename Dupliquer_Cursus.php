<?php
include('BibliothequePHP.php');
include ('include/MYSQL/config.php');
include ('include/MYSQL/bibli_bdd.php');
$bd = connect_bdd($serveur, $utilisateur, $mot_de_passe);
?>
    <html>
        <head>
            <title>Dupliquer un cursus</title>
            <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div id="bandeau">Dupliquer un cursus</div>
            <div id="menu"><?php include('index.php'); ?></div>
            <table>
                <?php
                if (!isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    ?>
                    <form method="POST" id='DuplCursusEtu' name='DuplCursusEtu' action="Dupliquer_Cursus.php">
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='' />
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php 
                } else if (isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    $etu = $_POST['numetu'];
                    $reqCursus = "SELECT nom FROM cursus WHERE id_etu=$etu";
                ?>
                    <form method="POST" id='DuplCursusNb' name='DuplCursusNb' action="Dupliquer_Cursus.php">
                        <!--<input type="hidden" name="numetu" value="<?php //echo $_POST['numetu'];  ?>" /> -->
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='<?php echo $_POST['numetu'] ?>' /></div>
                        <div id='Cursus'>Numéro cursus:<?php echo inputRadioReq($bd, $reqCursus, "cursus"); ?>
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php
                }
                if (isset($_POST['numetu'], $_POST['cursus'])) {
                    if ($bd) {
                        $etu = $_POST['numetu'];
                        $nom_cursus = $_POST['cursus'];
                        $request_id_cursus= "SELECT id FROM `cursus` WHERE nom='$nom_cursus' and id_etu=$etu";
                        $answer = $bd->query($request_id_cursus);
                        $data = $answer->fetch();
                        $request_dupl_cursus="INSERT INTO `cursus`(`id`, `id_etu`, `nom`) SELECT NULL, `id_etu`, `nom`"
                                . " FROM `cursus` WHERE nom='$nom_cursus' and id_etu=$etu";
                        if (!(execute_requete($bd,$request_dupl_cursus))) {
                            echo "ERREUR: Le cursus n'a pas été duppliqué";
                        }
                        else {
                            echo "Le cursus a été dupliqué <br><br>";
                        }
                         $id_new_cursus=table_max_id($bd,'cursus','id');    
                        $request_dupl_elt="INSERT INTO `elt_de_formation` (`id`, `id_cursus`, `sem_seq`, `sem_label`, `sigle`, `categorie`, `affectation`, `inutt`, `inprofil`, `credit`, `resultat`)"
                    . " SELECT NULL, $id_new_cursus, `sem_seq`, `sem_label`, `sigle`, `categorie`, `affectation`, `inutt`, `inprofil`, `credit`, `resultat`"
                                . "FROM `elt_de_formation` WHERE id_cursus = ".$data['id']."";
                        if (!(execute_requete($bd,$request_dupl_elt))) {
                            echo "ERREUR: Les éléments de formations n'ont pas été dupliqué";
                        }
                        else {
                            echo "Les éléments de formations ont été dupliqués";
                        }
                    }
                }
                    ?>
                </form>       
            </table>
        </body>
    </html>

