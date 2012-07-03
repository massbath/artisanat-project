<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);

$rep = mysql_query('SELECT id_entreprise FROM lien_utilisateur_entreprise WHERE id_user="'.$_SESSION['id_user'].'"') or die(mysql_error());

while ($tmp = mysql_fetch_array($rep)) {
	$id_entreprise = $tmp['id_entreprise'];
}
$reponse = mysql_query('SELECT mail, nom, denomination_sociale, telephone_entreprise, adresse, cp, ville, siret, site, fax, portable FROM entreprise WHERE id_entreprise="'.$id_entreprise.'"') or die(mysql_error());

$toRespond = "";

while ($result = mysql_fetch_array($reponse)) {
	$toRespond .= $result['mail']."|";
	$toRespond .= $result['nom']."|";
	$toRespond .= $result['denomination_sociale']."|";
	$toRespond .= $result['telephone_entreprise']."|";
	$toRespond .= $result['adresse']."|";
	$toRespond .= $result['cp']."|";
	$toRespond .= $result['ville']."|";
	$toRespond .= $result['siret']."|";
	$toRespond .= $result['site']."|";
	$toRespond .= $result['fax']."|";
	$toRespond .= $result['portable']."|";
}

header("Content-Type: text/plain");

echo $toRespond;
?>