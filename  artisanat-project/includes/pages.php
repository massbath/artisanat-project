<?php
	if (empty ($_GET['page']))	{
	include ("modules/default/default.php");
	}
	
	/* Lien module contact */
	
	elseif($_GET['page'] == 'contact') {
	include("modules/contact/contact.php");
	}
	elseif($_GET['page'] == 'deconnexion') {
	include("modules/membre/public/deconnexion.php");
	}
	elseif($_GET['page'] == 'inscription') {
	include("modules/membre/public/inscription.php");
	}
	
	/* Fin lien module contact */