<?php
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		$id_utilisateur = $_SESSION['id_user'];
		
		$req_profil = mysql_query('SELECT * FROM utilisateur WHERE id_user ="'.$id_utilisateur.'"') or die('Erreur SQL :'.mysql_error());
		$profil = mysql_fetch_array($req_profil);
		?>
		<div id="profil_utilisateur">
			<table>
				<tr>
					<td><h2>Mon profil</h2></td>
				</tr>
				
					<!-- ligne Titr nom prénom  !-->	
					<tr>  
						 <td>
							<?php 	if($profil['sexe']=='m') 
										$titre = 'Monsieur' ;
									else 
										$titre = 'Madame';
							?>
							<?php 
									echo '<h1>'.$titre.' '.$profil['nom'].' '.$profil['prenom'].'</h1>'; 
							?> 
						</td>	
					</tr>  
					
					<tr>
						<td>
							<h3>Date de naissance</h3>
						</td>
						<td>
							<?php echo date("\L\e j/m/Y", strtotime($profil['date_naissance']));?>
						</td>
					</tr>
					
					<tr>
						<td>
							<h3>Date d'enregistrement</h3>
						</td>
						<td>
							<?php echo date("\L\e j/m/Y", strtotime($profil['date_enregistrement'])); ?>
						</td>
					</tr>
					
					<tr>
						<td>
							<h1>Mes coordonnéees</h1>
						</td>
					</tr>
					
					<tr>
						<td>
							<h3>Adresse e-mail</h3>
						</td>
						<td>
							<?php echo $profil['mail'];?>
						</td>
						<td>
							<h3>Adresse</h3>
						</td>
						<td>
							<?php echo $profil['adresse'];?>
						</td>
					</tr>
					<tr>
						<td>
							<h3>Téléphone</h3>
						</td>
						<td>
							<?php echo $profil['telephone_domicile'];?>
						</td>
						<td>
							<h3>Code postal</h3>
						</td>
						<td>
							<?php echo $profil['cp'];?>
						</td>
					</tr>
					<tr>
						<td>
							<h3>Téléphone portable</h3>
						</td>
						<td>	
							<?php echo $profil['telephone_portable'];?>
						</td>
						<td>
							<h3>Ville</h3>
						</td>
						<td>
							<?php echo $profil['ville'];?>
						</td>
					</tr>
					
					<tr>
						<td>	
							<h1>Mes demandes</h1>
						<td>
					</tr>
					<table style="text-align:center";>
						<thread> <!-- entête du tableau!-->
							<th>Etat</th>	
							<th>Commentaire</th>	
							<th>Date de création de la demande</th>
							<th>Dernière date de modification</th>
						</thread>
						<!-- remplissage du tableau!-->
						<?php
							$req_demande = mysql_query('SELECT * FROM demande WHERE id_proprietaire ="'.$id_utilisateur.'"') or die('Erreur SQL :'.mysql_error());
							while($demande = mysql_fetch_array($req_demande)) {
								echo '<tr><td>'.$demande['etat'].'</td><td>'.$demande['commentaire'].'</td><td>'.date("\L\e j/m/Y",strtotime($demande['date_creation'])).'</td><td>'.date("\L\e j/m/Y",strtotime($demande['derniere_date_modification'])).'</td></tr>';
							}
						?>
					</table>
			<table>
		</div>	
		<?php
	} else {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">'; 
	}
?>