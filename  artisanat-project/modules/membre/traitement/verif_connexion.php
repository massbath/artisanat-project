<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//R�cup�ration des donn�es renseign�es par l'utilisateur
$mail_d=mysql_escape_string($_POST['username']);
$password_d=mysql_escape_string($_POST['mdpasse']);
$reponse = mysql_query('SELECT id_user, mail, password, prenom, activation FROM utilisateur WHERE mail="'.$mail_d.'"') or die(mysql_error());
$log=0;

//on v�rifie que le compte existe bien
if(mysql_numrows($reponse)==0){
	//pas de membre avec ce pseudo
	$ok=FALSE;
	$_SESSION['login']="Compte inconnu ! ";
	$_SESSION['error']="error";
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		//si le pseudo existe on v�rifie que le mot de passe associ� soit le bon
		if($result['activation']==1)
		{
			if(md5($password_d)==$result['password'])
			{
				$ok=TRUE;
				$id_user=$result['id_user'];
				$mail=$result['mail'];
				$prenom=$result['prenom'];
			}else{
				$ok=FALSE;
				$_SESSION['login']="Mauvais mot de passe ! Vous avez la possibilit� de demander la r�initilisation et l'envoi de votre mot de passe.";
				$_SESSION['error']="error";
			}
		}else{
			$ok=FALSE;
			$_SESSION['login']="Ce compte n'est pas activ�. V�rifiez vos E-mails pour activer votre compte. Si vous ne l'avez pas re�u vous pouvez demander ci-dessous une nouvelle exp�dition de votre code d'activation";
			$_SESSION['error']="error";
			$log=1;
		}
	}
}

//si tout est correct, on cr�� les diff�rentes variable de session
if($ok==TRUE){
	$_SESSION['login']="Vous &ecirc;tes maintenant connect&eacute; ! ";	
	$_SESSION['error']='ok';
	$_SESSION['logged']=true;	
	$_SESSION['mail'] = $mail;
	$_SESSION['id_user'] = $id_user;	
	$_SESSION['prenom'] = $prenom;
	//Si l'utilisateur avait demand� � s'enregistrer en tant qu'entreprise
	if(isset($_SESSION['demande_enr']))
	{
		if($_SESSION['demande_enr']=="pro")
		{
			$_SESSION['login']='Vous pouvez maintenant enregistrer votre entreprise en cliquant sur le lien suivant : <a href="index.php?page=creation_entreprise">Enregistrement Entreprise</a>';
			header('Location: ../../../index.php?page=connexion&erreur=no');
		}
	}else{
		//on renvoi l'utilisateur sur la page qu'il �tait en train de visiter lors de sa connexion
		if(isset($_SESSION['lien']))
		{
			header('Location: '.$_SESSION['lien'].'');
			unset($_SESSION['lien']);
		}else{
			header('Location: '.$_SERVER["HTTP_REFERER"].'');
		}
	}
	/*if(isset($_GET['page'])) $page=mysql_escape_string(strtolower($_GET['page']));
	if(isset($page)){
		//si pas dans l'index
		header('Location: ../../../index.php?page='.$page.'');
	}else{
		header('Location: ../../../index.php');
	}*/
}else{
	//Si la connexion a �chou�e, on renvoi l'utilisateur sur la page d'erreur de connexion
	if($log==1)
	{
		header('Location: ../../../index.php?page=connexion&erreur=act');
	}else{
		header('Location: ../../../index.php?page=connexion&erreur=log');
	}
	$_SESSION['lien'] = $_SERVER["HTTP_REFERER"];
}



?>
