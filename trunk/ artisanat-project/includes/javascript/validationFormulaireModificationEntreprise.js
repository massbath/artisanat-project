$(document).ready(function() {
	// Récupère les données entreprise en base
	getDataEntreprise(treatDataEntreprise);
	
	// lance la récupération des données entreprise en appelant get_DataEntreprise.php
	function getDataEntreprise(treatDataEntreprise) {
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				treatDataEntreprise(xhr.responseText);
			}
		};
		
		xhr.open("GET", "modules/membre/traitement/get_DataEntreprise.php", true);
		xhr.send(null);
	}

	// traite les données entreprise récupérées
	function treatDataEntreprise(sData) {	
		var data = sData.split('|');

		document.getElementById('email_entreprise').value = data[0];
		document.getElementById('nom_entreprise').value = data[1];
		
		if(data[2] == "SARL") {
			document.getElementById('denomination').selectedIndex = 0;
		} else if(data[2] == "EURL") {
			document.getElementById('denomination').selectedIndex = 1;
		} else if(data[2] == "SA") {
			document.getElementById('denomination').selectedIndex = 2;
		} else if(data[2] == "SAS") {
			document.getElementById('denomination').selectedIndex = 3;
		} else if(data[2] == "SNC") {
			document.getElementById('denomination').selectedIndex = 4;
		}
			
		document.getElementById('phoneNumber_entreprise').value = data[3];
		document.getElementById('adresse_entreprise').value = data[4];
		document.getElementById('zipCode_entreprise').value = data[5];
		document.getElementById('ville_entreprise').value = data[6];
		document.getElementById('siret_entreprise').value = data[7];
		document.getElementById('site_entreprise').value = data[8];
		document.getElementById('fax_entreprise').value = data[9];
		document.getElementById('mobilePhoneNumber_entreprise').value = data[10];
		
		// Demande la validation de tous les champs
		validateNomEntreprise();
		validateEmailEntreprise();
		validateSiteEntreprise();
		validateAdresseEntreprise();
		validateZIPCodeEntreprise();
		validateVilleEntreprise();
		validatePhoneNumberEntreprise();
		validateFaxEntreprise();
		validateMobilePhoneNumberEntreprise();
	}
	
	// créer une XMLHttpRequest
	function getXMLHttpRequest() {
		var xhr = null;
		
		if (window.XMLHttpRequest || window.ActiveXObject) {
			if (window.ActiveXObject) {
				try {
					xhr = new ActiveXObject("Msxml2.XMLHTTP");
				} catch(e) {
					xhr = new ActiveXObject("Microsoft.XMLHTTP");
				}
			} else {
				xhr = new XMLHttpRequest(); 
			}
		} else {
			alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest.");
			return null;
		}
		
		return xhr;
	}

	var formulaire = $("#formulaireModificationEntreprise");
	
	var nom_entreprise = $("#nom_entreprise");
	var nom_entrepriseInfo = $("#nom_entrepriseInfo");
	
	var email_entreprise = $("#email_entreprise");
	var email_entrepriseInfo = $("#email_entrepriseInfo");
	
	var site_entreprise = $("#site_entreprise");
	var site_entrepriseInfo = $("#site_entrepriseInfo");
	
	var adresse_entreprise = $("#adresse_entreprise");
	var adresse_entrepriseInfo = $("#adresse_entrepriseInfo");
	
	var zipCode_entreprise = $("#zipCode_entreprise");
	var zipCode_entrepriseInfo = $("#zipCode_entrepriseInfo");
	
	var ville_entreprise = $("#ville_entreprise");
	var ville_entrepriseInfo = $("#ville_entrepriseInfo");
	
	var phoneNumber_entreprise = $("#phoneNumber_entreprise");
	var phoneNumber_entrepriseInfo = $("#phoneNumber_entrepriseInfo");
	
	var fax_entreprise = $("#fax_entreprise");
	var fax_entrepriseInfo = $("#fax_entrepriseInfo");
	
	var mobilePhoneNumber_entreprise = $("#mobilePhoneNumber_entreprise");
	var mobilePhoneNumber_entrepriseInfo = $("#mobilePhoneNumber_entrepriseInfo");
							  	
	//On blur
	nom_entreprise.blur(validateNomEntreprise);
	email_entreprise.blur(validateEmailEntreprise);
	site_entreprise.blur(validateSiteEntreprise);
	adresse_entreprise.blur(validateAdresseEntreprise);
	zipCode_entreprise.blur(validateZIPCodeEntreprise);
	ville_entreprise.blur(validateVilleEntreprise);
	phoneNumber_entreprise.blur(validatePhoneNumberEntreprise);
	fax_entreprise.blur(validateFaxEntreprise);
	mobilePhoneNumber_entreprise.blur(validateMobilePhoneNumberEntreprise);
	
	//On key press
	nom_entreprise.keyup(validateNomEntreprise);
	email_entreprise.keyup(validateEmailEntreprise);
	site_entreprise.keyup(validateSiteEntreprise);
	adresse_entreprise.keyup(validateAdresseEntreprise);
	zipCode_entreprise.keyup(validateZIPCodeEntreprise);
	ville_entreprise.keyup(validateVilleEntreprise);
	phoneNumber_entreprise.keyup(validatePhoneNumberEntreprise);
	fax_entreprise.keyup(validateFaxEntreprise);
	mobilePhoneNumber_entreprise.keyup(validateMobilePhoneNumberEntreprise);
	
	function validateNomEntreprise() {
		var a = $("#nom_entreprise").val();

		if(nom_entreprise.val().length > 2) { //valide
			nom_entreprise.removeClass("error");
			nom_entreprise.addClass("ok");
			
			nom_entrepriseInfo.text("Valide");
			nom_entrepriseInfo.removeClass("error");
			nom_entrepriseInfo.addClass("ok");
			return true;
		} else {
			nom_entreprise.removeClass("ok");
			nom_entreprise.addClass("error");
			
			nom_entrepriseInfo.text("Minimum 3 lettres");
			nom_entrepriseInfo.removeClass("ok");
			nom_entrepriseInfo.addClass("error");			
			return false;
		}
	}
	
	function validateEmailEntreprise() {
		var a = $("#email_entreprise").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		if(filter.test(a)) { //valide	
			email_entreprise.removeClass("error");
			email_entreprise.addClass("ok");
			
			email_entrepriseInfo.text("Valide");
			email_entrepriseInfo.removeClass("error");
			email_entrepriseInfo.addClass("ok");
			return true;
		} else {
			email_entreprise.removeClass("ok");
			email_entreprise.addClass("error");
			
			email_entrepriseInfo.text("Adresse email non valide");
			email_entrepriseInfo.removeClass("ok");
			email_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validateSiteEntreprise() {
		var a = $("#site_entreprise").val();
		var filter = /^http:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}$/;
		
		if(filter.test(a)) { //valide
			site_entreprise.removeClass("error");
			site_entreprise.addClass("ok");
			
			site_entrepriseInfo.text("Valide");
			site_entrepriseInfo.removeClass("error");
			site_entrepriseInfo.addClass("ok");
			return true;
		} else if(site_entreprise.val().length == 0) { // Valide car non obligatoire
			site_entreprise.removeClass("error");
			site_entreprise.removeClass("ok");
			
			site_entrepriseInfo.text("");
			site_entrepriseInfo.removeClass("error");
			site_entrepriseInfo.removeClass("ok");
			return true;
		} else {
			site_entreprise.removeClass("ok");
			site_entreprise.addClass("error");
			
			site_entrepriseInfo.text("URL non valide (http://)");
			site_entrepriseInfo.removeClass("ok");
			site_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validateAdresseEntreprise() {
		if(adresse_entreprise.val().length < 5) { // invalide
			adresse_entreprise.removeClass("ok");
			adresse_entreprise.addClass("error");
			
			adresse_entrepriseInfo.text("Minimum 5 caractères");
			adresse_entrepriseInfo.removeClass("ok");
			adresse_entrepriseInfo.addClass("error");
			return false;
		} else {
			adresse_entreprise.removeClass("error");
			adresse_entreprise.addClass("ok");
			
			adresse_entrepriseInfo.text("Valide");
			adresse_entrepriseInfo.removeClass("error");
			adresse_entrepriseInfo.addClass("ok");
			return true;
		}
	}
	
	function validateZIPCodeEntreprise() {
		var a = $("#zipCode_entreprise").val();
		var filter = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
		
		if(filter.test(a)) { //valide
			zipCode_entreprise.removeClass("error");
			zipCode_entreprise.addClass("ok");
			
			zipCode_entrepriseInfo.text("Valide");
			zipCode_entrepriseInfo.removeClass("error");
			zipCode_entrepriseInfo.addClass("ok");
			return true;
		} else {
			zipCode_entreprise.removeClass("ok");
			zipCode_entreprise.addClass("error");
			
			zipCode_entrepriseInfo.text("Code postal non valide");
			zipCode_entrepriseInfo.removeClass("ok");
			zipCode_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validateVilleEntreprise() {
		var a = $("#ville_entreprise").val();
		var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
		
		if(filter.test(a) & ville_entreprise.val().length > 0) { //valide
			ville_entreprise.removeClass("error");
			ville_entreprise.addClass("ok");
			
			ville_entrepriseInfo.text("Valide");
			ville_entrepriseInfo.removeClass("error");
			ville_entrepriseInfo.addClass("ok");
			return true;
		} else {
			ville_entreprise.removeClass("ok");
			ville_entreprise.addClass("error");
			
			ville_entrepriseInfo.text("Minimum 1 lettre");
			ville_entrepriseInfo.removeClass("ok");
			ville_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validatePhoneNumberEntreprise() {
		var a = $("#phoneNumber_entreprise").val();
		var filter = /^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
		
		if(filter.test(a)) { //valide
			phoneNumber_entreprise.removeClass("error");
			phoneNumber_entreprise.addClass("ok");
			
			phoneNumber_entrepriseInfo.text("Valide");
			phoneNumber_entrepriseInfo.removeClass("error");
			phoneNumber_entrepriseInfo.addClass("ok");
			return true;
		} else {
			phoneNumber_entreprise.removeClass("ok");
			phoneNumber_entreprise.addClass("error");
			
			phoneNumber_entrepriseInfo.text("Non valide");
			phoneNumber_entrepriseInfo.removeClass("ok");
			phoneNumber_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validateFaxEntreprise() {
		var a = $("#fax_entreprise").val();
		var filter = /^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
		
		if(filter.test(a)) { //valide
			fax_entreprise.removeClass("error");
			fax_entreprise.addClass("ok");
			
			fax_entrepriseInfo.text("Valide");
			fax_entrepriseInfo.removeClass("error");
			fax_entrepriseInfo.addClass("ok");
			return true;
		} else if(fax_entreprise.val().length == 0) { // Valide car non obligatoire
			fax_entreprise.removeClass("error");
			fax_entreprise.removeClass("ok");
			
			fax_entrepriseInfo.text("");
			fax_entrepriseInfo.removeClass("error");
			fax_entrepriseInfo.removeClass("ok");
			return true;
		} else {
			fax_entreprise.removeClass("ok");
			fax_entreprise.addClass("error");
			
			fax_entrepriseInfo.text("Non valide");
			fax_entrepriseInfo.removeClass("ok");
			fax_entrepriseInfo.addClass("error");
			return false;
		}
	}
	
	function validateMobilePhoneNumberEntreprise() {
		var a = $("#mobilePhoneNumber_entreprise").val();
		var filter = /^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
		
		if(filter.test(a)) { //valide
			mobilePhoneNumber_entreprise.removeClass("error");
			mobilePhoneNumber_entreprise.addClass("ok");
			
			mobilePhoneNumber_entrepriseInfo.text("Valide");
			mobilePhoneNumber_entrepriseInfo.removeClass("error");
			mobilePhoneNumber_entrepriseInfo.addClass("ok");
			return true;
		} else if(mobilePhoneNumber_entreprise.val().length == 0) { // Valide car non obligatoire
			mobilePhoneNumber_entreprise.removeClass("error");
			mobilePhoneNumber_entreprise.removeClass("ok");
			
			mobilePhoneNumber_entrepriseInfo.text("");
			mobilePhoneNumber_entrepriseInfo.removeClass("error");
			mobilePhoneNumber_entrepriseInfo.removeClass("ok");
			return true;
		} else {
			mobilePhoneNumber_entreprise.removeClass("ok");
			mobilePhoneNumber_entreprise.addClass("error");
			
			mobilePhoneNumber_entrepriseInfo.text("Non valide");
			mobilePhoneNumber_entrepriseInfo.removeClass("ok");
			mobilePhoneNumber_entrepriseInfo.addClass("error");
			return false;
		}
	}
});