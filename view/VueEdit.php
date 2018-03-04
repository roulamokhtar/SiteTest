<?php
 include_once("model/BDD.php");
include_once("model/REQUETE.php");
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php"); 
if(empty($_GET)){
	header('Location: index.php');
}
?>

<!DOCTYPE html> 
<html lang="fr"> 
	<head>	
		<meta charset="utf-8">
 <?php
 /*
     if(isset ($_POST['Modifier'])){
     	 $actions=$bdd->Projets();
        echo "<meta http-equiv='refresh' content='0; url=actionsProjet.php?Code_du_PPDRI=$r->Code_PPDRI; '>";
    }
    actionsProjets.php?Code_Action=<?php echo $r->Code_PPDRI;
    */
     ?>
		<title>Modification</title>
		
	</head>

	<body>	
       
     
           
          <div style="width:1260px; height: 380px; border: 3px solid red; left: 5px;"   >
          <h5 style="text-align:center " ; > Coummne de <?php  echo '<font size="3" color="red"  >  '. ($r->commune).'</font>'; ?> - Localite de <?php  echo '<font size="3" color="red"  >  '. ($r->localite).'</font>'; ?> - Code du PPDRI :<?php echo '<font size="3" color="red"  >  '. ($r->code_ppdri).'</font>'; ?> </h5>
           <h4  style="text-align:center";      >Actualisation </h4>


				<form method="post" action="edit.php?code_actions=<?php echo $r->code_actions;?>" class="form-horizontal formContact" role="form">
					<div class="form-group">
						<label for="inputNom" class="col-sm-2 control-label">Action :</label>
						<div class="col-sm-7	">
							<input type="text" class="form-control" id="nom" name="nom" value="<?php echo stripslashes($r->nomactions);?>" placeholder="Action">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPrenom" class="col-sm-2 control-label">Quantité prévue:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="quantite" name="quantite" value="<?php echo stripslashes($r->quantite);?>" placeholder="Quantité prévue">
						</div>
					
					<div class="form-group">
						<label for="inputMail" class="col-sm-3 control-label">Réalisation :</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="realisation_physique" name="realisation_physique" value="<?php echo stripslashes( $r->realisation_physique);?>" placeholder="Réalisation">
						</div>
					</div>
					</div>

					<div class="form-group">
						<label for="inputSujet" class="col-sm-2 control-label">Montant prévu :</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="montant" name="montant" value="<?php echo stripslashes($r->montant);?>" placeholder="Montant prévu">
						</div>
					<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Paiement :</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="paiement" name="paiement" value="<?php echo stripslashes($r->paiement);?>" placeholder="Paiement">
						</div>
					</div>					</div>

					<div class="form-group">
						<label for="inputSujet" class="col-sm-2 control-label">Date de cloture :</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="cloture" name="cloture" value="<?php echo stripslashes($r->cloture);?>" placeholder="Date de cloture">
						</div>
					
					
					<div class="form-group">
						<label   for="inputSujet" class="col-sm-3 control-label">Observation :</label>
						<div class="col-sm-4">
 							<textarea  class="form-control"  id="observation" name="observation" value="<?php echo stripslashes($r->observation);?>" placeholder="Observation">
						</textarea>
						</div>
					</div>
 						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="Modifier" class="btn btn-default">Envoyer</button>
 					</div></div>

				</form>

			 </div>
			 
			 
          
        
      

    
<?php
$code=$_GET["code_actions"];
    $nomelevage=$bdd->elevage($code);
 
 if(!empty($nomelevage)){

?>
 
 <div class="beneficiare" > 
	 <h4 style="text-align:center"; >  Liste des bénéficiaires</h4>  
	
  <table class ="   scrollbeneficiare table-bordered">  

 <thead  > 
		 <tr  >
				 
				<th> nom  </th>
				<th> programme  </th>
				<th> commune  </th>
				<th> Localité </th>
 				<th> Type elevage </th>
				<th> Montant </th>
				<th> N° ASF </th>
				<th>Date ASF </th>
				<th>Date PV </th>
				<th>Agence</th>
				<th>Date de paiement</th>
		</tr>
</thead>

	</table>
		<table class =" scrollbeneficiare table-bordered">
			<tbody>
	 
<?php

$code=$_GET["code_actions"];
    $nomelevage=$bdd->elevage($code);
      $Paiementelevage=$bdd->SommPaiementelevage($code);
            $NombreBeneficiaireElevage=$bdd->NombreBeneficiareElevage($code);
      
 foreach ( $nomelevage as $result ) {	 		
		?>
		<tr>	
			 
			<td> <?php echo ($result->NOMS__ET__PRENOMS ) ;?></td>
			<td> <?php echo ($result->Programme ) ;?></td>
			<td> <?php echo ($result->COMMUNE ) ;?></td>
			<td> <?php echo ($result->LOCALITE ) ;?></td>
 			<td> <?php echo $result->TYPE_ELEVAGE  ;?></td>
			<td> <?php echo $result->asf ; ?></td>
			<td> <?php echo $result->N_ASF ; ?></td>
			<td> <?php echo $result->DATE_ASF ; ?></td>	 
			<td> <?php echo $result->date_pv ; ?></td>
			<td> <?php echo $result->agence ; ?></td>
			<td> <?php echo $result->DATE_PAIEMENT ; ?></td>

		</tr>
		<?php
		}
		?>
 		</tbody>
 			
		</table>
			<div> Montant Total est de <?php echo '<font size="3" color="red"  "font-weight:bold"> '. number_format($Paiementelevage->montant,2,',',' ').' </font>'  ;    ?>Da - Le nombre de bénéficiaires est de <?php echo '<font size="3" color="red"  "font-weight:bold"> '. number_format($NombreBeneficiaireElevage->beneficiare,0,',',' ').' </font>'  ;    ?> </div>	 
	 
		</div> 
 
<?php
 }
?>



			</body>
			</div>  
		</html>
