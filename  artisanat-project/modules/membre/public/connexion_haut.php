<?php

if (isset($_POST['connexion']))
{
	if (!isset($_SESSION['logged'])) $_SESSION['logged'] = false;
	
	//Bouton connexion press�
	$username = (isset($_POST['username'])) ? $_POST['username'] : '';
	$mdpass  = (isset($_POST['mdpass']))  ? $_POST['mdpass']  : '';

	if (($username == "test") && ($mdpass == "123456"))
	{
		$_SESSION['logged'] = true;
		$_SESSION['username'] = $username;
	}
	else
	{
		//Message erreur
		
	}
}
if(isset($_SESSION['logged']) and $_SESSION['logged']==true)
{


}else{
?>

<!-- Affichage du formulaire de login -->
<div id="login">

<form method="post" action="">
<table cellpadding="0" cellspacing="0" cols="2">
	<tr>
		<td colspan="2">
			<div id="titre_login">Se Connecter</div>
		<td>
	</tr>
	<tr>
		<td>
			<label>Username</label>
		</td><td>
			<input type="text" name="username" id="input" />
		<td>
	</tr>
	<tr>
		<td>
			<label>Mot de passe</label>
		</td><td>
			<input type="password" name="mdpasse" id="input" />
		</td>
	<tr>
	<tr>
		<td colspan="2" align="center" style="padding-left:50px;">
			<input type="submit" name="connexion" value="Connexion" id="" />
			<a href="index.php?page=inscription" title="Inscrivez-vous">Pas encore inscrit ?</a>
		</td>
	</tr>
</table>
</form>

</div>
<!-- Fin d'affichage du formulaire de login -->

<?php
}
?>