<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//R�cup�ration des donn�es renseign�es par l'utilisateur
$mail_d=mysql_escape_string($_POST['mail']);
$reponse = mysql_query('SELECT id_user, mail, activation, code_activation FROM utilisateur WHERE mail="'.$mail_d.'"') or die(mysql_error());
$log=0;

//on v�rifie que le compte existe bien
if(mysql_numrows($reponse)==0){
	//pas de membre avec ce pseudo
	$ok=FALSE;
	$_SESSION['mdpperdu']="Aucun compte ne correspond � l'adresse E-mail renseign�e ! ";
	$_SESSION['error']="error";
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		if($result['activation']==1)
		{
			$ok=FALSE;
			$_SESSION['code_activation']="Votre compte est d�j� activ�, vous pouvez vous connecter � l'aide de vos identifiants";
			$_SESSION['error']='ok';
		}else{
			//Envoi du mail
			$mail = $result['mail'];
			$code_activation = $result['code_activation'];
			include('mail_envoi_code_activation.php');
			
			//R�initialisation du mot de passe et modification de la table utilisateur
			$ok=TRUE;
			$_SESSION['code_activation']="Votre code d'activation a �t� envoy� sur votre boite mail";
			$_SESSION['error']='ok';
		}
	}
}
//on renvoi l'utilisateur sur la page de mot de passe perdu avec les infos
header('Location: ../../../index.php?page=envoi_code_activation');

?>