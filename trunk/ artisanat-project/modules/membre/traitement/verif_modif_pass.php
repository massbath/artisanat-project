<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link); 

//Récupération des données renseignées par l'utilisateur
$mdp_d=mysql_escape_string($_POST['mdp_original']);
$mdp1_d=mysql_escape_string($_POST['mdp_new']);
$mdp2_d=mysql_escape_string($_POST['mdp_new2']);
$mail_d=$_SESSION['mail'];
$reponse = mysql_query('SELECT id_user, mail, password FROM utilisateur WHERE mail="'.$mail_d.'"') or die(mysql_error());
$log=0;

while ($result = mysql_fetch_array($reponse) )
{
	//Vérification si ancien password ok
	if(md5($mdp_d)==$result['password'])
	{
		if($mdp1_d==$mdp2_d)
		{
			if(preg_match("#^([a-zA-Z0-9]){4,}#",$mdp1_d)==true)
			{
				$mdp=md5($mdp1_d);
				//Modification de la table
				$user = $result['id_user'];
				$update = mysql_query("UPDATE utilisateur set password='".$mdp."' WHERE id_user='".$user."'") or die(mysql_error());
				
				//Réinitialisation du mot de passe et modification de la table utilisateur
				$ok=TRUE;
				$_SESSION['modif_pass']="Votre mot de passe a modifié avec succès";
				$_SESSION['error']='ok';
			}else{
				$_SESSION['modif_pass']="Problème de syntaxe pour le nouveau mot de passe : 4 caractères minimum et pas de caractères spéciaux";
				$_SESSION['error']='error';
			}
		}else{
			$_SESSION['modif_pass']="Les deux nouveaux mots de passe renseignés ne sont pas identiquess";
			$_SESSION['error']='error';
		}
	}else{
		$_SESSION['modif_pass']="Le mot de passe actuel renseigné n'est pas correct";
		$_SESSION['error']='error';
	}
}

//on renvoi l'utilisateur sur la page de changement de mot de passe avec les infos
header('Location: ../../../index.php?page=modif_pass');

?>