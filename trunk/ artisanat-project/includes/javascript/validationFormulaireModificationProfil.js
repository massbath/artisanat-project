$(document).ready(function() {
	// Récupère les données utilisateur en base
	getDataUser(treatDataUser);
	
	// lance la récupération des données utilisateur en appelant get_DataUser.php
	function getDataUser(treatDataUser) {
		var xhr = getXMLHttpRequest();
		
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				treatDataUser(xhr.responseText);
			}
		};
		
		xhr.open("GET", "modules/membre/traitement/get_DataUser.php", true);
		xhr.send(null);
	}

	// traite les données utilisateur récupérées
	function treatDataUser(sData) {
		var data = sData.split('|');
		
		document.getElementById('email').value = data[0];
		document.getElementById('name').value = data[1];
		document.getElementById('firstname').value = data[2];
		
		var date = data[3].split('-');
		var goodDate = date[2] + "/" +date[1] + "/" + date[0];
		document.getElementById('birthDay').value = goodDate;
		
		if(data[4] == "m") {
			document.getElementById('civilite').selectedIndex = 0;
		} else if(data[4] == "f") {
			document.getElementById('civilite').selectedIndex = 1;
		}
		
		document.getElementById('address').value = data[5];
		document.getElementById('zipCode').value = data[6];
		document.getElementById('city').value = data[7];
		document.getElementById('phoneNumber').value = data[8];
		document.getElementById('mobilePhoneNumber').value = data[9];
		
		
		// Demande la validation de tous les champs
		validateName();
		validateFirstname();
		validateEmail();
		validateAddress();
		validateZIPCode();
		validateCity();
		validatePhoneNumber();
		validateMobilePhoneNumber();
	}
	
	
	
	var form = $("#formulaireModificationProfil");
	
	var name = $("#name");
	var nameInfo = $("#nameInfo");
	
	var firstname = $("#firstname");
	var firstnameInfo = $("#firstnameInfo");
	
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	
	var address = $("#address");
	var addressInfo = $("#addressInfo");
	
	var zipCode = $("#zipCode");
	var zipCodeInfo = $("#zipCodeInfo");
	
	var city = $("#city");
	var cityInfo = $("#cityInfo");
	
	var phoneNumber = $("#phoneNumber");
	var phoneNumberInfo = $("#phoneNumberInfo");
	
	var mobilePhoneNumber = $("#mobilePhoneNumber");
	var mobilePhoneNumberInfo = $("#mobilePhoneNumberInfo");
	
	var birthDay = $("#birthDay");
	
	var condition = $("#condition");
	
	
	
	var myDate = new Date(); 
	
	// Initialise birthDay comme JQuery datepicker
	birthDay.datepicker({ showAnim: "drop", 
							  showButtonPanel: true, 
							  showOtherMonths: true, 
							  changeMonth: true, 
							  changeYear: true, 
							  yearRange: "1900:" + myDate.getFullYear(),
							  firstDay: 1});
	
	// lance isEmailAlreadyUsed.php pour savoir si l'email entré dans le formulaire est déjà en base
	function isEmailAlreadyUsed(treatEmailState) {
		var request = getXMLHttpRequest();
		
		request.onreadystatechange = function() {
			if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
				treatEmailState(request.responseText);
			}
		};
		
		request.open("POST", "modules/membre/traitement/isEmailAlreadyUsed.php", true);
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send("email=" + document.formulaireModificationProfil.email.value);
	}

	// récupère l'état du mail entré, met à jour l'état graphique de l'input email
	function treatEmailState(sData) {
		document.getElementById('hiddenEmailState').value = sData;
		
		if(sData == "true") { // l'adresse est déjà dans la base
			email.removeClass("ok");
			email.addClass("error");
			
			emailInfo.text("Adresse email déjà utilisée");
			emailInfo.removeClass("ok");
			emailInfo.addClass("error");
		} else if(sData == "false") {
			email.removeClass("error");
			email.addClass("ok");
			
			emailInfo.text("Valide");
			emailInfo.removeClass("error");
			emailInfo.addClass("ok");
		}
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
						  	
	//On blur
	name.blur(validateName);
	firstname.blur(validateFirstname);
	email.blur(validateEmail);
	address.blur(validateAddress);
	zipCode.blur(validateZIPCode);
	city.blur(validateCity);
	phoneNumber.blur(validatePhoneNumber);
	mobilePhoneNumber.blur(validateMobilePhoneNumber);
	
	//On key press
	name.keyup(validateName);
	firstname.keyup(validateFirstname);
	email.keyup(validateEmail);
	address.keyup(validateAddress);
	zipCode.keyup(validateZIPCode);
	city.keyup(validateCity);
	phoneNumber.keyup(validatePhoneNumber);
	mobilePhoneNumber.keyup(validateMobilePhoneNumber);
	
	function validateName() {
		var a = $("#name").val();
		var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
		
		if(filter.test(a) && name.val().length > 1) { //valide
			name.removeClass("error");
			name.addClass("ok");
			
			nameInfo.text("Valide");
			nameInfo.removeClass("error");
			nameInfo.addClass("ok");
			return true;
		} else {
			name.removeClass("ok");
			name.addClass("error");
			
			nameInfo.text("Minimum 2 lettres");
			nameInfo.removeClass("ok");
			nameInfo.addClass("error");			
			return false;
		}
	}
	
	function validateFirstname() {
		var a = $("#firstname").val();
		var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
		
		if(filter.test(a) && firstname.val().length > 1) { //valide
			firstname.removeClass("error");
			firstname.addClass("ok");
			
			firstnameInfo.text("Valide");
			firstnameInfo.removeClass("error");
			firstnameInfo.addClass("ok");
			return true;
		} else {
			firstname.removeClass("ok");
			firstname.addClass("error");
			
			firstnameInfo.text("Minimum 2 lettres");
			firstnameInfo.removeClass("ok");
			firstnameInfo.addClass("error");			
			return false;
		}
	}
	
	function validateEmail() {
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		if(filter.test(a)) { //valide	
			// si l'email entré correspond à la regex, on interroge la base pour savoir s'il est disponible
			isEmailAlreadyUsed(treatEmailState);			
			
			return true;
		} else {
			email.removeClass("ok");
			email.addClass("error");
			
			emailInfo.text("Adresse email non valide");
			emailInfo.removeClass("ok");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validateAddress() {
		if(address.val().length < 5) { // invalide
			address.removeClass("ok");
			address.addClass("error");
			
			addressInfo.text("Minimum 5 caractères");
			addressInfo.removeClass("ok");
			addressInfo.addClass("error");
			return false;
		} else {
			address.removeClass("error");
			address.addClass("ok");
			
			addressInfo.text("Valide");
			addressInfo.removeClass("error");
			addressInfo.addClass("ok");
			return true;
		}
	}
	
	function validateZIPCode() {
		var a = $("#zipCode").val();
		var filter = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
		
		if(filter.test(a)) { //valide
			zipCode.removeClass("error");
			zipCode.addClass("ok");
			
			zipCodeInfo.text("Valide");
			zipCodeInfo.removeClass("error");
			zipCodeInfo.addClass("ok");
			return true;
		} else {
			zipCode.removeClass("ok");
			zipCode.addClass("error");
			
			zipCodeInfo.text("Code postal non valide");
			zipCodeInfo.removeClass("ok");
			zipCodeInfo.addClass("error");
			return false;
		}
	}
	
	function validateCity() {
		var a = $("#city").val();
		var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
		
		if(filter.test(a) & city.val().length > 0) { //valide
			city.removeClass("error");
			city.addClass("ok");
			
			cityInfo.text("Valide");
			cityInfo.removeClass("error");
			cityInfo.addClass("ok");
			return true;
		} else {
			city.removeClass("ok");
			city.addClass("error");
			
			cityInfo.text("Minimum 1 lettre");
			cityInfo.removeClass("ok");
			cityInfo.addClass("error");
			return false;
		}
	}
	
	function validatePhoneNumber() {
		var a = $("#phoneNumber").val();
		var filter = /^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
		
		if(filter.test(a)) { //valide
			phoneNumber.removeClass("error");
			phoneNumber.addClass("ok");
			
			phoneNumberInfo.text("Valide");
			phoneNumberInfo.removeClass("error");
			phoneNumberInfo.addClass("ok");
			return true;
		} else if(phoneNumber.val().length == 0) { // valide car non obligatoire
			phoneNumber.removeClass("error");
			phoneNumber.removeClass("ok");
			
			phoneNumberInfo.text("");
			phoneNumberInfo.removeClass("error");
			phoneNumberInfo.removeClass("ok");
			return true;
		} else {
			phoneNumber.removeClass("ok");
			phoneNumber.addClass("error");
			
			phoneNumberInfo.text("Non valide");
			phoneNumberInfo.removeClass("ok");
			phoneNumberInfo.addClass("error");
			return false;
		}
	}
	
	function validateMobilePhoneNumber() {
		var a = $("#mobilePhoneNumber").val();
		var filter = /^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
		
		if(filter.test(a)) { //valide
			mobilePhoneNumber.removeClass("error");
			mobilePhoneNumber.addClass("ok");
			
			mobilePhoneNumberInfo.text("Valide");
			mobilePhoneNumberInfo.removeClass("error");
			mobilePhoneNumberInfo.addClass("ok");
			return true;
		} else if(mobilePhoneNumber.val().length == 0) { // Valide car non obligatoire
			mobilePhoneNumber.removeClass("error");
			mobilePhoneNumber.removeClass("ok");
			
			mobilePhoneNumberInfo.text("");
			mobilePhoneNumberInfo.removeClass("error");
			mobilePhoneNumberInfo.removeClass("ok");
			return true;
		} else {
			mobilePhoneNumber.removeClass("ok");
			mobilePhoneNumber.addClass("error");
			
			mobilePhoneNumberInfo.text("Non valide");
			mobilePhoneNumberInfo.removeClass("ok");
			mobilePhoneNumberInfo.addClass("error");
			return false;
		}
	}
});