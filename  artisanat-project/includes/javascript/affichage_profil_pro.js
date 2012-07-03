$(document).ready(function() {
	var timeline = new VMM.Timeline();
	timeline.init("data.json");	

	/*getChantiersFromEntreprise(treat);
	
	function getChantiersFromEntreprise(treat) {
		var request = getXMLHttpRequest();
		
		request.onreadystatechange = function() {
			if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
				treat(request.responseText);
			}
		};
		
		request.open("POST", "modules/membre/traitement/get_ChantiersFromEntreprise.php", true);
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send("email=" + "coucou");
	}

	function treat(sData) {
		alert(sData);
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
	}*/
});