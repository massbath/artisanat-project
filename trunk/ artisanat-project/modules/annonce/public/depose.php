<?php
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
		?>
		<link type="text/css" rel="stylesheet" href="theme/css/formulaireDepose.css" media="screen" />
		<script type="text/javascript" src="includes/javascript/validation_depose.js" language="JavaScript"></script>
		
		<div id="depose_annnonce">
			<form method="POST" action="" name="depose_annonce" id="formulaire_depose_annonce">
				<div>
					<label for="titre">Titre (*)</label>
					<input id="titre" name="titre" type="text" />
					<span id="titreInfo">Donnez un titre à votre demande</span>
				</div>
						
				<div>
					<label for="description">Description (*)</label>
					<textarea name="description" id="description" rows="20" cols="80"></textarea> 
					<span id="descriptionInfo">Donnez une description à votre demande</span>
				</div>
						
				<div>
					<label for="categorie">Catégorie (*)</label>
					<select name="categorie" id="categorie">
						<?php
							$req_secteur_activite = mysql_query('SELECT * FROM secteur_activite') or die('Erreur SQL:'.mysql_error());
							while($secteur_activite=mysql_fetch_array($req_secteur_activite)) {
								echo '<option value="'.$secteur_activite['id_secteur'].'">'.$secteur_activite['nom'].'</option>';
								//$req_corps_activite =mysql_query('SELECT * FROM corps_metier WHERE designation='.$secteur_activite['nom'].'') or die('Erreur SQL:'.mysql_error()));
							}
						?>
					</select>	
					
					<?php
						$i=0;	
						$res = array(array());
						$req_secteur_activite = mysql_query('SELECT * FROM secteur_activite') or die('Erreur SQL:'.mysql_error());
						while($secteur_activite = mysql_fetch_array($req_secteur_activite)) {
							$req_corps_metier = mysql_query('SELECT * FROM corps_metier WHERE secteur_activite="'.$secteur_activite['nom'].'"') or die('Erreur SQL:'.mysql_error());

							$j = 0;
							echo 'i='.$i;
							while($corps_metier = mysql_fetch_array($req_corps_metier)) {
								$res[$i][$j] =  $corps_metier['designation'];
							   
								$j++;
								echo 'j='.$j;
							}
								
							$i++;	
						}
							
						for($k=0;$res[$k]!=false;$k++) {
							for($m=0;$res[$k][$m]!=false;$m++) {
								echo $res[$k][$m];
								echo "blop";
							}
						}
						?>
					<span id="categorieInfo">Sélectionner une catégorie</span>
				</div>		
				<br/>		
				<p> 
					<label>  
						Champs obligatoires (*) 
					</label> 
				</p>
				<br/>
			
				<div>
					<input id="send" name="send" type="submit" value="Send" />
				</div>
			</form>
		</div>
		<?php
	} else {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php">'; 
	}
?>