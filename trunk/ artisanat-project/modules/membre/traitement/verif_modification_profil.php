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
$mail = mysql_real_escape_string(htmlspecialchars($_POST['email']));
$adresse = mysql_real_escape_string(htmlentities($_POST['address']));
$cp = mysql_real_escape_string(htmlentities($_POST['zipCode']));
$ville = mysql_real_escape_string(htmlentities($_POST['city']));
$telf = mysql_real_escape_string(htmlentities($_POST['phoneNumber']));
$telm = mysql_real_escape_string(htmlentities($_POST['mobilePhoneNumber']));
$date = mysql_real_escape_string(htmlentities($_POST['birthDay']));

include ('validationModificationProfil.php');

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
   validateEmail($mail) & validateAddress($adresse) & 
   validateZIPCode($cp) & validateCity($ville) & 
   validatePhoneNumber($telf) & validateMobilePhoneNumber($telm) & 
   validateBirthDay($date)) {
	
	$parts = explode("/", $date);
	$jour = $parts[0];
	$mois = $parts[1];
	$annee = $parts[2];
	$goodDate = $annee."-".$mois."-".$jour;
	
	$ip = $_SERVER["REMOTE_ADDR"];
	$requete = "UPDATE `utilisateur` SET mail='$mail',nom='$nom',prenom='$prenom',date_naissance='$goodDate',sexe='$sexe',adresse='$adresse',cp='$cp',ville='$ville',telephone_domicile='$telf',telephone_portable='$telm',ip_enregistrement='$ip' WHERE id_user='".$_SESSION['id_user']."'";
	mysql_query($requete) or die(mysql_error());
	$_SESSION['modif_p'] = "Modifications réussies\n";
	$_SESSION['error'] = "ok";
} else if (!validateEmail($mail)) {
	$_SESSION['error'] = "error";
	$_SESSION['modif_p'] = "L'adresse email saisie n'est pas valide ou est déjà utilisée\n";
} else {
	$_SESSION['error'] = "error";
	$_SESSION['modif_p'] = "Veuillez renseigner de nouveau le formulaire\n";
}

//Renvoi vers la page de modification de profil
header('Location: ../../../index.php?page=modification_profil');
?>