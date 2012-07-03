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
	/* Lien page de connexion */
	elseif($_GET['page'] == 'connexion') {
	include("modules/membre/public/connexion.php");
	}
	/* Lien page de réinitilisation mot de passe */
	elseif($_GET['page'] == 'mdpperdu') {
	include("modules/membre/public/mdpperdu.php");
	}
	/* Lien page de renvoi du code d'activation */
	elseif($_GET['page'] == 'envoi_code_activation') {
	include("modules/membre/public/envoi_code_activation.php");
	}
	/* Lien page de renvoi du code d'activation */
	elseif($_GET['page'] == 'modif_pass') {
	include("modules/membre/public/modif_pass.php");
	}
	/* Lien page de création d'entreprise */
	elseif($_GET['page'] == 'modification_profil') {
	include("modules/membre/public/modification_profil.php");
	}
	/* Lien page de modification de profil */
	elseif($_GET['page'] == 'creation_entreprise') {
	include("modules/membre/public/creation_entreprise.php");
	}
	/* Lien page de création d'entreprise */
	elseif($_GET['page'] == 'modification_entreprise') {
	include("modules/membre/public/modification_entreprise.php");
	}
	/* Lien page de consultation de profil personnel */
	elseif($_GET['page'] == 'profil') {
	include("modules/membre/public/affichage_profil.php");
	}
	/* Lien page de consultation de profil entreprise */
	elseif($_GET['page'] == 'profil_pro') {
	include("modules/membre/public/affichage_profil_pro.php");
	}
	/* Lien page de consultation de profil entreprise */
	elseif($_GET['page'] == 'depos') {
	include("modules/annonce/public/depose.php");
	}