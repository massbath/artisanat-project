<?php
	if (empty ($_GET['page']))	{
	include ("modules/default/default.php");
	}
	
	/* Lien module contact */
	
	elseif($_GET['page'] == 'contact') {
	include("modules/contact/contact.php");
	}
	
	/* Fin lien module contact */