<?php
include('\include\MYSQL\config.php');
include('\include\MYSQL\bibli_bdd.php');
include ('BibliothequePHP.php');
// Connexion et test de connexion
$bd  = connect_bdd($serveur,$utilisateur,$mot_de_passe);
if (!$bd) {
        echo "Impossible de se connecter";
}
else {
?>
 <html>
        <head>
            <title>Exporter un cursus</title>
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
                    <form method="POST" id='ExportCursusEtu' name='ExportCursusEtu' action="Exportation_Cursus.php">
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='' />
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php 
                } else if (isset($_POST['numetu']) && !isset($_POST['cursus'])) {
                    $Etu_Numero = $_POST['numetu'];
                    $reqCursus = "SELECT nom FROM cursus WHERE id_etu=$Etu_Numero";
                ?>
                    <form method="POST" id='ExportCursusNb' name='ExportCursusNb' action="Exportation_Cursus.php">
                        <input type="hidden" name="numetu" value="<?php echo $_POST['numetu'];  ?>"
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='<?php echo $_POST['numetu'] ?>' /></div>
                        <div id='Cursus'>Numéro cursus:<?php echo inputRadioReq($bd, $reqCursus, "cursus"); ?>
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php
                }
                if (isset($_POST['numetu'], $_POST['cursus'])) {
                    $Etu_Numero=$_POST['numetu'];
                    $cursus = $_POST['cursus'];
                    $etudiant="SELECT * from etudiant where num_etudiant = $Etu_Numero";
                    if (!(execute_requete($bd,$etudiant))) {
                        echo "ERREUR: L'étudiant n'a pas pu être récupéré";
                    }
                    else{
                        echo "On a récupéré les données de l'étudiant";
                        $etudiant_answer = $bd->query($etudiant);
                        if (!empty($etudiant_answer)) {
                            while ($data = $etudiant_answer->fetch()) {
                                array_push($etudiant_attributes, [$data["num_etudiant"], $data["nom"], $data["prenom"], $data["admission"], $data["filiere"]]);
                            }
                $requestcursus = "SELECT id FROM cursus WHERE id_etu=$Etu_Numero and nom=$cursus";
                $id = execute_select_ss_view($bd,$requestcursus);
                //On affecte le caractère "retour à la ligne" pour avoir la même syntaxe que le fichier moodle
                $retourLigne = chr(13);
                //Ouverture du fichier
                $fichierCursus = fopen('cursus.csv', 'a+');
                //On vide le fichier cursus.csv
                ftruncate($fichierCursus,0);
                //Inscription des premières lignes
                fputs($fichierCursus , "ID;");
                fputs($fichierCursus , $etudiant_attributes[0]);
                fputs($fichierCursus , ";;;;;;;;$retourLigne");
                fputs($fichierCursus , "NO;");
                fputs($fichierCursus , $etudiant_attributes[1]);
                fputs($fichierCursus , ";;;;;;;;$retourLigne");
                fputs($fichierCursus , "PR;");
                fputs($fichierCursus , $etudiant_attributes[2]);
                fputs($fichierCursus , ";;;;;;;;$retourLigne");
                fputs($fichierCursus , "AD;");
                fputs($fichierCursus , $etudiant_attributes[3]);
                fputs($fichierCursus , ";;;;;;;;$retourLigne");
                fputs($fichierCursus , "FI;");
                fputs($fichierCursus , $etudiant_attributes[4]);
                fputs($fichierCursus , ";;;;;;;;$retourLigne");
                fputs($fichierCursus , "==;s_seq;s_label;sigle;categorie;affectation;utt;profil;credit;resultat$retourLigne");
                //On inscrit tous les éléments de formations
                               $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus=$id";
                $answer2 = $bd->query($request2);
                if (!empty($answer2)) {
                    while ($data = $answer2->fetch()) {
                        fputs($fichierCursus, "EL;$data[sem_seq];$data[sem_seq];$data[sigle];$data[categorie];"
                            . "$data[affectation];$data[inutt];$data[inprofil];$data[credit];$data[resultat]$retourLigne");
                        echo " ";
                    }
                }
                //Fin du fichier csv
                fputs($fichierCursus, "END;;;;;;;;;$retourLigne");
                fputs($fichierCursus, "$retourLigne");
                fputs($fichierCursus, "$retourLigne");
                fputs($fichierCursus, "$retourLigne");
                fclose($fichierCursus);
                echo"<a href='cursus.csv' dowload='cursus' > Cliquer ici pour télécharger le fichier </a>";
                }
                                        }
                    }
}
                ?>
            </table>
        </body>
 </html>