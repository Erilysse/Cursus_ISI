<?php
include('BibliothequePHP.php');
include ('include/MYSQL/config.php');
include ('include/MYSQL/bibli_bdd.php');
$bd = connect_bdd($serveur, $utilisateur, $mot_de_passe);
if (!$bd) {
    echo "Impossible de connecter la base";
} else {
    ?>

    <html>
        <head>
            <title>Modifier un cursus</title>
            <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <script type="text/JavaScript" src="include\javascript\AjoutElement.js"></script>
            <div id="menu"><?php include('index.php'); ?></div>
            <table>
                <?php
                if (!isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    ?>
                    <form method="POST" id='ModifCursusEtu' name='ModifCursusEtu' action="Formulaire_Modification.php">
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='' />
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php
                } else if (isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    $etu = $_POST['numetu'];
                    $reqCursus = "SELECT nom FROM cursus WHERE id_etu=$etu";
                    ?>
                    <form method="POST" id='ModifCursusNb' name='ModifCursusNb' action="Formulaire_Modification.php">
                        <!-- <input type="hidden" name="numetu" value="<?php //echo $_POST['numetu'];  ?>" /> -->
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='<?php echo $_POST['numetu'] ?>' /></div>
                        <div id='Cursus'>Numéro cursus:<?php echo inputRadioReq($bd, $reqCursus, "cursus"); ?>
                            <input type='submit' value='Envoyer' /></div>
                    </form>

                    <?php
                }
                if (isset($_POST['numetu'], $_POST['cursus'])) {
                    $etu = $_POST['numetu'];
                    $cursus = $_POST['cursus'];

                    $req = "SELECT e.id FROM elt_de_formation e, cursus c WHERE c.nom='$cursus' AND c.id_etu=$etu AND c.id=e.id_cursus"; 
                    ?>
                    <form method="POST" id='ModifCursus' name='ModifCursus' action="Formulaire_Modification_Action.php">
                        <input type="hidden" name="cursus" value="<?php echo $cursus; ?>" />
                        <?php
                            foreach (execute_select_ss_view($bd, $req) as $temp) {
                                    foreach ($temp as $i) {

                                        $req = "SELECT * FROM elt_de_formation WHERE id=$i";
                                        $req_res = execute_select_ss_view($bd, $req); //Utilisation de numéros pour l'index du résultat de la requête
                                        ?>
                                        <div id='ListeUV'>            
                                            <div id='UV1'>
                                                <fieldset>
                                                    <input type="hidden" name="id[]" value="<?php echo $i; ?>" />
                                                    <div>N° du Semestre : <input type='text' name='numsem[]' size='10' maxlength='10' value='<?php echo $req_res[0]['sem_seq']; ?>' /></div>
                                                    <div>Label du Semestre :<input type='text' name='labelsem[]' size='10' maxlength='10' value='<?php echo $req_res[0]['sem_label']; ?>' /></div>
                                                    <div>Sigle :<input type='text' name='sigle[]' size='5' maxlength='4' value='<?php echo $req_res[0]['sigle']; ?>' /></div>
                                                    <div>Catégorie :<?php echo inputRadioDef($Categorie_Options, "categorie[]", $req_res[0]['categorie']); ?></div>
                                                    <div>Affectation :<?php echo inputRadioDef($Affectation_Options, "affectation[]", $req_res[0]['affectation']); ?></div>
                                                    <div>A-t-elle a été passé à l'UTT ?<?php echo inputRadioDef($Boolean_Options, "inUTT[]", $req_res[0]['inutt']); ?></div>
                                                    <div>Correspond-t-elle a votre profil ?
                                                        <?php echo inputRadioDef($Boolean_Options, "inProfil[]", $req_res[0]['inprofil']); ?></div>
                                                    <div>Nombre de crédit obtenu :<input type='number' name='numcredit[]' size='5' maxlength='4' value='<?php echo $req_res[0]['credit']; ?>' /></div>
                                                    <div>Résultat à l'UV :<?php echo inputRadioDef($Resultat_Options, "result[]", $req_res[0]['resultat']); ?></div>
                                                    <div>Action<?php echo inputRadioDef(array("Modification", "Suppression"), "action[]", "Modification"); ?></div>
                                                </fieldset>
                                            </div>
                                    <?php }
                                }
                                ?>
                        <div><button type='button' value="Ajouter une UV" onClick= "ajouterUV();">Ajouter une UV</button></div>
                        <div><a href="Visualisation_Cursus_All.php"><input type='submit' value='Envoyer' /></a></div>
                        <div><input type='reset' value='Réinitialiser' /></div>
                    <?php } ?>
                </form>       
            </table>
        </body>
    </html>
<?php } ?>