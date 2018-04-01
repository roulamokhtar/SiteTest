<?php 
include_once("model/BDD.php");
include_once("model/Map.php");
include_once("model/REQUETE.php");
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php");
include_once("template/vueFooter.php");
?>
<!DOCTYPE html>

<html lang="fr"> 
    

	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		<script src="common/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="common/js/bootstrap.min.js"></script>

	
	<script type="text/javascript" src="common/js/form/jquery.validate.min.js"></script>
	
	<script type="text/javascript" src="common/js/form/additional-methods.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <script>
function downloadCSV(csv,filename){
	var csvFile;

    var downloadLink;
 
    // CSV file
    csvFile = new Blob([csv], {type: 'text/csv;charset = utf-8;\uFEFF" + downloadLink'} );

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
 	 

function exportTableToCSV(filename){
 var csv = [];
 
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row =[] , cols = rows[i].querySelectorAll("td, th");
     
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(";"));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>
			 


	</head>
	<body>
	 
		<form method="post"     class="  formMaps2"   action="actions.php">
		<div class="floating-boxCommune">
					<h4> Commune :</h4>
					<select name="departement"   size="3" class="dropdown" ">
					 
						<?php foreach ($departements as $departement): ?>
						 <option value="<?php echo $departement['id']; ?>"><?php echo $departement['departement']; ?></option>
						<?php endforeach; ?>
				</select>
					 
				</div>
			 <div class="floating-boxLocalite">
					 
						<h4 > Localité :</h4>
						<SELECT  name="localite" size="3" class="dropdown"  ">
							<?php foreach ($localites as $localite): ?>
							 <option value="<?php echo $localite['ville_id']; ?>"><?php echo $localite['ville_nom_reel']; ?></option>
							<?php endforeach; ?>
						</SELECT >
				</div>
			<div class="floating-boxTyeAction"  >
								<h4 > Type action :</h4>
								<SELECT  name="nomactions" size="3" class="dropdown"   >
									<?php foreach ($Nomactions as $nomactions): ?>
									 <option  value="<?php echo $nomactions['id'] ; ?>"><?php echo $nomactions['nomactions']; ?></option>
									<?php endforeach; ?>
								</SELECT >
							</div>
			<div class="floating-boxTemeTauxPhysique">
								<h4 > Taux physique</h4>
								<SELECT  name="physique" size="3" class="dropdown"  >
								  
								<option   value="00"> Action non entammée </option>
								<option   value="50"> inférieur ou égal  à 50 % </option>
								<option   value="75"> inférieur ou égal  à 75 % </option>
								<option  value="99"> inférieur ou égal  à 99 % </option>
								<option   value="100"> Action Términée  </option>	 
				 
								</SELECT >

					</div>
				<div class="floating-boxTheme">
					 
						<h4 >Thème fédérateur</h4>
						<SELECT  name="composante" size="3"     >
							<?php foreach ($composantes as $composante): ?>
							 <option value="<?php echo $composante['composante']; ?>"><?php echo $composante['composante']; ?></option>
							<?php endforeach; ?>
						</SELECT >
				</div>
 


				<div class="floating-boxAnnee"  >
									<h4 > Année :</h4>
								<INPUT type="checkbox" name="annee[]" value="2010"  > 2010 </INPUT>  
								<INPUT type="checkbox" name="annee[]" value="2011"  > 2011</INPUT>   
								<INPUT type="checkbox" name="annee[]" value="2012"  > 2012 </INPUT> </br>
								<INPUT type="checkbox" name="annee[]" value="2013"  > 2013 </INPUT>   
								<INPUT type="checkbox" name="annee[]" value="2014"  > 2014 </INPUT>  
				 				</div>

				
					<div class="floating-boxEtatAction">

					 <h4>Etat actions </h4>  
					 
					 <input type="radio" name="etat" value="validee"  /> <label class="labelinput"  > Validée  </label>  
					 <input type="radio" name="etat" value="annulee"  /> <label class="labelinput"  > Annulée</label>   
					 <input type="radio" name="etat" value="volumeAnnulée"  /> <label class="labelinput"   >avec RAR</label> </br>
					  <input type="radio" name="etat" value="volumesansrar"  /> <label class="labelinput"  > Action sans RAR</label>  
 
					  <input type="radio" name="cloture" value="ok"   /> <label class="labelinput"   >PV définitive </label>  
					 <input type="radio" name="cloture" value=""   /> <label class="labelinput"   > sans PV définitive  </label>  

				</div>
				 <div class="floating-boxTauxFinancier">
					<h4   > Taux financier :</h4>
					 
					 <input type="radio" name="habitants" value="egal0" id="egal0" /> <label class="labelinput"  >égal à 0 %</label>   
					<input type="radio" name="habitants" value="moins10" id="moins10"   /> <label class="labelinput"  ><= 10 %</label>  
					<input type="radio" name="habitants" value="moins25" id="moins25"   /> <label class="labelinput" ><= 25%</label>  </br>
					<input type="radio" name="habitants" value="moins50" id="moins50"  /> <label class="labelinput" ><= 50 %</label>  
					<input type="radio" name="habitants" value="moins75" id="moins75"   /> <label class="labelinput" ><= 75 %</label>   
					<input type="radio" name="habitants" value="inferieur100" id="inferieur100" class="labelinput" /> <label  ><  100 %</label>  
					<input type="radio" name="habitants" value="100" id="100"  /> <label class="labelinput" > = 100 %</label>
				</div>
  
				<div class="floating-boxSourceFinancement"  >
					<h4 >Source de financement :</h4>
					 <INPUT type="checkbox" name="finance[]" value="FNDR"  > Ligne 2</INPUT>  
					 <INPUT type="checkbox" name="finance[]" value="FSAEPEA"  > Ligne 3</INPUT>   
					 <INPUT type="checkbox" name="finance[]" value="PSD-FORETS"  > PSD-FORETS </INPUT>
					<button type="submit"   id="submit" name="submit">Recherche</button>
	    
 				</div>

  
		</form>
	  

<div class="div-table-resultat-action"  >

<button onclick="exportTableToCSV('members.csv')"> Exporter les resultats dans Excel	</button>	

<a href="graph.php<?php if($_SESSION['name'] !="ADMIN"){echo '?circonscription='.$circonscription ;}else{echo "";} ?>"> Histogramme des clotures  par communes </a>  " "
<a href="graphCirconscription.php<?php if($_SESSION['name'] !="ADMIN"){echo '?circonscription='.$circonscription ;}else{echo "";} ?>"> Histogramme des clotures par circonscriptions  </a>
 
<table    class="scroll action   table-bordered"  >
	
	<thead  >
 <tr  >
		<th>DETAIL </th>
 
  		<th>ANNEE </th>
  		<th>code action </th>
		<th>Circonscrition </th> 
 
 		<th>COMMUNE </th>
  		<th>LOCALITE </th>
 		<th>ACTION</th>
  	 	<th>SOURCE FINANCEMENT</th>
		<th>QUANTITE PREVUE</th>
		<th>REALISATION</th>
		<th>TAUX PHYSIQUE</th>
		<th>MONTANT PREVU</th>
		<th>PAIEMENT</th>
		<th>TAUX PAIEMENT</th>
		<th>CLOTURE</th>
 		<th>OBS </th>
		
</tr>
</thead  > </table>
	
<table    class="scroll action  table-bordered"  >
 <tbody > 
<?php
foreach ( $CODE as $actions) {
   ?>
<tr  >
<td> <a href="edit.php?code_actions=<?php echo $actions->code_actions;?>"> Modifier  </a> </td>
 
 		<td > <?php echo  $actions->annee;?></td>
 		<td > <?php echo  $actions->code_actions;?></td>
		<td > <?php echo stripcslashes($actions->circonscription) ;?></td>
 
 		<td > <?php echo stripcslashes($actions->commune) ;?></td>
 
 		<td > <?php echo  $actions->localite;?></td>
 		<td > <?php echo  $actions->nomactions;?></td>
		<td > <?php echo  $actions->source_financement;?></td>
		
		<td> <?php echo number_format($actions->quantite,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->realisation_physique, 2, ',', ' '); ?></td>
		<td> <?php echo number_format($actions->tauxphysique,2, ',', ' ')   ; ?> %</td>
		<td > <?php echo  number_format($actions->montant,2,',',' ');?></td>
		<td> <?php echo number_format($actions->paiement,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->tauxpaiemant, 2, ',',' ') ; ?> %</td>
		<td> <?php echo $actions->cloture ; ?></td>		
 		<td> <?php echo $actions->observation ; ?></td>		
		
		
</tr>
<?php
}
?>
 </tbody>	
 
</table>
<div style="background-color:yellow; width: 100% "> critère(s) séléctionné(s)
<?php
if(isset($_POST['submit'])){

		if(isset($_POST['departement'])){
			$nomCommune=$nomC->nom_departement;
					?> Commune:
					<?php echo "<font size='2' color='red'>". $nomCommune.   "</font> "     ;

					 
				}
				if(isset($_POST['localite'])){
$nomLocalitess= $nomLoc->ville_nom_reel;

  					?> Localité:
					<?php echo "<font size='2' color='red'>"   .$nomLocalitess.    "</font> "     ;
 					  
				}
		if(isset($_POST['physique'])){

 					?> Taux physique:
					<?php echo "<font size='2' color='red'>". $etatAction.   "</font> "     ;


 		}
		if(isset($_POST['annee'])){
			?> Année:
					<?php echo "<font size='2' color='red'>".implode("-", $annee).   "</font> "     ;
 		}
		if(!empty($_POST["finance"])){
			?> Source de financement:
					<?php echo "<font size='2' color='red'>".implode("-", $finance).   "</font> "     ;

 		}
		if(isset($_POST['habitants'])){
			?> Taux de paiement:
					<?php echo "<font size='2' color='red'>".$habitants.      "</font> "?>
					<font size='2' color='red'> %</font> <?php      ;
 		}

		if(isset($_POST['cloture']) and $_POST['cloture']=="ok"){
?> Pv de récéption: <font size='2' color='red'>OUI</font> <?php 
					 
		}
		if (isset($_POST['cloture']) and $_POST['cloture']=="") {
				?> Pv de récéption: <font size='2' color='red'>NON</font> <?php 

		}

		if(isset($_POST['etat']) and $_POST['etat']=="validee"){
				?> Pv de récéption: <font size='2' color='red'>Action non annulée</font> <?php 

 		}
		if (isset($_POST['etat']) and $_POST['etat']=="annulee") {
				?> Pv de récéption: <font size='2' color='red'>Action annulée</font> <?php 

 		}
		if (isset($_POST['etat']) and $_POST['etat']=="volumeAnnulée") {
				?> Pv de récéption: <font size='2' color='red'>volume proposé à l'annulation</font> <?php 

 		}

		
if(isset($_POST['composante'])){
	?> Thème Fédérateur:
					<?php echo "<font size='2' color='red'>".$_POST['composante'].   "</font> "     ;
 		}		
		if(isset($_POST['nomactions'])){
					$Nomact =$map-> getNomAction(); 
					?> Action:
					<?php echo "<font size='2' color='red'>". $Nomact.   "</font> "     ;
				}



}else{
	echo '<font color="red">'." Aucun critère nest sélectionné".'</font>';
}// FIN critère(s) séléctionné(s)
?>

</div>
<div style="background-color: rgba(128,128,128,0.9); width: 100% ">      
<font size='3' color='brown'  font-weight='bold' > Résultat(s)  :</font>  
	<?php
	if(isset($_POST['submit'])){
		echo "</br>";
		?> -  Nombre d'actions trouvés: <?php  echo '<font size="2" color="red"  "font-weight:bold"> '.$nombreactiontrouve.' </font>';  ?> 
		

  -  Montant prévu : <?php 
		 
echo   '<font size="2" color=" red"  "font-weight:bold" > '.number_format( $montantprevutrouve->montant_prevu,2,',',' ')  .' Da </font>'; ?> 
  -  Montant décaissé : <?php 
		 
echo   '<font size="2" color="red"  "font-weight:bold" > '.number_format( $montantactiontrouve->decaissement,2,',',' ')  .' Da </font>'; ?> 
   -  RAR FINANCIER: <?php 
	
		$p=  $montantprevutrouve->montant_prevu ;

		$r=  $montantactiontrouve->decaissement ;
		
			$rar=$p-$r; 
 echo   '<font size="2" color="red"  "font-weight:bold" > '.number_format($rar,2,',',' ')  .' Da </font>';  
 	

		
		 
		 
		
		 

		if(isset($_POST['etat'])){
			echo "     -rar physique :<font size='2' color='red'> $etat</font>"-"";
		}
		

		

		
				 
				
	
//var_dump($_POST['composante'])	;	
 
  if(isset($_POST['nomactions'])){
echo   '<font size="2" color="red"  "font-weight:bold" > ' ."Volume Prévu :"  .number_format(  $PhysiqueprevuactionTROUVE->volume_prevu ,2,',',' ').'  </font>'   ; 

echo   '<font size="2" color="red"  "font-weight:bold" > ' ."Volume réalisé :"  .number_format( $PhysiquerealisationactionTROUVE->realisation ,2,',',' ').'  </font>'; 


$pPHYSIQUE=  $PhysiqueprevuactionTROUVE->volume_prevu ; // volume prévu de l'action
$rPHYSIQUE=  $PhysiquerealisationactionTROUVE->realisation ; // volume realise de l'action
$rarphysique = $pPHYSIQUE- $rPHYSIQUE ; // RAR volume   de l'action
echo'<font size="2" color="red"  "font-weight:bold" >'."RAR PHYSIQUE :".number_format( $rarphysique,2,',',' ').'</font>';}
}
?>
</div>
</div>
 <script type="text/javascript">
 	

 
 var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler


</script>
