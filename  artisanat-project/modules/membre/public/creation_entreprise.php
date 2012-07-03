<?php
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
	?>
	<link type="text/css" rel="stylesheet" href="theme/css/formulaireCreationEntreprise.css" media="screen" />
	<script type="text/javascript" src="includes/javascript/validationFormulaireCreationEntreprise.js" language="JavaScript"></script>
	
	<?php
		//on regarde si la personne ne vient pas d'essayer de créer une entreprise, si c'est le cas on la prévient si cela a fonctionné ou pas, en lui donnant les raisons.
		if(isset($_SESSION['crea_ent'])) {
			echo '<div id='.$_SESSION['error'].'>';
			echo $_SESSION['crea_ent'];
			echo '</div>';
			unset($_SESSION['error']);
			unset($_SESSION['crea_ent']);
		}
	?>
	
	<!-- formulaire d'enregistrement d'une entreprise sur le site -->
	<div id="creation_entreprise">	
		<h3>Formulaire de création d'entreprise</h3>
		<form method="POST" enctype="application/x-www-form-urlencoded" action="modules/membre/traitement/verif_creation_entreprise.php" onsubmit="return valider()" name="formulaireCreationEntreprise" id="formulaireCreationEntreprise">
			<br/>
			<p>(*) Champ obligatoire</p>
			<br/>
			
			<table cellpadding="0" cellspacing="0" cols="2" style="text-align:left;">
				<tr>
					<td>
						<label for="denomination">Dénomination sociale (*)</label>
					</td>
					<td>
						<select name="denomination" id="denomination" class="selectyze">
							<option value="SARL">SARL</option>
							<option value="EURL">EURL</option>
							<option value="SA">SA</option>
							<option value="SAS">SAS</option>
							<option value="SNC">SNC</option>
						</select>
					</td>
				</tr>	
				
				<tr>
					<td>
						<label for="nom_entreprise">Nom (*)</label>
					</td>
					<td>
						<input id="nom_entreprise" name="nom_entreprise" type="text"/>
						<span id="nom_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="siret_entreprise">Numéro de siret (*)</label>
					</td>
					<td>
						<input id="siret_entreprise" name="siret_entreprise" type="text"/>
						<span id="siret_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="email_entreprise">E-mail (*)</label>
					</td>
					<td>
						<input id="email_entreprise" name="email_entreprise" type="text" size='30' />
						<span id="email_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="site_entreprise">Sie internet</label>
					</td>
					<td>
						<input id="site_entreprise" name="site_entreprise" type="text" size='35' />
						<span id="site_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="adresse_entreprise">Adresse (*)</label>
					</td>
					<td>
						<input id="adresse_entreprise" name="adresse_entreprise" type="text" size='50' />
						<span id="adresse_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="zipCode_entreprise">Code postal (*)</label>
					</td>
					<td>
						<input id="zipCode_entreprise" name="zipCode_entreprise" type="text" size="7" />
						<span id="zipCode_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="ville_entreprise">Ville (*)</label>
					</td>
					<td>
						<input id="ville_entreprise" name="ville_entreprise" type="text"/>
						<span id="ville_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="phoneNumber_entreprise">Téléphone (*)</label>
					</td>
					<td>
						<input id="phoneNumber_entreprise" name="phoneNumber_entreprise" type="text" size="15" />
						<span id="phoneNumber_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="fax_entreprise">Fax</label>
					</td>
					<td>
						<input id="fax_entreprise" name="fax_entreprise" type="text" size="15" />
						<span id="fax_entrepriseInfo"></span>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="mobilePhoneNumber_entreprise">Téléphone mobile</label>
					</td>
					<td>
						<input id="mobilePhoneNumber_entreprise" name="mobilePhoneNumber_entreprise" type="text" size="15" />
						<span id="mobilePhoneNumber_entrepriseInfo"></span>
					</td>
				</tr>
			
			<input id="hiddenSiretState" name="hiddenSiretState" type="hidden" value ="false" />
			
			<tr>
				<td colspan="2" style="text-align:center; padding-top:20px;">
					<input id="send_creation_entreprise" name="send_creation_entreprise" type="submit" value="Création de l'entreprise"/>
				</td>
			</tr>
			
			</table>
			
			<script language="JavaScript">			
				function valider() {						
					if(validateNomEntreprise() && validateSiret() &&
					   validateEmail() && validateSite() &&
					   validateAddress() && validateZIPCode() && 
					   validateCity() && validatePhoneNumber() && 
					   validateFax() && validateMobilePhoneNumber() &&
					   validateSiretFree()) {
					   
						return true;
					} else if(!validateSiretFree()) {
						alert("Numéro de siret non valide ou déjà utilisé");
						return false;
					} else {
						alert("Veuillez renseigner tous les champs obligatoires");
						return false;
					}
				}
				
				function validateNomEntreprise() {
					var a = document.formulaireCreationEntreprise.nom_entreprise.value;
					
					if(a.length > 2) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateSiret() {
					var a = document.formulaireCreationEntreprise.siret_entreprise.value;
					var filter = /[0-9]{14}/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateEmail() {
					var a = document.formulaireCreationEntreprise.email_entreprise.value;
					var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateSite() {
					var a = document.formulaireCreationEntreprise.site_entreprise.value;
					var filter = /^http:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else if(a.length == 0) { // valide car non obligatoire
						return true;
					} else {
						return false;
					}
				}
				
				function validateAddress() {
					if(document.formulaireCreationEntreprise.adresse_entreprise.value.length < 5) { // invalide
						return false;
					} else {
						return true;
					}
				}
				
				function validateZIPCode() {
					var a = document.formulaireCreationEntreprise.zipCode_entreprise.value;
					var filter = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateCity() {
					var a = document.formulaireCreationEntreprise.ville_entreprise.value;
					var filter = /^[\sa-zA-Zéèêëàâîïôöûü-]+$/;
					
					if(filter.test(a) & a.length > 0) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validatePhoneNumber() {
					var a = document.formulaireCreationEntreprise.phoneNumber_entreprise.value;
					var filter = /^(0[1-58][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else {
						return false;
					}
				}
				
				function validateFax() {
					var a = document.formulaireCreationEntreprise.fax_entreprise.value;
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
					var a = document.formulaireCreationEntreprise.mobilePhoneNumber_entreprise.value;
					var filter = /^(0[67][-.\s]?(\d{2}[-.\s]?){3}\d{2})$/;
					
					if(filter.test(a)) { //valide
						return true;
					} else if(a.length == 0) { // Valide car non obligatoire
						return true;
					} else {
						return false;
					}
				}
				
				function validateSiretFree() {
					var a = document.formulaireCreationEntreprise.hiddenSiretState.value;
											
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