<?php
if ($_SESSION['logged'] == false) {
?>

<!-- formulaire d'enregistrement d'une personne sur le site -->
<h2 style="text-align: center;">Enregistrement</h2>
<p>S'inscrire et créer un compte sur notre site c'est gratuit.</p><br/>
<p>Cela vous permet de :</p>
<p>- Remplir ses informations personnelles<br/>
- Commenter les articles et actualités du site<br/>
- Créer des appeks d'offres<br/>
- ...
<?php
//on regarde si la personne ne vient pas d'essayer de s'enregistrer, si c'est le cas on la prévient si cela a fonctionné ou pas, en lui donnant les raisons.
if(isset($_SESSION['error'])){
	echo '<p style="color: '.$_SESSION['color'].';">';
	echo '<b>'.nl2br($_SESSION['error']).'</b>';
	echo '</p>';
	unset($_SESSION['error']);
	unset($_SESSION['color']);
}

?>
<!-- Pour chaque champ (sauf mot de pass) on réaffiche les données saisies par l'utilisateur si elles sont correct, en cas d'échec de l'enregistrement -->
<form method="POST" action="verif/verif_enr.php" name="inscription" enctype="application/x-www-form-urlencoded">
<fieldset><legend> Votre Nom (*)</legend>
	<p><input name="nom" type="text" value="<?php if(isset($_SESSION['enr_nom'])){ echo $_SESSION['enr_nom']; unset($_SESSION['enr_nom']);} ?>"></p></fieldset>
<fieldset><legend> Votre Prénom (*)</legend>
	<p><input name="prenom" type="text" value="<?php if(isset($_SESSION['enr_prenom'])){ echo $_SESSION['enr_prenom']; unset($_SESSION['enr_prenom']);} ?>"></p></fieldset>
<fieldset><legend> Votre Mot de passe (*)</legend>
	<p><input name="pass" type="password"></p></fieldset>
<fieldset><legend> Confirmation de votre Mot de passe (*)</legend>
	<p><input name="pass_bis" type="password"></p></fieldset>
<fieldset><legend> Votre Mail (**)</legend>
	<p><input name="mail" type="text" value="<?php if(isset($_SESSION['enr_mail'])){ echo $_SESSION['enr_mail']; unset($_SESSION['enr_mail']);} ?>"></p></fieldset>
<fieldset><legend> Votre Sexe </legend>
	<p><input type="radio" name="sexe" value="m" <?php if(isset($_SESSION['enr_sexe'])){if($_SESSION['enr_sexe']=="m"){echo "CHECKED"; unset($_SESSION['enr_sexe']);}} ?>>Homme <input type="radio" name="sexe" value="f" <?php if(isset($_SESSION['enr_sexe'])){if($_SESSION['enr_sexe']=="f"){echo "CHECKED"; unset($_SESSION['enr_sexe']);}} ?>>Femme</p></fieldset>
<fieldset><legend> Date de naissance </legend>
	<p><select name="jour" class="register">
	<?php if(isset($_SESSION['enr_jour'])){
				echo '<option value="'.$_SESSION['enr_jour'].'">'.$_SESSION['enr_jour'].'</option>';
				unset($_SESSION['enr_jour']);
			}else{
				?><option value="">Jour</option>
	<?php
	}
	for($i=1;$i<32;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>
	<select name="mois" class="register">
	<?php if(isset($_SESSION['enr_mois'])){
				echo '<option value="'.$_SESSION['enr_mois'].'">'.$_SESSION['enr_mois'].'</option>';
				unset($_SESSION['enr_mois']);
			}else{
				?><option value="">Mois</option>
	<?php
	}
	for($i=1;$i<13;$i++)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>
	<select name="annee" class="register">
	<?php if(isset($_SESSION['enr_annee'])){
				echo '<option value="'.$_SESSION['enr_annee'].'">'.$_SESSION['enr_annee'].'</option>';
				unset($_SESSION['enr_annee']);
			}else{
				?><option value="">Année</option>
	<?php
	}
	for($i=2012;$i>1900;$i--)
	{
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></p></fieldset>
<p><input type="checkbox" name="condition" /> Assurez-vous de bien avoir consulté les <a href="javascript:popup('modules/membre/public/conditions.php')">conditions générales</a> du site.</p>
<br/><p> (*) Champs obligatoire  (**) Doit être valide pour recevoir un mail de confirmation</p>
<br/><input type="submit" name="connexion" value="Inscription">
</form>

<?php
}else{
echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">'; 
}
?>