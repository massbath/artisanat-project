<div id="contact">
<hr />
<div class="titre"><?php echo __("Contact"); ?></div>
<hr />
<?php
if (($_POST['nom'] != NULL) AND ($_POST['email'] != NULL) AND ($_POST['objet'] != NULL) AND ($_POST['message'] != NULL))
{
$object = mysql_real_escape_string(htmlentities($_POST['objet']));
$sujet = mysql_real_escape_string(htmlentities($_POST['sujet']));
$nom = mysql_real_escape_string(htmlentities($_POST['nom']));
$email = mysql_real_escape_string(htmlentities($_POST['email']));
$messageok = stripslashes($_POST['message']);


						
						
						
						$to = 'contact@codtv.fr';
						
						$subject = ''.$sujet.'';	//Mettre un sujet.
						
						$message = 'Objet du contact : '.$object.'<br /><br />';
						$message .= ''.$messageok.'';
						
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
     					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     					$headers .= 'From: '.$nom.' <'.$email.'>' . "\r\n";
    					$headers .= 'Reply-To: contact@codtv.fr' . "\r\n";

						$ok=mail($to, $subject, $message, $headers);
						echo "<script language='javascript'>alert('Votre formulaire a bien été transmis');</script>";
						
}
elseif (isset($_POST['envoi']))
{
echo "<script language='javascript'>alert('".__("Veuillez remplir tous les champs")."');</script>";
}
?>
<div align="center">
<form method="post" action="index.php?page=contact">
<fieldset><legend><?php echo __("Vos coordonnées :"); ?></legend>
<label><?php echo __("Nom :"); ?></label><input type="text" name="nom" class="inp"><br /><br />
<label><?php echo __("Email :"); ?></label><input type="text" name="email" class="inp"><br /><br />
</fieldset>

<fieldset><legend><?php echo __("Votre message :"); ?></legend>
<label><?php echo __("Objet :"); ?></label><select name="objet">
<option value="Etre streamé"><?php echo __("Etre streamé"); ?></option>
<option value="Partenariat"><?php echo __("Partenariat"); ?></option>
<option value="Sponsoring"><?php echo __("Sponsoring"); ?></option>
<option value="Recrutement"><?php echo __("Recrutement"); ?></option>
<option value="Rapporter un bug"><?php echo __("Rapporter un bug"); ?></option>
<option value="Proposer une amélioration"><?php echo __("Proposer une amélioration"); ?></option>
<option value="Question"><?php echo __("Question"); ?></option>

</select><br /><br />
<label><?php echo __("Sujet :"); ?></label><input type="text" name="sujet" class="inp"><br /><br />
<?php echo __("Message :"); ?><br /><textarea name="message" rows="14" cols="80" class="inp2"></textarea><br />
<input type="submit" name="envoi" value="<?php echo __("Envoyer"); ?>" style="margin-top:15px">
</fieldset>
</form>
</div>
</div>