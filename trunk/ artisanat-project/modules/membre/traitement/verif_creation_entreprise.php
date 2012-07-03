<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);
$_SESSION['error'] = "";

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

include ('validationCreationEntreprise.php');

$_SESSION['denomination'] = $denomination;
$_SESSION['nom_entreprise'] = $nom_entreprise;
$_SESSION['siret_entreprise'] = $siret_entreprise;
$_SESSION['email_entreprise'] = $email_entreprise;
$_SESSION['site_entreprise'] = $site_entreprise;
$_SESSION['adresse_entreprise'] = $adresse_entreprise;
$_SESSION['zipCode_entreprise'] = $zipCode_entreprise;
$_SESSION['ville_entreprise'] = $ville_entreprise;
$_SESSION['phoneNumber_entreprise'] = $phoneNumber_entreprise;
$_SESSION['fax_entreprise'] = $fax_entreprise;
$_SESSION['mobilePhoneNumber_entreprise'] = $mobilePhoneNumber_entreprise;

/*echo "nom : ".validateNomEntreprise($nom_entreprise)." "."siret : ".validateSiretEntreprise($siret_entreprise)." ";
echo "email : ".validateEmailEntreprise($email_entreprise). " ";
echo "site : ".validateSiteEntreprise($site_entreprise). " ". "adresse : ".validateAdresseEntreprise($adresse_entreprise)." ";
echo "zip : ".validateZIPCodeEntreprise($zipCode_entreprise). " ". "ville : ".validateVilleEntreprise($ville_entreprise)." ";
echo "fixe : ".validatePhoneNumberEntreprise($phoneNumber_entreprise). " ". "fax : ".validateFaxEntreprise($fax_entreprise)." ";
echo "mobile : ".validateMobilePhoneNumberEntreprise($mobilePhoneNumber_entreprise);*/

if(validateNomEntreprise($nom_entreprise) & validateSiretEntreprise($siret_entreprise) & 
   validateEmailEntreprise($email_entreprise) & 
   validateSiteEntreprise($site_entreprise) & validateAdresseEntreprise($adresse_entreprise) & 
   validateZIPCodeEntreprise($zipCode_entreprise) & validateVilleEntreprise($ville_entreprise) & 
   validatePhoneNumberEntreprise($phoneNumber_entreprise) & validateFaxEntreprise($fax_entreprise) & 
   validateMobilePhoneNumberEntreprise($mobilePhoneNumber_entreprise)) {
   
	$requete = "INSERT INTO `entreprise` (id_entreprise,mail,nom,denomination_sociale,active,date_enregistrement,telephone_entreprise,adresse,cp,ville,site,siret,fax,portable) VALUES (NULL,'$email_entreprise','$nom_entreprise','$denomination','1',CURRENT_TIMESTAMP,'$phoneNumber_entreprise','$adresse_entreprise','$zipCode_entreprise','$ville_entreprise','$site_entreprise','$siret_entreprise','$fax_entreprise','$mobilePhoneNumber_entreprise')";
	mysql_query($requete) or die(mysql_error());
	
	$reponse = mysql_query('SELECT id_entreprise FROM entreprise WHERE siret="'.$siret_entreprise.'"') or die(mysql_error());
	
	while ($result = mysql_fetch_array($reponse)) {
		$id_entreprise = $result['id_entreprise'];
	}
	
	$id_user = $_SESSION['id_user'];
	
	$requete = "INSERT INTO `lien_utilisateur_entreprise` (id_user,id_entreprise,droit,date_debut) VALUES ('$id_user','$id_entreprise',0,CURRENT_TIMESTAMP)";
	mysql_query($requete) or die(mysql_error());
	
	$_SESSION['crea_ent'] = $_SESSION['crea_ent']."Entreprise créée avec succès\n";
	$_SESSION['error'] = "ok";
} else if (!validateSiretEntreprise($siret_entreprise)) {
	$_SESSION['error'] = "error";
	$_SESSION['crea_ent'] = $_SESSION['crea_ent']."Le numéro de siret saisi n'est pas valide ou est déjà utilisé\n";
} else {
	$_SESSION['error'] = "error";
	$_SESSION['crea_ent'] = $_SESSION['crea_ent']."Veuillez renseigner de nouveau le formulaire\n";
}

//Renvoi vers la page de création d'entreprise
header('Location: ../../../index.php?page=creation_entreprise');
?>