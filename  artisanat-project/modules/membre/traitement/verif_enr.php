<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);
$i = 0;
$test = 0;
$_SESSION['error'] = "";

//Récupération des champs du formulaire
$sexe = mysql_real_escape_string(htmlentities($_POST['civilite']));
$nom = mysql_real_escape_string(htmlentities($_POST['name']));
$prenom = mysql_real_escape_string(htmlentities($_POST['firstname']));
$pass = mysql_real_escape_string(htmlspecialchars($_POST['pass1']));
$pass_bis = mysql_real_escape_string(htmlspecialchars($_POST['pass2']));
$mail = mysql_real_escape_string(htmlspecialchars($_POST['email']));
$adresse = mysql_real_escape_string(htmlentities($_POST['address']));
$cp = mysql_real_escape_string(htmlentities($_POST['zipCode']));
$ville = mysql_real_escape_string(htmlentities($_POST['city']));
$telf = mysql_real_escape_string(htmlentities($_POST['phoneNumber']));
$telm = mysql_real_escape_string(htmlentities($_POST['mobilePhoneNumber']));
$date = mysql_real_escape_string(htmlentities($_POST['birthDay']));
$captcha = mysql_real_escape_string(htmlentities($_POST['captchaCode']));

include ('validationInscription.php');

$_SESSION['enr_sexe'] = $sexe;
$_SESSION['enr_nom'] = $nom;
$_SESSION['enr_prenom'] = $prenom;
$_SESSION['enr_mail'] = $mail;
$_SESSION['enr_adresse'] = $adresse;
$_SESSION['enr_cp'] = $cp;
$_SESSION['enr_ville'] = $ville;
$_SESSION['enr_telf'] = $telf;
$_SESSION['enr_telm'] = $telm;

/*
echo "nom : ".validateName($nom)." "."prénom : ".validateFirstname($prenom)." ";
echo "passwords : ".validatePasswords($pass,$pass_bis). " ";
echo "email : ".validateEmail($mail). " ". "adresse : ".validateAddress($adresse)." ";
echo "zip : ".validateZIPCode($cp). " ". "ville : ".validateCity($ville)." ";
echo "fixe : ".validatePhoneNumber($telf). " ". "portable : ".validateMobilePhoneNumber($telm)." ";
echo "anniversaire : ".validateBirthDay($date). " ". "captcha : ".validateCaptcha($captcha)." ";
*/

if(validateName($nom) & validateFirstname($prenom) & 
   validatePasswords($pass,$pass_bis) & 
   validateEmail($mail) & validateAddress($adresse) & 
   validateZIPCode($cp) & validateCity($ville) & 
   validatePhoneNumber($telf) & validateMobilePhoneNumber($telm) & 
   validateBirthDay($date) & validateCaptcha($captcha)) {
	
	$parts = explode("/", $date);
	$jour = $parts[0];
	$mois = $parts[1];
	$annee = $parts[2];
	$goodDate = $annee."-".$mois."-".$jour;
	
	$pass = md5($pass);
	$code_activation = md5($nom.$prenom.$jour.$mois.$annee.$ville);
	$ip = $_SERVER["REMOTE_ADDR"];
	$requete = "INSERT INTO `utilisateur` (id_user,mail,password,nom,prenom,date_naissance,sexe,adresse,cp,ville,telephone_domicile,telephone_portable,ip_enregistrement,code_activation,activation) VALUES (NULL,'$mail','$pass','$nom','$prenom','$goodDate','$sexe','$adresse','$cp','$ville','$telf','$telm','$ip','$code_activation',0)";
	mysql_query($requete) or die(mysql_error());
	$_SESSION['enr'] = "Enregistrement réussi, vous avez reçu un E-mail pour valider votre compte\n";
	$_SESSION['error'] = "green";
	//Envoi d'un mail pour confirmation
	//include('mail_confirmation.php');
} else if (!validateEmail($mail)) {
	$_SESSION['error'] = "red";
	$_SESSION['enr'] = "L'adresse email saisie n'est pas valide ou est déjà utilisée\n";
} else {
	$_SESSION['error'] = "red";
	$_SESSION['enr'] = "Veuillez renseigner de nouveau le formulaire\n";
}

//Renvoi vers la page d'inscription	
header('Location: ../../../index.php?page=inscription');
?>