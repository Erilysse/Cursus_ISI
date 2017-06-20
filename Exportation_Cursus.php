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
            <div id="bandeau">Exporter un cursus</div>
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
                    $etu = $_POST['numetu'];
                    $reqCursus = "SELECT nom FROM cursus WHERE id_etu=$etu";
                ?>
                    <form method="POST" id='ExportCursusNb' name='ExportCursusNb' action="Exportation_Cursus.php">
                        <div id='NumEtu'>Numéro de l'étudiant: <input type='number' name='numetu' size='10' maxlength='10' value='<?php echo $_POST['numetu'] ?>' /></div>
                        <div id='Cursus'>Nom cursus:<?php echo inputRadioReq($bd, $reqCursus, "cursus"); ?>
                            <input type='submit' value='Envoyer' /></div>
                    </form>
                    <?php
                }
                if (isset($_POST['numetu'], $_POST['cursus'])) {
                    $etu=$_POST['numetu'];
                    $cursus = $_POST['cursus'];
                    $request="SELECT * from etudiant where num_etudiant = $etu";
                    $etudiants = execute_select_ss_view($bd,$request);
                    if (!($etudiants)) {
                        echo "ERREUR: L'étudiant n'a pas pu être récupéré";
                    }
                    else{
                        echo "On a récupéré les données de l'étudiant";
                        $carac = $etudiants[0];
                        // caractère afin de normaliser l'écriture
                        $retourLigne = chr(13);
                        //Ouverture fichier
                        $fichierCursus = fopen('cursus.csv', 'a+');
                        //Vide fichier
                        ftruncate($fichierCursus,0);
                        //Début écriture
                        fputs($fichierCursus , "ID;");
                        fputs($fichierCursus , $carac['num_etudiant']);
                        fputs($fichierCursus , ";;;;;;;;$retourLigne");
                        fputs($fichierCursus , "NO;");
                        fputs($fichierCursus , $carac['nom']);
                        fputs($fichierCursus , ";;;;;;;;$retourLigne");
                        fputs($fichierCursus , "PR;");
                        fputs($fichierCursus , $carac['prenom']);
                        fputs($fichierCursus , ";;;;;;;;$retourLigne");
                        fputs($fichierCursus , "AD;");
                        fputs($fichierCursus , $carac['admission']);
                        fputs($fichierCursus , ";;;;;;;;$retourLigne");
                        fputs($fichierCursus , "FI;");
                        fputs($fichierCursus , $carac['filiere']);
                        fputs($fichierCursus , ";;;;;;;;$retourLigne");
                        fputs($fichierCursus , "==;s_seq;s_label;sigle;categorie;affectation;utt;profil;credit;resultat$retourLigne");
                        //ELT DE FORMATION
                        $req = "SELECT id FROM cursus WHERE id_etu=".$carac['num_etudiant']." and nom='$cursus'";
                        $data_r = execute_select_ss_view($bd,$req);
                        $data_ro = $data_r[0];
                        $request2 = "SELECT * FROM elt_de_formation WHERE id_cursus=".$data_ro['id']."";
                        $data = execute_select_ss_view($bd,$request2);
                        print_r($data);
                            foreach ($data as $elt) {
                                fputs($fichierCursus, "EL;$elt[sem_seq];$elt[sem_label];$elt[sigle];$elt[categorie];"
                                    . "$elt[affectation];$elt[inutt];$elt[inprofil];$elt[credit];$elt[resultat]$retourLigne");
                                echo " ";
                            }
                        //Fin fichier
                        fputs($fichierCursus, "END;;;;;;;;;$retourLigne");
                        fputs($fichierCursus, "$retourLigne");
                        fclose($fichierCursus);
                        echo "<a href='cursus.csv' download='cursus' > Cliquer ici pour télécharger le fichier </a>";
                    }
                }
}
                        ?>
        </body>
 </html>