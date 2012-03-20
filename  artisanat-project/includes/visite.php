<?php

if (!isset($_SESSION['logged'])){
	$_SESSION['logged']=false;
	$_SESSION['ip']=$_SERVER["REMOTE_ADDR"];
}

?>