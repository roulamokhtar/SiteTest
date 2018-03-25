
<?php include_once("template/vueHeader.php"); ?>
<?php include_once("template/vueNavbar.php"); ?>
 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <body>

  <div id="form">

		<form method="post" id="form" class="  formMaps" role="form" action="maps.php">
			
 				<h4 align="center"> Formulaire de recherche  </h4>
					 <class="col-sm-12" departement">
					<h6>Choisir votre commune :</h6>

					<select name="departement" size="2">
						<?php foreach ($departements as $departement): ?>
						 <option value="<?php echo $departement['id']; ?>"><?php echo $departement['departement']; ?></option>
						<?php endforeach; ?>
					</select>

 					
					<h5>Choisir l'année du programme :</h5>
					<SELECT  name="annee" size="2">
						<?php foreach ($Annees as $annee): ?>
						 <option value="<?php echo $annee['annee']; ?>"><?php echo $annee['annee']; ?></option>
						<?php endforeach; ?>

					</SELECT >
				 
					<h5 >Source de financement :</h5>
					 <INPUT type="checkbox" name="finance[]" value="FNDR"  > Ligne 2</INPUT>  
					 <INPUT type="checkbox" name="finance[]" value="FSAEPEA"  > Ligne 3</INPUT>   
					 <INPUT type="checkbox" name="finance[]" value="PSD-FORETS"  > PSD-FORET  </INPUT> 

 					 <h5 >Choisir une Localité :</h5>
						<SELECT  name="localite" size="2">
							<?php foreach ($localites as $localite): ?>
							 <option value="<?php echo $localite['ville_id']; ?>"><?php echo $localite['ville_nom_reel']; ?></option>
							<?php endforeach; ?>
						</SELECT >
 <h5 >Programme:

					<INPUT type="checkbox" name="programme[]" value="TBV" > TBV</INPUT> 
					<INPUT type="checkbox" name="programme[]" value="GEPF" > GEPF </INPUT> 
					<INPUT type="checkbox" name="programme[]" value="CEN" > CEN</INPUT></h5>
				
					 <h5 >Choisir un taux de paiement :
					<input type="radio" name="habitants" value="egal0" id="egal0" /> <label for="egal0">= 0 %</label> <br> 
					  
					<input type="radio" name="habitants" value="inf100" id="inf100" /> <label for="inf100">Inférieur à 100 %</label>  
					<input type="radio" name="habitants" value="egal100" id="egal100" /> <label for="egal100">Egal à 100 %</label>  </h5> 
					
					<div id ="etat">
						
						<h4>Etat actions </h4>
					 
					 <input type="radio" name="etat"  id='etat' value="validee"  /> <label class="labelinput"  > Validée</label>  
					 <input type="radio" name="etat"  id='etat' value="annulee"  /> <label class="labelinput"  >Annulée</label>   
					 <input type="radio" name="etat" id='etat'  value="volumeAnnulée"  /> <label class="labelinput"   >avec RAR</label> </br> 
					  <input type="radio" name="etat"  id='etat' value="volumesansrar"  /> <label class="labelinput"  >sans RAR</label>  
 
					  <input type="radio" name="cloture" value="ok"    /> <label class="labelinput"   >PV définitif</label>   
					 <input type="radio" name="cloture" value=""    /> <label class="labelinput"   > sans PV définitif</label> <br>  <button type="submit"   id="submit">Rechercher</button>   
					</div>
				

		
		</form>
	</div>

   <div id="floating-resultatRechercheMap">

		<h4 color='brown'  font-weight='bold'  align='center' > Résultat de la recherche  </h4>
		 
		 <h6  align='center'>
					Vous avez
					<?php  echo '<font size="3" color="red"> '.$stationsCount.' </font>';  ?> 
					projet(s) dans   
					<?php  echo '<font size="4" color="red"> '. $projetCount.' </font>' ; ?>
					localité(s)  
					</h6>
					 
		 
		  Critère(s) séléctionné(s): 

				<?php

				 if(!empty($_POST)){
				 	extract($_POST);
				 	// critère de communne
				 	if(!empty($_POST['departement'] )) {
						$nomC=$map->getNomDepartements($circonscription);
						$nomCommune=$nomC->nom_departement;
						?> Commune:
						<?php echo "<font size='2' color='red'>". $nomCommune.   "</font> "     ;
 					} 
					// critère de localité
				 	if(!empty($_POST['localite'] )) {
						$nomLoc=$map->getNomLocalites($circonscription);
						 
						$nomLocalitess= $nomLoc->ville_nom_reel;

						?> Localite:
						<?php echo "<font size='2' color='red'>". $nomLocalitess.   "</font> "     ;
 					} 
 					// critère de années
				 	if(!empty($_POST['annee'] )) {
				$annee = $_POST['annee'];
Année:
					 echo "<font size='2' color='red'>". $annee.   "</font> "     ;
						 
						 
 					}
 					// critère de taux paiement
				 	if(!empty($habitants )) {
			$habitants = $_POST['habitants'];

						 
						?> Taux de paiement:
					<?php echo "<font size='2' color='red'>".$habitants.      "</font> "?>
					<font size='2' color='red'> %</font> <?php      ;
 					} 

 					// critère de source  de financement
				 	if(!empty($_POST["finance"] )) {
 
						 
						?> Source de financement:
					<?php echo "<font size='2' color='red'>".implode("-", $finance).   "</font> "     ;
  					}

  					if(!empty($_POST["programme"] )) {
 
						 
						?> Programme:
					<?php echo "<font size='2' color='red'>".implode("-", $programme).   "</font> "     ;
  					}  
					// critère de Pv de récéption
				 	if(isset($_POST['cloture']) and $_POST['cloture']=="ok"){
 				 						$cloture = $_POST['cloture'];

?> Pv de récéption: <font size='2' color='red'>OUI</font> <?php 
					 
		}
		if (isset($_POST['cloture']) and $_POST['cloture']=="") {
				?> Pv de récéption: <font size='2' color='red'>NON</font> <?php 

		}

		if(isset($_POST['etat']) and $_POST['etat']=="validee"){

				$etat = $_POST['etat'];
				?>  : <font size='2' color='red'>Action non annulée</font> <?php 

 		}
		if (isset($_POST['etat']) and $_POST['etat']=="annulee") {

				?>  : <font size='2' color='red'>Action annulée</font> <?php 

 		}
		if (isset($_POST['etat']) and $_POST['etat']=="volumeAnnulée") {
				?>  : <font size='2' color='red'>volume proposé à l'annulation</font> <?php 

 		}
 if (isset($_POST['etat']) and $_POST['etat']=="volumesansrar") {
				?>  : <font size='2' color='red'>ACTION  sans RAR</font> <?php 

 		}
 

 				}else{

 					?>   <font size='2' color='red'>Aucun critère n'est selectionné</font> <?php 
 					    
 				}

				?>
 
</div>



<div id="Afficheractionlocalite"  >
	 
        	<label class="legend"  id="checkboxes" style="text-align: center ";     > <input type="checkbox" value="checkboxes" id="checkboxes"   > Afficher les actions</label>

			<label class="legend" id="checkboxer" style="text-align: center"; ><input type="checkbox" value="checkboxer" id="checkboxer"   checked   > Afficher les localités</label>
     
     
		 </div>

		 <div id="formulaire-legende"  >
			
			<h4> Couches de données  </h4>
			 
				
		<li><input type="checkbox" id="layer_05" onclick="toggleLayers(5);"/>Circonscriptions</li>  
        <li><input type="checkbox" id="layer_01" onclick="toggleLayers(1);"/>Communes</li>  
		<li>   <input type="checkbox" id="layer_02" onclick="toggleLayers(2);"/> Les reboisements 2000-2010</li> 
		<li> <input type="checkbox" id="layer_03" onclick="toggleLayers(3);"/> Les Bassins versant</li> 
		<li>  <input type="checkbox" id="layer_04" onclick="toggleLayers(4);"/> Les FORETS</li>  
</div>

		  
		 
	<div id="map-canvas"></div>
	
   	 
	</body>


	<?php include_once("template/vueFooter.php"); ?>
 