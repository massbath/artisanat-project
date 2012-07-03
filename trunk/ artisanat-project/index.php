<?php session_start();
include ('includes/visite.php');
include ('includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link);
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
<link rel="shortcut icon" type="image/ico" href="theme/favicon/favicon.ico" />
<link rel="stylesheet" href="theme/css/style.css" type="text/css" media="screen" />

<link type="text/css" rel="stylesheet" href="theme/redmond/jquery-ui-1.8.21.custom.css" media="screen" />
<link type="text/css" rel="stylesheet" href="theme/redmond/jquery-ui-1.8.21.custom.css" media="screen" />
<script type="text/javascript" src="includes/javascript/jquery/jquery-1.7.2.js" language="JavaScript"></script>
<script type="text/javascript" src="includes/javascript/jquery/jquery-ui-1.8.21.custom.js" language="JavaScript"></script>
<script type="text/javascript" src="includes/javascript/jquery/ui.datepicker.js"></script>
<script type="text/javascript" src="includes/javascript/jquery/ui.datepicker-fr.js"></script>
</head>

<body>

<div id="contenu_site">
	<div id="main">
		<div id="sheet">
			<!-- HEADER DEBUT -->
			<div id="header">				
				<div class="header-center">
					<div class="header-png"></div>
					<div class="header-jpeg"></div>
				</div>
				<div class="logo-image"></div>
				<div class="logo">
					<h1 id="name-text" class="logo-name"><a href="./index.php">NEEDS</a></h1>
					<h2 id="slogan-text" class="logo-text">Nos Envies Et Demandes de Services</h2>
				</div>
				<div class='connexion'><?php include('modules/membre/public/connexion_haut.php'); ?></div>	
			</div>
			<!-- FIN HEADER -->

			<!-- MENU DEBUT -->
			<?php include('modules/menu/public/menu.php'); ?>
			<!-- MENU FIN -->

			<!-- DEBUT CORPS -->
			<div id="corps">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="bloc-central">
							<!-- APPEL DE LA PAGE DEMANDEE PAR L'UTILISATEUR -->
							<?php include ('includes/pages.php'); ?>
						</td>
						<td class="bloc-droite">
							<div class="bloc-droite-contenu">
							<!-- BLOC DROIT SUR TOUTE LA PARTIE DROITE DU SITE -->
							<?php include ('includes/bloc-droite.php'); ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<!-- FIN CORPS -->
			
			<!-- DEBUT FOOTER -->
			<div class="footer"> 
				Copyright © 2012, NEEDS. All Rights Reserved.
			</div>
			<!-- FIN FOOTER -->
		</div>
	</div>
	<div id="footer-space"></div>
</div>

</body>
</html>
