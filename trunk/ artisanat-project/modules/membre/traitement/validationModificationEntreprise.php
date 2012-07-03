<?php
	function validateNomEntreprise($nom_entreprise) {
		if(strlen($nom_entreprise) > 2) { // valide
			return true;
		} else {
			return false;
		}
	}
	
	function validateEmailEntreprise($email_entreprise) {
		if(preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$#", $email_entreprise)){
			return true;
		} else {
			return false;
		}
	}
	
	function validateSiteEntreprise($site_entreprise) {
		if(preg_match("#^http:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}$#", $site_entreprise)) { // valide
			return true;
		} else if(strlen($site_entreprise) == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function validateAdresseEntreprise($adresse_entreprise) {
		if(strlen($adresse_entreprise) < 5) { // invalide
			return false;
		} else {
			return true;
		}
	}
	
	function validateZIPCodeEntreprise($zipCode_entreprise) {
		return preg_match("#^(([0-8][0-9])|(9[0-5]))[0-9]{3}$#", $zipCode_entreprise);
	}
	
	function validateVilleEntreprise($ville_entreprise) {
		if(preg_match("#^[\sa-zA-Zéèêëàâîïôöûü-]+$#", $ville_entreprise) && strlen($ville_entreprise) > 0) { // valide
			return true;
		} else {
			return false;
		}
	}
	
	function validatePhoneNumberEntreprise($phoneNumber_entreprise) {
		if(preg_match("#^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$#", $phoneNumber_entreprise)) { // valide
			return true;
		} else {
			return false;
		}
	}
	
	function validateFaxEntreprise($fax_entreprise) {
		if(preg_match("#^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$#", $fax_entreprise)) { // valide
			return true;
		} else if(strlen($fax_entreprise) == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function validateMobilePhoneNumberEntreprise($mobilePhoneNumber_entreprise) {
		if(preg_match("#^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$#", $mobilePhoneNumber_entreprise)) { // valide
			return true;
		} else if(strlen($mobilePhoneNumber_entreprise) == 0) {
			return true;
		} else {
			return false;
		}
	}
?>