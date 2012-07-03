<?php
session_start();
include ('../../../includes/conf_bdd.php');
$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse);
mysql_select_db($nom_database, $link);

$email = (isset($_POST["email"])) ? $_POST["email"] : NULL;

if(isset($_SESSION['id_user'])) {
	$reponse = mysql_query("SELECT mail FROM `utilisateur` WHERE mail='".$email."' AND id_user<>'".$_SESSION['id_user']."'") or die(mysql_error());
} else {
	$reponse = mysql_query("SELECT mail FROM `utilisateur` WHERE mail='".$email."'") or die(mysql_error());
}
	
header("Content-Type: text/plain");

if(mysql_numrows($reponse) == 0) {
	echo "false";
} else {
	echo "true";
}
?>