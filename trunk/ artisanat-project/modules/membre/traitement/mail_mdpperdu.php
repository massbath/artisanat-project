<?php
$subject = 'Modification de mot votre mot de passe sur site artisanat';

$message = 'Vous avez demandé la réinitialisation et l\'envoi d\'un nouveau mot de passe <br />';
$message .= 'Voici ce mot de passe : '.$generation.'<br />';
$message .= 'Lien vers notre site : http://localhost/artisanat-project/index.php?<br />';
$message .= 'Merci et bonne visite.<br />';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: ARTISANAT <contact@artisanat.fr>' . "\r\n";
$headers .= 'Reply-To: contact@artisanat.fr' . "\r\n";

$ok = mail($mail, $subject, $message, $headers);
?>