<?php
// on se connecte à notre base
$base = mysql_connect ('serveur', 'login', 'pass');
mysql_select_db ('ma_base', $base) ;
?>
<html>
<head>
<title>Modification de l'adresse d'un propriétaire</title>
</head>
<body>
<?php
// on teste si les variables du formulaire sont déclarées
if (isset($_POST['nouvelle_adresse']) && isset($_POST['proprio'])) {

	// lancement de la requête
	$sql = 'UPDATE liste_proprietaire SET adresse="'.$_POST['nouvelle_adresse'].'" WHERE nom="'.$_POST['proprio'].'"';

	// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

	// on ferme la connexion à la base
	mysql_close();

	// un petit message permettant de se rendre compte de la modification effectuée
	echo 'La nouvelle adresse de '.$_POST['proprio'].' est : '.$_POST['nouvelle_adresse'];
}
else {
	echo 'Les variables du formulaire ne sont pas déclarées';
}
?>
</body>
</html>