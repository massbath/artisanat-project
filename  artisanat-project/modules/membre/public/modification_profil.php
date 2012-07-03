<?php
	if ($_SESSION['logged'] == true) {
		?>
		<link type="text/css" rel="stylesheet" href="theme/css/formulaireModificationProfil.css" media="screen" />
		<script type="text/javascript" src="includes/javascript/validationFormulaireModificationProfil.js" language="JavaScript"></script>
		
		<!-- formulaire d'enregistrement d'une personne sur le site -->
		<div id="inscription">			
			<?php
				//on regarde si la personne ne vient pas d'essayer de s'enregistrer, si c'est le cas on la prévient si cela a fonctionné ou pas, en lui donnant les raisons.
				if(isset($_SESSION['modif_p'])) {
					echo '<div id='.$_SESSION['error'].'>';
					echo $_SESSION['modif_p'];
					echo '</div>';
					unset($_SESSION['error']);
					unset($_SESSION['modif_p']);
				}
			?>
			<h3>Modification des informations du profil</h3>
			<form method="POST" enctype="application/x-www-form-urlencoded" action="modules/membre/traitement/verif_modification_profil.php" onsubmit="return valider()" name="formulaireModificationProfil" id="formulaireModificationProfil">
				<p>(*) Champ obligatoire</p>
				<br/>
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
						<p>
							<input type="checkbox" name="condition" id="condition" /> Assurez-vous de bien avoir consulté les <a href="javascript:popup('modules/membre/public/conditions.php')">conditions générales</a> du site.
						</p>
					</td>
				</tr>
				<tr>
				<td colspan='2'>
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
						   validateEmail() && 
						   validateAddress() && validateZIPCode() && 
						   validateCity() && validatePhoneNumber() && 
						   validateMobilePhoneNumber() && validateBirthDay() && 
						   validateEmailFree()) {
						   
							return true;
						} else if(!validateCaptcha()) {
							alert("Captcha mal saisi");
							return false;
						} else if(!validateEmailFree()) {
							alert("Adresse email non valide ou déjà utilisée");
							return false;
						} else if(!validatePhoneNumber()){
							document.formulaireModificationProfil.phoneNumber.value = "";
							return true;
						} else if(!validateMobilePhoneNumber()){
							document.formulaireModificationProfil.mobilePhoneNumber.value = "";
							return true;
						} else {
							alert("Veuillez renseigner tous les champs obligatoires");
							return false;
						}
					}
					
					function validateName() {
						var a = document.formulaireModificationProfil.name.value;
						var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
						
						if(filter.test(a) && a.length > 1) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validateFirstname() {
						var a = document.formulaireModificationProfil.firstname.value;
						var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
						
						if(filter.test(a) && a.length > 1) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validateEmail() {
						var a = document.formulaireModificationProfil.email.value;
						var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
						
						if(filter.test(a)) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validateAddress() {
						if(document.formulaireModificationProfil.address.value.length < 5) { // invalide
							return false;
						} else {
							return true;
						}
					}
					
					function validateZIPCode() {
						var a = document.formulaireModificationProfil.zipCode.value;
						var filter = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
						
						if(filter.test(a)) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validateCity() {
						var a = document.formulaireModificationProfil.city.value;
						var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
						
						if(filter.test(a) & a.length > 0) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validatePhoneNumber() {
						var a = document.formulaireModificationProfil.phoneNumber.value;
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
						var a = document.formulaireModificationProfil.mobilePhoneNumber.value;
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
						var a = document.formulaireModificationProfil.birthDay.value;
						var filter = /^([0-2]{1}[0-9]{1}|[3]{1}[0-1]{1})\/(0[1-9]{1}|1[0-2]{1})\/[0-9]{4}$/;
						
						if(a.length == 0) {
							return false;
						} else if(filter.test(a)) { //valide
							return true;
						} else {
							return false;
						}
					}
					
					function validateEmailFree() {
						var a = document.formulaireModificationProfil.hiddenEmailState.value;
												
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