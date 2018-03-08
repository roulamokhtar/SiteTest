
<?php 


/*
la vue
*/
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php"); 

 ?>

<!DOCTYPE html> 
<html lang="fr"> 
 <div>
	<head>
		<meta charset="utf-8">
		<title>Administration</title>

	</head>
	<body>

		 			<div id="form">

		<form method="post" id="form"  class="  formProjets" role="form" action="projetsProjets.php">
			
			<div class="form-group">
				<h4> Formulaire de recherche  </h4>
			 <h6>Vous avez   <?php
  
			   echo '<font size="4" color="red"> '.number_format($stationsCount).' </font>' ;
 
?>

			 	  projet(s) dans    <?php if( isset($_POST['Annee']) or isset($_POST['departement']) or isset($_POST['habitants']) OR isset($_POST['submit']) ){
			 	 echo '<font size="4" color="red"> '.number_format($projetCount->count).' </font>' ;

			 	}else{
			 					 	 echo '<font size="4" color="red"> '. $projetCount.' </font>' ;

			 	} 
			 	 ?>

			 	 localité(s)  </h6>	
			
				 
					<h4>Choisir votre commune :</h4>
					<select name="departement" size="3">
						<?php foreach ($departements as $departement): ?>
						 <option value="<?php echo $departement['id']; ?>"><?php echo $departement['departement']; ?></option>
						<?php endforeach; ?>
					</select>
					
					<h4>Choisir une Année :</h4>
					<SELECT  name="Annee" size="3">
						<?php foreach ($Annees as $Annee): ?>
						 <option value="<?php echo $Annee['annee']; ?>"><?php echo $Annee['annee']; ?></option>
						<?php endforeach; ?>
					</SELECT >
				
				
					 <h4 >Choisir un taux financier :</h4>
					 
					 <input type="radio" name="habitants" value="egal0" id="egal0" /> <label for="egal0">égal à 0 %</label><br />
					<input type="radio" name="habitants" value="moins10" id="moins10" /> <label for="moins10">Inférieur ou égal à 10 %</label><br />
					<input type="radio" name="habitants" value="medium11-25" id="medium11-25" /> <label for="medium11-25">Entre 10 et 25%</label><br />
					<input type="radio" name="habitants" value="medium25-50" id="medium25-50" /> <label for="medium25-50">Entre 25 et 50 %</label><br />
					<input type="radio" name="habitants" value="medium50-75" id="medium50-75" /> <label for="medium50-75">Entre 50 et 75 %</label><br />
					<input type="radio" name="habitants" value="medium75-99" id="medium75-99" /> <label for="medium75-99">Inférieur à 100 %</label><br />
					<input type="radio" name="habitants" value="plus99" id="plus99" /> <label for="plus99">Egal à 100 %</label>
					
						<h5 >Source de financement :</h5>
					<INPUT type="checkbox" name="finance[]" value="FNDR"> Ligne 2</INPUT>
					<INPUT type="checkbox" name="finance[]" value="FSAEPEA"> Ligne 3</INPUT> 
					<INPUT type="checkbox" name="finance[]" value="PSD-FORETS"> PSD-FORETS</INPUT> 
					<INPUT type="checkbox" name="finance[]" value="PSD-PARC"> PARC TAZA</INPUT></br>
					 
					<INPUT type="checkbox" name="pv" value="oui"> PV définitif</INPUT> 
 
					</br> 
				<div class="col-sm-offset-1 col-sm-11">
					<button type="submit" class="btn btn-default" id="submit" name="submit">Envoyer</button>
					
				</div>
		<div>
		
		</div>
		</form>
	</div>


<div>
<table class =" projet table-bordered">
	<thead  position= "fixed" >
<tr  >
		<th> Code du projet </th>
		<th> Année </th>
		<th> Communes </th>
		<th> Localités </th>
 		<th> Taux de paiement </th>
 		<th> Montant global </th>
 		<th> Paiement </th>
 		<th> Programme </th>
		<th> Actions du projet </th>
	    <th> cloture du projet </th>

</tr>
</thead>
<tbody>
	 
<?php 
 
	   $result  = $CODE->fetchAll(PDO::FETCH_OBJ);

 
 foreach ( $result as $data) {
?>
<tr>	<td> <?php echo $data->code_du_ppdri;?></td>
		<td> <?php echo $data->annee  ;?></td>
		<td> <?php echo $data->commune  ;?></td>
		<td> <?php echo $data->localite ; ?></td>
 		<td> <?php echo  $data->tauxpaiemant ; ?> %</td>
 		<td> <?php echo  $data->qq; ?> </td>
 		<td> <?php echo  $data->qq; ?> </td>
		<td> <?php echo $data->type_de_programme  ;?></td>
		<td> <a href="actionsProjet.php?Code_du_PPDRI=<?php echo $data->code_du_ppdri ;?>"> Voir le détail  </a> </td>
	 <td> <a href="cloture.php?Code_du_PPDRI=<?php echo $data->code_du_ppdri ;?>"> cloture du projet  </a> </td>
</tr>
<?php
}
?>
 </tbody>	
</table>
</body>
</div>
</div>
