<?php
if ($_SESSION['logged'] == false) {
	?>
	<link type="text/css" rel="stylesheet" href="theme/css/formulaireInscription.css" media="screen" />
	<script type="text/javascript" src="includes/javascript/validationFormulaireInscription.js" language="JavaScript"></script>
	
	<?php
		//on regarde si la personne ne vient pas d'essayer de s'enregistrer, si c'est le cas on la prévient si cela a fonctionné ou pas, en lui donnant les raisons.
		if(isset($_SESSION['enr'])) {
			echo '<div id='.$_SESSION['error'].'>';
			echo $_SESSION['enr'];
			echo '</div>';
			unset($_SESSION['error']);
			unset($_SESSION['enr']);
		}
		
		//est-ce que le visiteur est arrivé via la page d'acceuil
		if(isset($_GET['statut'])) {
			if($_GET['statut']=='pro')
			{
				$_SESSION['demande_enr']="pro";
			}elseif($_GET['statut']=='part'){
				$_SESSION['demande_enr']="part";
			}
		}
	?>
		
	<!-- formulaire d'enregistrement d'une personne sur le site -->
	<div id="inscription">
		<h3>Formulaire d'inscription</h3>
		<p style='text-align:left;'>S'inscrire et créer un compte sur notre site c'est gratuit.<br/>
		Cela vous permet de :<br/>
		- Remplir ses informations personnelles<br/>
		- Commenter les articles et actualités du site<br/>
		- Créer des appels d'offres<br/>
		- ...</p><br/>
		<p>(*) Champ obligatoire</p>
		<br/>
		<form method="POST" enctype="application/x-www-form-urlencoded" action="modules/membre/traitement/verif_enr.php" onsubmit="return valider()" name="formulaireinscription" id="formulaireinscription">
			
			<table cellpadding="0" cellspacing="0" cols="2" style="text-align:left;">
				<tr>
					<td>
						<label for="civilite">Civilité</label>
					</td>
					<td>
						<select name="civilite" id="civilite" class="selectyze">
							<option value="m">Monsieur</option>
							<option value="f">Madame</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="name">Nom (*)</label>
					</td>
					<td>
						<input id="name" name="name" type="text"/>
						<span id="nameInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="firstname">Prénom (*)</label>
					</td>
					<td>
						<input id="firstname" name="firstname" type="text"/>
						<span id="firstnameInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="pass1">Mot de passe (*)</label>
					</td>
					<td>
						<input id="pass1" name="pass1" type="password" />
						<span id="pass1Info"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="pass2">Confirmer mot de passe (*)</label>
					</td>
					<td>
						<input id="pass2" name="pass2" type="password" />
						<span id="pass2Info"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="email">E-mail (*)</label>
					</td>
					<td>
						<input id="email" name="email" type="text" size='30' />
						<span id="emailInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="address">Adresse (*)</label>
					</td>
					<td>
						<input id="address" name="address" type="text" size='50' />
						<span id="addressInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="zipCode">Code postal (*)</label>
					</td>
					<td>
						<input id="zipCode" name="zipCode" type="text" size="7" />
						<span id="zipCodeInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="city">Ville (*)</label>
					</td>
					<td>
						<input id="city" name="city" type="text"/>
						<span id="cityInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="phoneNumber">Téléphone fixe</label>
					</td>
					<td>
						<input id="phoneNumber" name="phoneNumber" type="text" size="15" />
						<span id="phoneNumberInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="mobilePhoneNumber">Téléphone mobile</label>
					</td>
					<td>
						<input id="mobilePhoneNumber" name="mobilePhoneNumber" type="text" size="15"/>
						<span id="mobilePhoneNumberInfo"></span>
					</td>
				</tr>

				<tr>
					<td>
						<label for="birthDay">Date de naissance (*)</label>
					</td>
					<td>
						<input type="text" name="birthDay" id="birthDay" size="12" />
					</td>
				</tr>

				<tr>
					<td colspan='2'>
						<div id="captcha-wrap">
							<div class="captcha-box">
								<img src="" alt="" id="captcha" />
							</div>
							<div class="text-box">
								<label>Veuillez recopier :</label>
								<input name="captchaCode" type="text" id="captchaCode">
							</div>
							<div class="captcha-action">
								<img src="theme/captcha/refresh.jpg"  alt="" id="captcha-refresh" />
							</div>
						</div>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'>
						<p>
							<input type="checkbox" name="condition" id="condition" /> Assurez-vous de bien avoir consulté les <a href="javascript:popup('modules/membre/public/conditions.php')">conditions générales</a> du site.
						</p>
					</td>
				</tr>
				<tr>
				<td colspan='2'>
				<input id="useless" name="useless" type="hidden" />
				<input id="hiddenEmailState" name="hiddenEmailState" type="hidden" />
				</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input id="send" name="send" type="submit" value="Inscription"/>
					</td>
				</tr>

			</table>
			<script language="JavaScript">			
				function valider() {	
					if(validateName() && validateFirstname() && 
					   validatePasswords() && validateEmail() && 
					   validateAddress() && validateZIPCode() && 
					   validateCity() && validatePhoneNumber() && 
					   validateMobilePhoneNumber() && validateBirthDay() && 
					   validateCaptcha() && validateCondition() &&
					   validateEmailFree()) {
					   
						return true;
					} else if(!validateCondition()) {
						alert("Veuillez accepter les conditions générales du site");
						return false;
					} else if(!validateCaptcha()) {
						alert("Captcha mal saisi");
						return false;
					} else if(!validateEmailFree()) {
						alert("Adresse email non valide ou déjà utilisée");
						return false;
					} else {
						alert("Veuillez renseigner tous les champs obligatoires");
						return false;
					}
				}
				
				function validateName() {
					var a = document.formulaireinscription.name.value;
					var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
					
					if(filter.test(a) && a.length > 1) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateFirstname() {
					var a = document.formulaireinscription.firstname.value;
					var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
					
					if(filter.test(a) && a.length > 1) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validatePasswords() {
					var a = document.formulaireinscription.pass1.value;
					var b = document.formulaireinscription.pass2.value;
					
					if(a.length > 5 && a == b && b != "") { // invalide
						return true;
					} else {
						return false;
					}
				}
				
				function validateEmail() {
					var a = document.formulaireinscription.email.value;
					var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateAddress() {
					if(document.formulaireinscription.address.value.length < 5) { // invalide
						return false;
					} else {
						return true;
					}
				}
				
				function validateZIPCode() {
					var a = document.formulaireinscription.zipCode.value;
					var filter = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateCity() {
					var a = document.formulaireinscription.city.value;
					var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
					
					if(filter.test(a) & a.length > 0) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validatePhoneNumber() {
					var a = document.formulaireinscription.phoneNumber.value;
					var filter = /^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else if(a.length == 0) { // valide car non obligatoire
						return true;
					} else {
						return false;
					}
				}
				
				function validateMobilePhoneNumber() {
					var a = document.formulaireinscription.mobilePhoneNumber.value;
					var filter = /^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else if(a.length == 0) { // Valide car non obligatoire
						return true;
					} else {
						return false;
					}
				}
				
				function validateBirthDay() {
					var a = document.formulaireinscription.birthDay.value;
					var filter = /^([0-2]{1}[0-9]{1}|[3]{1}[0-1]{1})\/(0[1-9]{1}|1[0-2]{1})\/[0-9]{4}$/;
					
					if(a.length == 0) {
						return false;
					} else if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateCondition() {
					var a = document.formulaireinscription.condition.checked;
					
					if(a == true) {
						return true;
					} else {
						return false;
					}
				}
				
				function validateCaptcha() {
					var a = document.formulaireinscription.useless.value;
					
					var b = document.formulaireinscription.captchaCode.value;
					
					if(a == b) {
						return true;
					} else {
						return false;
					}
				}
				
				function validateEmailFree() {
					var a = document.formulaireinscription.hiddenEmailState.value;
											
					if(a == "false") { // le mail n'est pas en base
						return true;
					} else if(a == "true") {
						return false;
					}
				}
			</script>
		</form>
	</div>
	<?php
} else {
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">'; 
}
?>