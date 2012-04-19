
 <!--	<a href="index.php" title="Retour à l'accueil"><div class="accueil">Accueil</div></a>
	<a href="index.php?page=contact" title="Contactez nous"><div class="contact">Contact</div></a>
-->

<?php 
function isAdmin()
{return 0;}
 // if session exists and is admin show the admin's menu
	if(isset($SESSION['users']) and (isAdmin()) )
		{
		?>
		<a href="index.php" title="Retour à l'accueil"><div class="accueil">Accueil</div></a>
	    <a href="index.php?page=contact" title="Contactez nous"><div class="contact">Contact</div></a>
		<?php
		}
		//else if the session exists and is not admin show member's menu
	else if	(isset($SESSION['users']) and (!isAdmin()) )
			{
			?>
			<a href="index.php" title="Retour à l'accueil"><div class="accueil">Accueil</div></a>
			<a href="index.php?page=contact" title="Contactez nous"><div class="contact">Contact</div></a>
			<?php
			}
		else //show the simple menu
			{
			?>
			<a href="index.php" title="Retour à l'accueil"><div class="accueil">Accueil</div></a>
	        <a href="index.php?page=contact" title="Contactez nous"><div class="contact">Contact</div></a>
			<?php 
			}	
?>