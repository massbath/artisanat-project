<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//R�cup�ration des donn�es renseign�es par l'utilisateur
$mail_d=mysql_escape_string($_POST['username']);
$password_d=mysql_escape_string($_POST['mdpasse']);
$reponse = mysql_query('SELECT id_user, mail, password, prenom, activation FROM utilisateur WHERE mail="'.$mail_d.'"') or die(mysql_error());

//on v�rifie que le compte existe bien
if(mysql_numrows($reponse)==0){
	//pas de membre avec ce pseudo
	$ok=FALSE;
	$_SESSION['login']="Compte inconnu ! ";
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		//si le pseudo existe on v�rifie que le mot de passe associ� soit le bon
		if(md5($password_d)==$result['password'])
		{
			if($result['activation']==1)
			{
				$ok=TRUE;
				$id_user=$result['id_user'];
				$mail=$result['mail'];
				$prenom=$result['prenom'];
			}else{
				$ok=FALSE;
				$_SESSION['login']="Ce compte n'est pas activ�. V�rifiez vos E-mails pour activer votre compte. Si vous ne l'avez pas re�u vous pouvez demander ci-dessous une nouvelle exp�dition de votre code d'activation";
			}
		}else{
			$ok=FALSE;
			$_SESSION['login']="Mauvais password ! ";
		}
	}
}

//si tout est correct, on cr�� les diff�rentes variable de session
if($ok==TRUE){
	$_SESSION['login']="Vous &ecirc;tes maintenant connect&eacute; ! ";	
	$_SESSION['logged']=true;	
	$_SESSION['mail'] = $mail;
	$_SESSION['id_user'] = $id_user;	
	$_SESSION['prenom'] = $prenom;
	//on renvoi l'utilisateur sur la page qu'il �tait en train de visiter lors de sa connexion
	header('Location: '.$_SERVER["HTTP_REFERER"].'');
	/*if(isset($_GET['page'])) $page=mysql_escape_string(strtolower($_GET['page']));
	if(isset($page)){
		//si pas dans l'index
		header('Location: ../../../index.php?page='.$page.'');
	}else{
		header('Location: ../../../index.php');
	}*/
}else{
	//Si la connexion a �chou�e, on renvoi l'utilisateur sur la page d'erreur de connexion
	header('Location: ../../../index.php?page=connexion&erreur=log');
}



?>
