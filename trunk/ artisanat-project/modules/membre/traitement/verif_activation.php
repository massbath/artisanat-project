<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//Récupération des données renseignées par l'utilisateur
$code_activation = mysql_real_escape_string(htmlspecialchars($_POST['code_activation']));
$reponse = mysql_query('SELECT code_activation, activation FROM utilisateur WHERE code_activation="'.$code_activation.'"') or die(mysql_error());

//on vérifie que le code d'activation existe bien
if(mysql_numrows($reponse)==0){
	//le code n'existe pas
	$ok=FALSE;
	$_SESSION['activation']="Ce code d'activation n'existe pas. Vérifiez que vous avez bien saisi le code qui vous a été envoyé par mail.";
	$_SESSION['error']='error';
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		//si le code d'activation existe, on vérifie que le compte n'est pas déjà activé
		if($result['activation']!=1)
		{
			$ok=TRUE;
			$_SESSION['activation']='Votre compte est maintenant activé, vous pouvez désormais vous connecter à l\'aide de vos identifiants';
			$_SESSION['error']='ok';
			//On modifie le compte de l'utilisateur pour signaler que son compte est activé
			$update = mysql_query("UPDATE utilisateur set activation='1', date_activation=CURRENT_TIMESTAMP WHERE code_activation='".$code_activation."'") or die(mysql_error());
		}else{
			$_SESSION['activation']='Votre compte est déjà activé, vous pouvez vous connecter à l\'aide de vos identifiants';
			$_SESSION['error']='noir';
		}
	}
}

//on renvoi l'utilisateur sur la page qu'il était en train de visiter lors de sa connexion
header('Location: ../../../index.php?page=activation');

?>