<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database,$link);
$i=0;
$test=0;
$_SESSION['error']="";

//Récupération des champs du formulaire
$nom = mysql_real_escape_string(htmlentities($_POST['nom']));
$prenom = mysql_real_escape_string(htmlentities($_POST['prenom']));
$mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
$mail_bis = mysql_real_escape_string(htmlspecialchars($_POST['mail_bis']));
$pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
$pass_bis = mysql_real_escape_string(htmlspecialchars($_POST['pass_bis']));
$adresse = mysql_real_escape_string(htmlentities($_POST['adresse']));
$cp = mysql_real_escape_string(htmlentities($_POST['cp']));
$ville = mysql_real_escape_string(htmlentities($_POST['ville']));
$sexe = mysql_real_escape_string(htmlentities($_POST['sexe']));
$jour = mysql_real_escape_string(htmlentities($_POST['jour']));
$mois = mysql_real_escape_string(htmlentities($_POST['mois']));
$annee = mysql_real_escape_string(htmlentities($_POST['annee']));
$telf = mysql_real_escape_string(htmlentities($_POST['telf']));
$telm = mysql_real_escape_string(htmlentities($_POST['telm']));


//VERIF PASS
if($pass==""){$_SESSION['error']=$_SESSION['error']."Champ Password : non renseigné\n"; $i=$i+1;}else{
if(preg_match("#^([a-zA-Z0-9]){4,}#",$pass)==false){$_SESSION['error']=$_SESSION['error']."Champ Password : problème de syntaxe (pas de caractères spéciaux). Il faut au moins 4 caractères\n"; $i=$i+1;}
if($pass!=$pass_bis){$_SESSION['error']=$_SESSION['error']."Champs Password : Non identiques\n"; $i=$i+1;}
}
//VERIF NOM
if($nom==""){$_SESSION['error']=$_SESSION['error']."Champ Nom : non renseigné\n"; $i=$i+1; $test=1;}else{
if(preg_match("#^([a-zA-Z]){2,}#",$nom)==false){$_SESSION['error']=$_SESSION['error']."Champ Nom : problème de syntaxe (pas de caractères spéciaux)\n"; $i=$i+1; $test=1;}
}
if($test==0) $_SESSION['enr_nom']=$nom;
$test=0;
//VERIF PRENOM
if($prenom==""){$_SESSION['error']=$_SESSION['error']."Champ Prénom : non renseigné\n"; $i=$i+1; $test=1;}else{
if(preg_match("#^([a-zA-Z]){2,}#",$prenom)==false){$_SESSION['error']=$_SESSION['error']."Champ Prénom : problème de syntaxe (pas de caractères spéciaux)\n"; $i=$i+1; $test=1;}
}
if($test==0) $_SESSION['enr_prenom']=$prenom;
$test=0;
//VERIF MAIL
if($mail==""){$_SESSION['error']=$_SESSION['error']."Champ Mail : non renseigné\n"; $i=$i+1; $test=1;}else{
if($mail!=$mail_bis){$_SESSION['error']=$_SESSION['error']."Champs Mail : Non identiques\n"; $i=$i+1;}
if(preg_match("#^[a-zA-Z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,3}#", $mail)==false){$_SESSION['error']=$_SESSION['error']."Champ Mail : problème de syntaxe ( mail@fai.com / fr )\n"; $i=$i+1; $test=1;}else{

$reponse = mysql_query('SELECT mail FROM `utilisateur` WHERE mail="'.$mail.'"') or die(mysql_error());		
if(mysql_numrows($reponse)>=1){$_SESSION['error']=$_SESSION['error']."Champ Mail : Déjà utilisé\n"; $i=$i+1; $test=1;}
}}
if($test==0) $_SESSION['enr_mail']=$mail;$_SESSION['enr_mail_bis']=$mail_bis;
$test=0;
//VERIF SEXE
if($sexe==""){$_SESSION['error']=$_SESSION['error']."Champ Sexe : non renseigné\n"; $i=$i+1; $test=1;}
if($test==0) $_SESSION['enr_sexe']=$sexe;
$test=0;
//VERIF DATE NAISSANCE
if($jour==""){$_SESSION['error']=$_SESSION['error']."Champ Date de naissance : jour non renseigné\n"; $i=$i+1; $test=1;}
if($mois==""){$_SESSION['error']=$_SESSION['error']."Champ Date de naissance : mois non renseigné\n"; $i=$i+1; $test=1;}
if($annee==""){$_SESSION['error']=$_SESSION['error']."Champ Date de naissance : annee non renseigné\n"; $i=$i+1; $test=1;}
if($test==0){$_SESSION['enr_jour']=$jour;$_SESSION['enr_mois']=$mois;$_SESSION['enr_annee']=$annee;$date_naissance = $annee.'-'.$mois.'-'.$jour;}
$test=0;
//VERIF ADRESSE
if($adresse==""){$_SESSION['error']=$_SESSION['error']."Champ Adresse : non renseigné\n"; $i=$i+1; $test=1;}else{
//if(preg_match("#^([a-zA-Z]){2,}#",$adresse)==false){$_SESSION['error']=$_SESSION['error']."Champ Adresse : problème de syntaxe\n"; $i=$i+1; $test=1;}
}
if($test==0) $_SESSION['enr_adresse']=$adresse;
$test=0;
//VERIF CODE POSTAL
if($cp==""){$_SESSION['error']=$_SESSION['error']."Champ Code Postal : non renseigné\n"; $i=$i+1; $test=1;}else{
//if(preg_match("#^([0-9]){5,}#",$adresse)==false){$_SESSION['error']=$_SESSION['error']."Champ Code Postal : problème de syntaxe\n"; $i=$i+1; $test=1;}
}
if($test==0) $_SESSION['enr_cp']=$cp;
$test=0;
//VERIF VILLE
if($ville==""){$_SESSION['error']=$_SESSION['error']."Champ Ville : non renseigné\n"; $i=$i+1; $test=1;}else{
//if(preg_match("#^([a-zA-Z]){1,}#",$adresse)==false){$_SESSION['error']=$_SESSION['error']."Champ Ville : problème de syntaxe\n"; $i=$i+1; $test=1;}
}
if($test==0) $_SESSION['enr_ville']=$ville;
$test=0;
//VERIF TELEPHONE
if($telf!="") $_SESSION['enr_telf']=$telf;
if($telm!="") $_SESSION['enr_telm']=$telm;
//VERIF COCHAGE CONDITIONS
if($_POST['condition']==false){$_SESSION['error']=$_SESSION['error']."Assurez vous d'avoir bien pris connaissance des conditions générales du site puis d'avoir coché la case correspondante\n"; $i=$i+1;}


if($i==0)
{
	// tout est correct : on ajoute cette personne dans la base de donnée
	$pass=md5($pass);
	$code_activation = md5($nom.$prenom.$jour.$mois.$annee.$ville);
	$ip=$_SERVER["REMOTE_ADDR"];
	$requete="INSERT INTO `utilisateur` (id_user,mail,password,nom,prenom,date_naissance,sexe,adresse,cp,ville,telephone_domicile,telephone_portable,ip_enregistrement,activation) VALUES (NULL,'$mail','$pass','$nom','$prenom','$date_naissance','$sexe','$adresse','$cp','$ville','$telf','$telm','$ip','$code_activation')";
	mysql_query($requete) or die(mysql_error());
	$_SESSION['error']=$_SESSION['error']."Enregistrement réussi, vous avez reçu un E-mail pour valider votre compte\n";
	$_SESSION['color']="green";
	//Envoi d'un mail pour confirmation
	include('mail_confirmation.php');
}else{
	$_SESSION['color']="red";
	$_SESSION['error']=$_SESSION['error']."N'oubliez pas de mettre à nouveau votre mot de passe\n";
}
//Renvoi vers la page d'inscription	
header('Location: ../../../index.php?page=inscription');
?>