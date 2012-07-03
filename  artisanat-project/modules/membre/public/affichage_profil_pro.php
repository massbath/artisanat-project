<?php
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		$id_utilisateur = $_SESSION['id_user'];
		$req_id_entreprise = mysql_query('SELECT id_entreprise FROM lien_utilisateur_entreprise WHERE id_user ="'.$id_utilisateur.'"');

		while($rep = mysql_fetch_array($req_id_entreprise)) {
			$id_entreprise = $rep['id_entreprise'];
		}

		// Créé la requête
		$query =  "SELECT * FROM `entreprise` WHERE `id_entreprise` =".$id_entreprise."";
	 
		// Exécute la requête d'insertion du message
		$result = mysql_query($query) or die('Erreur SQL : '.mysql_error());

		$row = mysql_fetch_array($result) ;				 
		?>
		<div id="profil_entreprise">
			<table style="text-align:left"; >
					<tr>
						<td>
							<h2>Mon entreprise</h2>
						</td>
					</tr>
							
					<!-- statut!-->
					<tr>
						<td>
							<h1>Mon statut</h1>
						</td>
					</tr>
					<!-- ligne 1  !-->	
					<tr>  
						<!-- ligne 1 colonne 1 !-->
						<td>
							<h3>Nom</h3>
						</td> 
						<!-- ligne 1 colonne 2 !-->
						<td>
							<?php echo $row['nom'];?>
						</td> 
						
						<td>
							<h3>Dénomination sociale</h3>
						</td>
						<td>
							<?php echo $row['denomination_sociale'] ;?>
						</td>
					</tr>  
						<!-- ligne 2 !-->	
					<tr>  
						<!-- ligne 2 colonne 1 !-->
						<td>	
							<h3>Siret</h3>
						</td> 
						<!-- ligne 2 colonne 2 !-->
						<td>
							<?php echo $row['siret']; ?>
						</td> 
						
						<td>
							<h3>Date d'enregistrement sur le site</h3>
						</td>
						<td>
							<?php echo date("\L\e j/m/Y",strtotime($row['date_enregistrement']));?>
						</td>
					</tr> 
					
					<!-- coordonnées!-->
					<tr>
						<td>
							<h1>Mes coordonnées</h1>
						</td>
					</tr>
					
					<!-- ligne 1!-->
					<tr>  
						<td>
							<h3>Mail</h3>
						</td>
						<td>
							<?php echo $row['mail']?>
						</td>
					
						<td>
							<h3>Site web</h3>
						</td>
						<td>
							<?php echo $row['site']?>
						</td>
					</tr> 
					
					<!-- ligne 2!-->
					<tr>  
						<td>
							<h3>Téléphone</h3>
						</td>
						<td>
							<?php echo $row['telephone_entreprise']?>
						</td>
						
						<td>
							<h3>Adresse</h3>
						</td>  
						<td>
							<?php echo $row['adresse']?>
						</td>  
					</tr>  	
						
					<!-- ligne 3!-->
					<tr>  
						<td>
							<h3>Portable</h3>
						</td>
						<td>
							<?php echo $row['portable']?>
						</td>
						
						<td>
							<h3>Code postal</h3>
						</td>  
						<td>
							<?php echo $row['cp']?>
						</td>  
					</tr> 		
						
					<!-- ligne 4!-->
					<tr>  
						<td>
							<h3>Fax</h3>
						</td>
						<td>
							<?php echo $row['fax']?>
						</td>
						
						<td>
							<h3>Ville</h3>
						</td>  
						<td>
							<?php echo $row['ville']?>
						</td>  
					</tr> 
					
					<!-- Realisations!-->
					<tr>
						<td>
							<h1>Mes réalisations</h1>
						</td>
					</tr>
					<table style="text-align:center;">
						<thread> <!-- entête du tableau!-->
							<th>Demandeur</th>					
							<th>Commentaire</th>
							<th>Prix</th>
							<th>Date de début prévu</th>
							<th>Date de publication</th>
							<th>Nombre de consultation par le demandeur</th>
						</thread>
						
						<!-- remplissage du tableau!-->
						<?php 
							$sql = 'SELECT * FROM `devis` WHERE `id_entreprise` ='.$id_entreprise.'';	
							// Exécute la requête d'insertion du message
							$result = mysql_query($sql) or die('Erreur SQL : '.mysql_error());	
							
							while($realisation = mysql_fetch_array($result)) {
								$req_iddemandeur = mysql_query('SELECT id_proprietaire, type_demandeur FROM demande WHERE id_demande ="'.$realisation['id_demande'].'"') or die('Erreur SQL : '.mysql_error());
								$id_demandeur = mysql_fetch_array($req_iddemandeur);
								
								//si le demandeur est un particulier on cherche son nom et prenom dans la table utilisateur
								if($id_demandeur['type_demandeur']=='u') {
									$req_particulier = mysql_query('SELECT nom, prenom, mail FROM utilisateur WHERE id_user="'.$id_demandeur['id_proprietaire'].'"') or die('Erreur SQL : '.mysql_error()) ;
									$particulier = mysql_fetch_array($req_particulier);
									echo '<tr><td>'.$particulier['nom'].' '.$particulier['prenom'].'</td><td>'.$realisation['commentaire'].'</td><td>'.$realisation['prix'].'</td><td>'.date("\L\e j/m/Y",strtotime($realisation['date_prevision_debut'])).'</td><td>'.date("\L\e j/m/Y",strtotime($realisation['date_publication'])).'</td><td>'.$realisation['consulte_par_demandeur'].'</td></tr>';
								}
								//sinon on recherche dans la table entreprise	
								elseif($id_demandeur['type_demandeur'] =='e') {
									$req_entreprise = mysql_query('SELECT nom FROM entreprise WHERE id_entreprise ="'.$id_demandeur['id_proprietaire'].'"')or die('Erreur SQL : '.mysql_error());
									$entreprise = mysql_fetch_array($req_entreprise);
									echo '<tr><td>'.$entreprise['nom'].'</td><td>'.$realisation['commentaire'].'</td><td>'.$realisation['prix'].'</td><td>'.date("\L\e j/m/Y",strtotime($realisation['date_prevision_debut'])).'</td><td>'.date("\L\e j/m/Y",strtotime($realisation['date_publication'])).'</td><td>'.$realisation['consulte_par_demandeur'].'</td></tr>';
								}
							}						
						?>			
					</table>
			</table>	
		</div>
		<?php
		} else {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">'; 
	}
?>
