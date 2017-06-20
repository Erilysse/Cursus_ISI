<html>
<head>
        <title>Ajouter un étudiant</title>
        <link rel='stylesheet' type='text/css' href='include/CSS/Original.css' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="menu"><?php include('index.php'); ?></div>
    <?php
    require_once'BibliothequePHP.php';
    $IDetudiant=$_POST['numetu'];
    $nomCursus=$_POST['nomcursus'];
//On vérifie qu'un fichier a été envoyé
	if ($_FILES['cursus']['error'] > 0) { 
            $erreur = "Erreur durant le transfert de fichier";
        }
//On vérifie l'extension du fichier
        else {
	$extensions_valides = array('csv');
	$extension_upload = strtolower(  substr(  strrchr($_FILES['cursus']['name'], '.')  ,1)  );
	if ( in_array($extension_upload,$extensions_valides)) {
//On crée le tableau qui va collecter toutes les lignes
	$import=array();
//On récupère tout le contenu du fichier
	$contenu=file_get_contents($_FILES['cursus']['tmp_name']);
//On découpe le contenu en lignes
	$import=explode(chr(13),rtrim($contenu));
//On redécoupe le contenu des lignes avec les points virgule pour tout récupérer valeur par valeur
	foreach ($import as $ligne){
		$tableau_valeurs[]=explode(";",$ligne);
	}
	debug($import);
//On ajoute l'étudiant à la BDD si il n'est pas dedans
    $request_inorout = "SELECT * from etudiant where num_etudiant =".$tableau_valeurs[2][1]."";
    if (!execute_requete($bd,$request_inorout)) {
        $request_etu="insert into `etudiant`(`num_etudiant`, `nom`, `prenom`, `admission`, `filiere`) values (".$tableau_valeurs[2][1].
                ",'".$tableau_valeurs[0][1].",'".$tableau_valeurs[1][1]."','".$tableau_valeurs[3][1]."','".$tableau_valeurs[4][1]."')";
        if (!(execute_requete($bd,$request_etu))) {
            echo "ERREUR: L'étudiant n'a pas pu être enregistré";
        }
        else{
            echo "L'étudiant a été enregistré";
        }
    }

//On récupere l'ID du dernier cursus soumis à la BDD
	$request_idcursus="SELECT MAX(id) FROM `cursus`";
	$resultat=requete($bd,$request_idcursus); 
	$ligne = mysqli_fetch_array($resultat,MYSQLI_ASSOC);
	$IDcursus = $ligne['MAX(id)'];
//On créer le cursus
        $request_cursus="INSERT INTO `cursus`(`id`, `id_etu`, `nom`) values (NULL,".$etu.",'".$nom_cursus."')";
        if (!(execute_requete($bd,$request_cursus))) {
            echo "ERREUR: Le cursus n'a pas pu être enregistré";
        }
        else{
            echo "Le cursus a été enregistré";
        }
//On insère les informations concernant chacun des éléments de formation dans la BDD des elements de formation si il n'existe pas, puis on lie le cursus sélectionné à l'élément de formation avec la table cursus_element
	for ($i = 6; $i <= (count($tableau_valeurs)-2); $i++){
	 $request_elt_de_formation="INSERT INTO `elt_de_formation`(`id`, `id_cursus`, `sem_seq`, `sem_label`, `sigle`, `categorie`, `affectation`, `inutt`, `inprofil`, `credit`, `resultat`)"
                    . " values (NULL,".$IDcursus.",".$tableau_valeurs[$i][1].",'".$tableau_valeurs[$i][2]."','"
                .$tableau_valeurs[$i][3]."','".$tableau_valeurs[$i][4]."','".$tableau_valeurs[$i][5]."','".$tableau_valeurs[$i][6]."','".$tableau_valeurs[$i][7]."',"
                .$tableau_valeurs[$i][8].",'".$tableau_valeurs[$i][9]."')";
         if (!(execute_requete($bd,$request_elt_de_formation))) {
            echo "ERREUR: Les éléments de formations n'ont pas pu être enregistré";
        }
        else{
            echo "Les éléments de formation ont été enregistré";
        }		
        }
        }
        }
?>
</body>
</html>