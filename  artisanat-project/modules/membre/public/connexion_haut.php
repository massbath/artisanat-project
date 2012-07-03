<?php
if(isset($_SESSION['logged']) && $_SESSION['logged']==true)
{
?>

<!-- Affichage quand connecté -->
<div id="login">
<div id="titre_login">Bonjour <?php echo $_SESSION['prenom']; ?></div>
<div><a href="index.php?page=modification_profil"> Modifier mes informations personnelles</a></div>
<div><a href="index.php?page=modif_pass"> Modifier mon mot de passe</a></div>
<div><a href="index.php?page=deconnexion"> Déconnexion </a></div>
</div>
<!-- Fin d'affichage quand connecté -->

<?php
}else{
?>

<!-- Affichage du formulaire de login -->
<div id="login">

<form method="post" action="modules/membre/traitement/verif_connexion.php?<?php if(isset($_GET['page'])) echo '&page='.$_GET['page'];?>" name="connexion">
<table cellpadding="0" cellspacing="0" cols="2" width='250'>
	<tr>
		<td colspan="2">
			<div id="titre_login">Se Connecter</div>
		<td>
	</tr>
	<tr>
		<td style='text-align:center; padding-top:5px;'>
			<label>Adresse E-Mail</label>
		</td><td>
			<input type="text" name="username" id="input" value="Votre E-mail" onfocus="if (this.value == 'Votre E-mail') this.value = '';" />
		<td>
	</tr>
	<tr>
		<td style='text-align:center; padding-top:5px;'>
			<label>Mot de passe</label>
		</td><td>
			<input type="password" name="mdpasse" id="input" value="*******" onfocus="if (this.value == '*******') this.value = '';" />
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center;">
			<input type="submit" id="input" name="connexion" value="Connexion" />
			
		</td>
	</tr>
	<tr>
		<td colspan='2' style="padding-top:5px;">
			<a href="index.php?page=inscription" title="Inscrivez-vous">Pas encore inscrit ?</a>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<a href="index.php?page=mdpperdu" title="Mot de passe perdu">Mot de passe oublié ?</a>
		</td>
	</tr>
</table>
</form>

</div>
<!-- Fin d'affichage du formulaire de login -->

<?php
}
?>