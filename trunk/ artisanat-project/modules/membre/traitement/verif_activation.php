<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//R�cup�ration des donn�es renseign�es par l'utilisateur
$code_activation = mysql_real_escape_string(htmlspecialchars($_POST['code_activation']));
$reponse = mysql_query('SELECT code_activation, activation FROM utilisateur WHERE code_activation="'.$code_activation.'"') or die(mysql_error());

//on v�rifie que le code d'activation existe bien
if(mysql_numrows($reponse)==0){
	//le code n'existe pas
	$ok=FALSE;
	$_SESSION['activation']="Ce code d'activation n'existe pas. V�rifiez que vous avez bien saisi le code qui vous a �t� envoy� par mail.";
	$_SESSION['error']='error';
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		//si le code d'activation existe, on v�rifie que le compte n'est pas d�j� activ�
		if($result['activation']!=1)
		{
			$ok=TRUE;
			$_SESSION['activation']='Votre compte est maintenant activ�, vous pouvez d�sormais vous connecter � l\'aide de vos identifiants';
			$_SESSION['error']='ok';
			//On modifie le compte de l'utilisateur pour signaler que son compte est activ�
			$update = mysql_query("UPDATE utilisateur set activation='1', date_activation=CURRENT_TIMESTAMP WHERE code_activation='".$code_activation."'") or die(mysql_error());
		}else{
			$_SESSION['activation']='Votre compte est d�j� activ�, vous pouvez vous connecter � l\'aide de vos identifiants';
			$_SESSION['error']='noir';
		}
	}
}

//on renvoi l'utilisateur sur la page qu'il �tait en train de visiter lors de sa connexion
header('Location: ../../../index.php?page=activation');

?>