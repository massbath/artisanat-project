<?php
$subject = 'Inscription sur site artisanat';

$message = 'Merci de vous �tres inscrit sur notre site <br />';
$message .= 'Voici le lien pour activer votre compte : <a href="http://localhost/artisanat-project/index.php?page=activation&amp;code_activation='.$code_activation.'">Cliquez ICI</a><br />';
$message .= 'Si vous ne voyez pas le lien, copier-coller ce lien dans votre navigateur : http://localhost/artisanat-project/index.php?page=activation&amp;code_activation='.$code_activation.'<br />';
$message .= 'Merci et bonne visite.<br />';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ARTISANAT <contact@artisanat.fr>' . "\r\n";
$headers .= 'Reply-To: contact@artisanat.fr' . "\r\n";

$ok = mail($mail, $subject, $message, $headers);
?>