<!-- Affichage du formulaire de login -->
<?php 
if(isset($_GET['erreur']))
{
	if(isset($_SESSION['login']))
	{
		echo '<div id='.$_SESSION['error'].'>';
		echo $_SESSION['login'];
		unset ($_SESSION['login']);
		unset($_SESSION['error']);
		echo '</div>';
	}
}
if(isset($_GET['erreur']) && $_GET['erreur']!="no")
{
?>
<div id="connexion">

<form method="post" action="modules/membre/traitement/verif_connexion.php?<?php if(isset($_GET['page'])) echo '&page='.$_GET['page'];?>" name="connexion">
<table cellpadding="0" cellspacing="0" cols="2" width='400'>
	<tr>
		<td colspan="2">
			<div id="titre_login">Se Connecter</div>
		<td>
	</tr>
	<tr>
		<td style='text-align:center;width:40%; padding-top:5px;'>
			<label>E-Mail</label>
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
	<tr>
	<tr >
		<td colspan="2" style="text-align:center; padding-top:3px;">
			<input type="submit" name="connexion" value="Connexion" id="input" />
			
		</td>
	</tr>	
</table>
</form>

<div class="link">
	<a href="index.php?page=inscription" title="Inscrivez-vous">Pas encore inscrit ?</a><br />
	<a href="index.php?page=mdpperdu" title="Mot de passe perdu">Mot de passe oublié ?</a>
	<?php
		if(isset($_GET['erreur']) && $_GET['erreur']=='act')
		{
			echo '<br /><a href="index.php?page=envoi_code_activation" title="Envoi code d\'activation">Renvoi du code d\'activation</a>';
		}
	?>
</div>
</div>
<!-- Fin d'affichage du formulaire de login -->
<?php
}
?>