<?php
if ($_SESSION['logged'] == false) 
{ 
?>
<!-- Affichage du formulaire d'inscription -->
<div id="inscription">
<fieldset><legend>Inscription</legend>
<form method="post" action="">
<table cellpadding="0" cellspacing="1">
<tr>
	<td>
		Nom
	</td><td>
		<input type="text" name="nom"/>
	</td>
</tr>
<tr>
	<td>
		Prénom
	</td><td>
		<input type="text" name="prenom"/>
	</td>
</tr>
<tr>
	<td>
		Adresse E-Mail
	</td><td>
		<input type="text" name="email"/>
	</td>
</tr>
<tr>
	<td>
		Retaper l'adresse E-Mail
	</td><td>
		<input type="text" name="email_bis"/>
	</td>
</tr>
<tr>
	<td>
		Mot de passe
	</td><td>
		<input type="password" name="mdpasse"/>
	</td>
</tr>
<tr>
	<td>
		Retaper le Mot de passe
	</td><td>
		<input type="password" name="mdpasse_bis"/>
	</td>
</tr>
<tr>
	<td>
		Sexe
	</td><td>
		<select name="sexe" class="select">
			<option value="1">Homme</option>
			<option value="2">Femme</option>
		</select>
	</td>
</tr>
<tr>
	<td>
		Adresse
	</td><td>
		<input type="text" name="adresse"/>
	</td>
</tr>
<tr>
	<td>
		Code Postal
	</td><td>
		<input type="text" name="code_postal"/>
	</td>
</tr>
<tr>
	<td>
		Ville
	</td><td>
		<input type="text" name="ville"/>
	</td>
</tr>
<tr>
	<td>
		Pays
	</td><td>
		<input type="text" name="pays"/>
	</td>
</tr>         
</table>
<input type="submit" value="Créer mon compte" name="register" />
</div>

</form>            
</fieldset>
<!-- Fin d'affichage du formulaire d'inscription -->

<?php
}
else
{
?>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php"> 
<?php
}
?>