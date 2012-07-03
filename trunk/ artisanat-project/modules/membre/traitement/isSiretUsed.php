<?php
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);

$siret = (isset($_POST["siret"])) ? $_POST["siret"] : NULL;

$reponse = mysql_query('SELECT siret FROM `entreprise` WHERE siret="'.$siret.'"') or die(mysql_error());

header("Content-Type: text/plain");

if(mysql_numrows($reponse) == 0) {
	echo "false";
} else {
	echo "true";
}
?>