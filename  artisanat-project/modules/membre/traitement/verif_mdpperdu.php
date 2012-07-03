<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//Récupération des données renseignées par l'utilisateur
$mail_d=mysql_escape_string($_POST['mail']);
$jour_d=mysql_escape_string($_POST['jour']);
$mois_d=mysql_escape_string($_POST['mois']);
$annee_d=mysql_escape_string($_POST['annee']);
$date_naissance=$annee_d.'-'.$mois_d.'-'.$jour_d;
$reponse = mysql_query('SELECT id_user, mail, password, prenom, activation FROM utilisateur WHERE mail="'.$mail_d.'" and date_naissance="'.$date_naissance.'"') or die(mysql_error());
$log=0;

//on vérifie que le compte existe bien
if(mysql_numrows($reponse)==0){
	//pas de membre avec ce pseudo
	$ok=FALSE;
	$_SESSION['mdpperdu']="Aucun compte ne correspond aux informations renseignées ! ";
	$_SESSION['error']="error";
}else{		
	while ($result = mysql_fetch_array($reponse) )
	{
		//génération d'un mot de passe aléatoire
		$nb_car = 8;
		$chaine = 'azertyuiopqsdfghjklmwxcvbn123456789';
		$nb_lettres = strlen($chaine) - 1;
		$generation = '';
		for($i=0; $i < $nb_car; $i++)
		{
			$pos = mt_rand(0, $nb_lettres);
			$car = $chaine[$pos];
			$generation .= $car;
		}
		$mdp=md5($generation);
		
		//Modification de la table
		$user = $result['id_user'];
		$update = mysql_query("UPDATE utilisateur set password='".$mdp."' WHERE id_user='".$user."'") or die(mysql_error());
		
		//Envoi du mail
		$mail = $result['mail'];
		include('mail_mdpperdu.php');
		
		//Réinitialisation du mot de passe et modification de la table utilisateur
		$ok=TRUE;
		$_SESSION['mdpperdu']="Votre mot de passe a été réinitialisé et envoyé sur votre boite mail";
		$_SESSION['error']='ok';
	}
}
//on renvoi l'utilisateur sur la page de mot de passe perdu avec les infos
header('Location: ../../../index.php?page=mdpperdu');

?>