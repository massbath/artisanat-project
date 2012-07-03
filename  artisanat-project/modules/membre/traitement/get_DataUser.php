<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);

$reponse = mysql_query('SELECT mail, nom, prenom, date_naissance, sexe, adresse, cp, ville, telephone_domicile, telephone_portable FROM utilisateur WHERE id_user="'.$_SESSION['id_user'].'"') or die(mysql_error());

$toRespond = "";

while ($result = mysql_fetch_array($reponse)) {
	$toRespond .= $result['mail']."|";
	$toRespond .= $result['nom']."|";
	$toRespond .= $result['prenom']."|";
	$toRespond .= $result['date_naissance']."|";
	$toRespond .= $result['sexe']."|";
	$toRespond .= $result['adresse']."|";
	$toRespond .= $result['cp']."|";
	$toRespond .= $result['ville']."|";
	$toRespond .= $result['telephone_domicile']."|";
	$toRespond .= $result['telephone_portable']."|";
}

header("Content-Type: text/plain");

echo $toRespond;
?>