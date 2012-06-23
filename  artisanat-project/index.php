<?php session_start();
	include ('includes/visite.php');
	include ('includes/conf_bdd.php');
	$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
	mysql_select_db($nom_database,$link);
?>

<?php
	require_once("validation.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta http-equiv="Content-Language" content="fr-fr" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Artisanat</title>
		<meta name="description" content="Site @rtisanat" /> 
		<meta name="keywords" content="artisant,artisanat"/>
		<meta name="reply-to" content=""/> 
		<meta name="author" content=""/> 
		<link rel="shortcut icon" type="image/png" href="theme/favicon/favicon.png" />
		<link rel="stylesheet" href="theme/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/general.css" type="text/css" media="screen" />
	</head>

	<body>
		<div id="contenu_site">
			<div id="header">
				<div class='gauche'>LOGO</div>
				<?php include ('theme/header/header.php'); ?>
				<div class='droite'>
					<?php include('modules/membre/public/connexion_haut.php'); ?>
				</div>	
			</div>

			<div id="menu">
				<a href="index.php" title="Retour à l'accueil">
					<div class="accueil">Accueil</div>
				</a>
				<a href="index.php?page=contact" title="Contactez nous">
					<div class="contact">Contact</div>
				</a>
			</div>

			<div>
				<?php include ('includes/pages.php'); ?>
			</div>
			<div id="footer"> FOOTER </div>
		</div>
		<script type="text/javascript" src="jquery-1.7.2.js"></script>
		<script type="text/javascript" src="validation.js"></script>
	</body>
</html>
