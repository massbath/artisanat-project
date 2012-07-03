$(document).ready(function() {
	//global vars
	//serialisation des varaiables avec les controle du formualaire en utilisant les id
	var form = $("#formulaire_contact");
	
	var email = $("#email2");
	var emailInfo = $("#emailInfo2");
	
	var object = $("#object");
	var objectInfo = $("#objectInfo");
	
	var message  = $("#message");
	var messageInfo = $("#messageInfo");
	
	//association des fonctions avec les variables
	//On blur
	email.blur(validateEmail);
	object.blur(validateObject);
	message.blur(validateMessage);
	
	//On key press
	email.keyup(validateEmail);
	object.keyup(validateObject);
	message.keyup(validateMessage);
	
	//On Submitting the form
	form.submit(function() {
		if( validateEmail() & validateObject() & validateMessage()) {
			alert("Votre message a bien été envoyé");
			return true;
		} else {		
			alert("Un ou plusieurs des champs n'est/ne sont  pas correct(s)");
			return false;
		}
	});
	
	//validation functions
	function validateEmail() {
		//testing regular expression
		var a = $("#email2").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		if(email.val().length < 2) {
			email.addClass("error");
			emailInfo.text("Type a email please");
			emailInfo.addClass("error");
			return false;	
		
		}
		//if it's valid email
		if(filter.test(a)) {
			email.removeClass("error");
			email.addClass("ok");
			emailInfo.text("Valid E-mail please");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else {
			email.addClass("error");
			emailInfo.text("Type a email please");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	//to validate the object
	function validateObject() {
		var a = $("object").val();

		if (object.val().length < 5) {
			objectInfo.text("L'objet de votre message est trop court");
			objectInfo.removeClass("ok");
			objectInfo.addClass("error");
			object.removeClass("ok");
			object.addClass("error");
			return false;
		} else { 
			object.removeClass("error");
			object.addClass("ok");
			objectInfo.text("Objet accepté");
			objectInfo.removeClass("error");
			objectInfo.addClass("ok");
			return true;
		}
	}
	
	//to validate the message
	function validateMessage() {
		if(message.val().length < 20) {
			messageInfo.text("Votre message est trop court");
			messageInfo.removeClass("ok");
			messageInfo.addClass("error");
			message.removeClass("ok");
			message.addClass("error");
			return false;
		} else {
			messageInfo.text("Message accepté");
			messageInfo.removeClass("error");
			messageInfo.addClass("ok");
			message.removeClass("error");
			message.addClass("ok");
			return true;
		}
	}
});