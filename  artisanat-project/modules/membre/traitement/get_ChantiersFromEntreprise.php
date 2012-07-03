<?php
header('Content-type: application/json');

session_start();
include ('../../../includes/conf_bdd.php');

$link = mysql_connect($serveur_bdd, $nom_user, $motdepasse) or die('Could not connect: ' . mysql_error());
mysql_select_db($nom_database, $link) or die('Could not select database');

$result = mysql_query('SELECT * FROM `devis` WHERE `id_entreprise`=2') or die('Erreur SQL : '.mysql_error()) ;
$all_recs = array();
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$all_recs[] = $line;
}

echo json_encode($all_recs);
 
// Free resultset
//mysql_free_result($result);
?>