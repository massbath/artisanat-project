<?php

if (isset($_POST['connexion']))
{
	if (!isset($_SESSION['logged'])) $_SESSION['logged'] = false;
	
	//Bouton connexion pressé
	$username = (isset($_POST['username'])) ? $_POST['username'] : '';
	$mdpasse  = (isset($_POST['mdpasse']))  ? $_POST['mdpasse']  : '';

	if (($username == "test") && ($mdpasse == 123456))
	{
		$_SESSION['logged'] = true;
		$_SESSION['username'] = $username;
	}
	else
	{
		//Message erreur et redirection à faire
		echo "Pas Bon";
	}
}
if(isset($_SESSION['logged']) && $_SESSION['logged']==true)
{
?>

<!-- Affichage quand connecté -->
<div id="login">
<div id="titre_login">Bonjour <?php echo $_SESSION['username']; ?></div>
<div><a href=""> Modifier mon profil</a></div>
<div><a href="index.php?page=deconnexion"> Déconnexion </a></div>
</div>
<!-- Fin d'affichage quand connecté -->

<?php
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