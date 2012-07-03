<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);
$i = 0;
$test = 0;
$_SESSION['modif_ent'] = "";

//Récupération des champs du formulaire
$denomination = mysql_real_escape_string(htmlentities($_POST['denomination']));
$nom_entreprise = mysql_real_escape_string(htmlentities($_POST['nom_entreprise']));
$siret_entreprise = mysql_real_escape_string(htmlentities($_POST['siret_entreprise']));
$email_entreprise = mysql_real_escape_string(htmlentities($_POST['email_entreprise']));
$site_entreprise = mysql_real_escape_string(htmlspecialchars($_POST['site_entreprise']));
$adresse_entreprise = mysql_real_escape_string(htmlspecialchars($_POST['adresse_entreprise']));
$zipCode_entreprise = mysql_real_escape_string(htmlspecialchars($_POST['zipCode_entreprise']));
$ville_entreprise = mysql_real_escape_string(htmlentities($_POST['ville_entreprise']));
$phoneNumber_entreprise = mysql_real_escape_string(htmlentities($_POST['phoneNumber_entreprise']));
$fax_entreprise = mysql_real_escape_string(htmlentities($_POST['fax_entreprise']));
$mobilePhoneNumber_entreprise = mysql_real_escape_string(htmlentities($_POST['mobilePhoneNumber_entreprise']));

include ('validationModificationEntreprise.php');

$_SESSION['denomination'] = $denomination;
$_SESSION['nom_entreprise'] = $nom_entreprise;
$_SESSION['email_entreprise'] = $email_entreprise;
$_SESSION['site_entreprise'] = $site_entreprise;
$_SESSION['adresse_entreprise'] = $adresse_entreprise;
$_SESSION['zipCode_entreprise'] = $zipCode_entreprise;
$_SESSION['ville_entreprise'] = $ville_entreprise;
$_SESSION['phoneNumber_entreprise'] = $phoneNumber_entreprise;
$_SESSION['fax_entreprise'] = $fax_entreprise;
$_SESSION['mobilePhoneNumber_entreprise'] = $mobilePhoneNumber_entreprise;

if(validateNomEntreprise($nom_entreprise) & 
   validateSiteEntreprise($site_entreprise) & validateAdresseEntreprise($adresse_entreprise) & 
   validateZIPCodeEntreprise($zipCode_entreprise) & validateVilleEntreprise($ville_entreprise) & 
   validatePhoneNumberEntreprise($phoneNumber_entreprise) & validateFaxEntreprise($fax_entreprise) & 
   validateMobilePhoneNumberEntreprise($mobilePhoneNumber_entreprise)) {
	
	$reponse = mysql_query('SELECT id_entreprise FROM entreprise WHERE siret="'.$siret_entreprise.'"') or die(mysql_error());
	
	while ($result = mysql_fetch_array($reponse)) {
		$id_entreprise = $result['id_entreprise'];
	}
	
	$requete = "UPDATE `entreprise` SET mail='$email_entreprise',nom='$nom_entreprise',denomination_sociale='$denomination',telephone_entreprise='$phoneNumber_entreprise',adresse='$adresse_entreprise',cp='$zipCode_entreprise',ville='$ville_entreprise',site='$site_entreprise',fax='$fax_entreprise',portable='$mobilePhoneNumber_entreprise' WHERE id_entreprise='".$id_entreprise."'";
	mysql_query($requete) or die(mysql_error());
	
	$_SESSION['modif_ent'] = "Modifications réussies\n";
	$_SESSION['error'] = "ok";
} else {
	$_SESSION['modif_ent'] = "Veuillez renseigner de nouveau le formulaire\n";
	$_SESSION['error'] = "error";
}

//Renvoi vers la page de modification de profil
header('Location: ../../../index.php?page=modification_entreprise');
?>