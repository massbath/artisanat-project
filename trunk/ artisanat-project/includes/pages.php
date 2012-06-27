<?php
	if (empty ($_GET['page']))	{
	include ("modules/default/default.php");
	}
	
	/* Lien module contact */
	elseif($_GET['page'] == 'contact') {
	include("modules/contact/contact.php");
	}
	/* Lien déconnexion */
	elseif($_GET['page'] == 'deconnexion') {
	include("modules/membre/public/deconnexion.php");
	}
	/* Lien page d'inscription */
	elseif($_GET['page'] == 'inscription') {
	include("modules/membre/public/inscription.php");
	}
	/* Lien page de liste de news / articles */
	elseif($_GET['page'] == 'news') {
		if(empty ($_GET['article'])){
			include("modules/news/public/news.php");
		}else{
			include("modules/news/public/news-detail.php");
		}
	}
	/* Lien page d'activation de compte */
	elseif($_GET['page'] == 'activation') {
	include("modules/membre/public/activation.php");
	}