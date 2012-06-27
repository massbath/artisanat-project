<?php
// Récupération de la page pour changer l'affichage de l'élément actif du menu
$page="";
if (empty ($_GET['page']))	{
	$page='accueil';
}elseif($_GET['page'] == 'contact') {
	$page='contact';
}elseif($_GET['page'] == 'news') {
	$page='news';
}
?>

<!-- Affichage du menu -->
<div class="menu">
	<div class="l"></div>
	<div class="r"></div>
	<ul class="nav">
		<li><a href="./index.php" <?php if($page=='accueil'){ echo 'class="active"';} ?>>
			<span class="l"> </span>
			<span class="r"> </span>
			<span class="t">Accueil</span></a>
		</li>
		<li><a href="./index.php?page=news" <?php if($page=='news'){ echo 'class="active"';} ?>>
			<span class="l"> </span>
			<span class="r"> </span>
			<span class="t">News</span></a>
		</li>
		<li><a href="./about.html">
			<span class="l"></span>
			<span class="r"> </span>
			<span class="t">About Us</span></a>
		</li>
		<li><a href="./index.php?page=contact" <?php if($page=='contact'){ echo 'class="active"';} ?>>
			<span class="l"> </span>
			<span class="r"> </span>
			<span class="t">Nous contacter</span></a>
		</li>
	</ul>
</div>