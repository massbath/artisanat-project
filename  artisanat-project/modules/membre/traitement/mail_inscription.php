<?php
$subject = __('Inscription sur site artisanat');

$message = __('Merci de vous êtres inscrit sur notre site').'<br />';
$message .= ''.__('Voici le lien pour activer votre compte :').' <a href="http://localhost/artisanat-project/index.php?page=activation&amp;code_activation='.$code_activation.'">'.__('Cliquez ICI').'</a><br />';
$message .= 'Si vous ne voyez pas le lien, copier-coller ce lien dans votre navigateur : http://localhost/artisanat-project/index.php?page=activation&amp;code_activation='.$code_activation.'<br />';
$message .= ''.__('Merci et bonne visite').'.<br />';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ARTISANAT <contact@artisanat.fr>' . "\r\n";
$headers .= 'Reply-To: contact@artisanat.fr' . "\r\n";

$ok = mail($mail, $subject, $message, $headers);
?>