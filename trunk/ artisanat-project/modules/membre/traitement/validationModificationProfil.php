<?php
	session_start();
	
	function validateName($name) {	
		if(preg_match("#^[\sa-zA-Zéèêëàâîïôöûü-]+$#", $name) && strlen($name) > 1) { // valide
			return true;
		} else {
			return false;
		}
	}		
	
	function validateFirstname($firstname) {
		if(preg_match("#^[\sa-zA-Zéèêëàâîïôöûü-]+$#", $firstname) && strlen($firstname) > 1) { // valide
			return true;
		} else {
			return false;
		}
	}
	
	function validatePasswords($pass1, $pass2) {
		if(strpos($pass1, ' ') !== false || strlen($pass2) == 0) { // invalide
			return false;
		}

		return $pass1 == $pass2 && strlen($pass1) > 4;
	}
	
	function validateEmail($email) {
		$reponse = mysql_query("SELECT mail FROM `utilisateur` WHERE mail='".$email."' AND id_user<>'".$_SESSION['id_user']."'") or die(mysql_error());
			
		if(mysql_numrows($reponse) == 0 && preg_match("#^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$#", $email)){
			return true;
		} else {
			return false;
		}
	}
	
	function validateAddress($address) {
		if(strlen($address) < 5) { // invalide
			return false;
		} else {
			return true;
		}
	}
	
	function validateZIPCode($zipCode) {
		return preg_match("#^(([0-8][0-9])|(9[0-5]))[0-9]{3}$#", $zipCode);
	}
	
	function validateCity($city) {
		if(preg_match("#^[\sa-zA-Zéèêëàâîïôöûü-]+$#", $city) && strlen($city) > 0) { // valide
			return true;
		} else {
			return false;
		}
	}
	
	function validatePhoneNumber($phoneNumber) {
		if(preg_match("#^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$#", $phoneNumber)) { // valide
			return true;
		} else if(strlen($phoneNumber) == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function validateMobilePhoneNumber($mobilePhoneNumber) {
		if(preg_match("#^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$#", $mobilePhoneNumber)) { // valide
			return true;
		} else if(strlen($mobilePhoneNumber) == 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function validateBirthDay($birthDay) {
		if(preg_match("#^([0-2]{1}[0-9]{1}|[3]{1}[0-1]{1})/(0[1-9]{1}|1[0-2]{1})/[0-9]{4}$#", $birthDay)) { // valide
			return true;
		} else {
			return false;
		}
	}
?>