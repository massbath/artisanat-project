<?php//Si l'utilisateur n'est pas loggedif ($_SESSION['logged'] == false) {	if(isset($_SESSION['code_activation']))	{		echo '<p id="'.$_SESSION['error'].'">';		echo $_SESSION['code_activation'];		unset($_SESSION['code_activation']);		unset($_SESSION['error']);		echo '</p>';			}else{	?>	<div id="mdpperdu">			<form method="POST" action="modules/membre/traitement/verif_envoi_code_activation.php" name="inscription" enctype="application/x-www-form-urlencoded">			<fieldset>				<legend> Renvoi du code d'activation</legend>				<table cellpadding="0" cellspacing="0" cols="2" style="margin:5px 0 0 10px;">					<tr>						<td>							<label>Votre adresse E-mail</label>						</td>						<td>							<input name="mail" id="input" size='50' type="text" value="">						</td>					</tr>					<tr>						<td colspan="2">							<input type="submit" id="input" name="Renvoi du code d'activation" value="Valider">						</td>					</tr>				</table>			</fieldset>		</form>	</div>	<?php	}}else{	// Si l'utilisateur est d�j� logged alors on lui dit	?> 		<p id='error'> Vous �tes d�j� connect� </p>	<?php}?>