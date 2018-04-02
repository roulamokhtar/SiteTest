



 <div>
	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		<script type="text/javascript" src= "jquery-1.12.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


	</head>
	<body>
 		 			 

		<form method="post" id="form"  class="  formProjets" role="form" action="projets.php">
			
			<div class="form-group">
				<h4 style="text-align: center"> Formulaire de recherche </h4> 
									 
					<h5>Choisir votre commune :     </h5>
					<select name="departement" size="2">
						<?php foreach ($departements as $departement): ?>
						 <option value="<?php echo $departement['id']; ?>"><?php echo $departement['departement']; ?></option>
						<?php endforeach; ?>
					</select>
					 <h5 >Choisir une Localité :</h5>
						<SELECT  name="localite" size="2" class="dropdown"  ">
							<?php foreach ($localites as $localite): ?>
							 <option value="<?php echo $localite['ville_id']; ?>"><?php echo $localite['ville_nom_reel']; ?></option>
							<?php endforeach; ?>
						</SELECT >
					
					<h5>Choisir une Année :</h5>
					<SELECT  name="Annee" size="2">
						<?php foreach ($Annees as $Annee): ?>
						 <option value="<?php echo $Annee['annee']; ?>"><?php echo $Annee['annee']; ?></option>
						<?php endforeach; ?>
					</SELECT >
				
				
					 <h5 >Choisir un taux financier :</h5>
					 
					 <input type="radio" name="habitants" value="egal0" id="egal0" /> <label for="egal0">= à 0 %</label> 
					<input type="radio" name="habitants" value="moins10" id="moins10" /> <label for="moins10"><= à 10 %</label> 
					<input type="radio" name="habitants" value="medium11-25" id="medium11-25" /> <label for="medium11-25">Entre 10 et 25%</label>  
					<input type="radio" name="habitants" value="medium25-50" id="medium25-50" /> <label for="medium25-50">Entre 25 et 50 %</label> 
					<input type="radio" name="habitants" value="medium50-75" id="medium50-75" /> <label for="medium50-75">Entre 50 et 75 %</label> 
					<input type="radio" name="habitants" value="medium75-99" id="medium75-99" /> <label for="medium75-99"> < 100 %</label> 
					<input type="radio" name="habitants" value="plus99" id="plus99" /> <label for="plus99">=  100 %</label>
					
					<h4>Etat actions: <input type="radio" name="etat" value="validee"  /> <label class="labelinput"> Validée  </label>  
					 <input type="radio" name="etat" value="annulee"  /> <label class="labelinput"> Annulée</label>   
					 <input type="radio" name="etat" value="volumeAnnulée"  /> <label class="labelinput">  avec RAR</label> 
					  <input type="radio" name="etat" value="volumesansrar"  /> <label class="labelinput"  >sans RAR</label>  
 
					  <input type="radio" name="cloture" value="ok"   /> <label class="labelinput" >PV définitive </label>  
					 <input type="radio" name="cloture" value=""   /> <label class="labelinput"   > sans PV définitive  </label>  </h4>  
					 
					 
					 


						<h4 >Source de financement : </h4>
					<INPUT type="checkbox" name="finance[]" value="FNDR"> Ligne 2</INPUT>
					<INPUT type="checkbox" name="finance[]" value="FSAEPEA"> Ligne 3</INPUT> 
					<INPUT type="checkbox" name="finance[]" value="PSD-FORETS"> PSD-FORETS</INPUT> 
					<INPUT type="checkbox" name="finance[]" value="PSD-PARC"> PARC TAZA</INPUT></br>
					<h5 >Etat des actions Ligne 2 :</h5>

					<SELECT  name="pv" size="2">
					<option value="1">Ligne 2 cloturé</option>
					<option value="2">Ligne 2 en cours</option>
					<option value="3">Projet Annulé</option>
					<option value="4">Ligne 2 inexistante</option>	 
					</SELECT >

					  
					 <h5 >Type de Programme:

					<INPUT type="checkbox" name="programme[]" value="TBV" > TBV</INPUT> 
					<INPUT type="checkbox" name="programme[]" value="GEPF" > GEPF </INPUT> 
					<INPUT type="checkbox" name="programme[]" value="CEN" > CEN</INPUT></h5>
					<?php if(empty($circonscription)) {
						echo'';?>  <h5 >Circonscription:

					<INPUT type="checkbox" name="circonscription_foret[]" value="el aouana" >Aouana</INPUT> 
					<INPUT type="checkbox" name="circonscription_foret[]" value="taher" > Taher </INPUT> 
					<INPUT type="checkbox" name="circonscription_foret[]" value="texenna" > Texenna</INPUT> 
					<INPUT type="checkbox" name="circonscription_foret[]" value="el ancer" > Ancer </INPUT>  
					<INPUT type="checkbox" name="circonscription_foret[]" value="el milia" > Milia </INPUT></h5> 
					 <?php 	  
					}else{echo '';}?>
					
		 <button type="submit" class="btn btn-default" id="submit" name="submit">Recherche</button> 
		</form>
	 </div>


 

<table class =" projet scrollProjet  ">
	<thead  >
<tr  >
		<th> Code du projet </th>
		<th> Année </th>
		<th> Communes </th>
		<th> Localités </th>
 		<th> Taux de paiement </th>
 		<th> Situation Ligne 2</th>
 		
 		 
  		<th> Programme </th>
  	
  		 
		<th> Actions du projet </th>
	    

</tr>
</thead>
</table>
<table class =" projet scrollProjet table-bordered">
<tbody>
	 
<?php 
 
	   $result  = $CODE->fetchAll(PDO::FETCH_OBJ);
	  
	   //$count=  $result->rowCount(); 
   //var_dump($CODE);
//var_dump($result);
 foreach ( $result as $data) {

 	 		
?>
 
<tr>	<td> <?php echo $data->code_du_ppdri;?></td>
		<td> <?php echo $data->annee  ;?></td>
		<td> <?php echo $data->commune  ;?></td>
		<td> <?php echo $data->localite ; ?></td>
 		<td> <?php echo  $data->tauxpaiemant ; ?> %</td>
 		<td> <?php
 		 if($data->t <> 0 and $data->tauxpaiemant<>0){echo '<font size="1" color= "orange"  > '. $data->t.' action (s) de la ligne 2 non réceptionnée <font>';
 		 }elseif($data->t = " " and $data->z <> 0 and $data->tauxpaiemant<>0 ) {echo '<font size="1" color="green">   ligne 2 réceptionnée <font>';
 		 }elseif($data->t = " " and $data->z = " " and $data->tauxpaiemant<>0) {echo '<font size="1" color="blue"> ligne 2 non existante <font>';
}elseif($data->t = " "  and $data->z = " " and $data->tauxpaiemant==0) {echo '<font size="1" color="red"  font-weight="bold" > Projet Annulé <font>';
}
 		 ?> 



 		 </td>
		
  		<td> <?php echo $data->type_de_programme  ;?></td>
 		<td> <a href="actionsProjet.php?Code_du_PPDRI=<?php echo $data->code_du_ppdri ;?>"> Voir le détail  </a> </td>
	<?php //<td> <a href="cloture.php?Code_du_PPDRI=<?php echo $data->code_du_ppdri ;"> cloture du projet  </a> </td>?>
</tr>
<?php
}
?>

 </tbody>	
</table>
<div style=" width:  78%;    ">
<h6  style="text-align: center  ">Vous avez   <?php
  
			   echo '<font size="4" color="red"> '.number_format($stationsCount).' </font>' ; ?>

			 	  projet(s) dans 
			 	     <?php  
			 		 echo '<font size="4" color="red"> '.number_format($projetCount) .' </font>' ; ?> localité(s)  

			 		 
			 		 <?php

			 		 if(!empty($_POST["finance"])){
 echo "- Le calcule est basé sur la (les) Source(s) de financement " .'<font size="3" color="red"> '.implode("-", $_POST["finance"]). ' </font>' ;   }else{echo "Toutes sources de financement confondus";} ?> </h6>
  
</div>
			 		 
</body>
 
</div>

<?php 


/*
la vue
*/
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php");
  include_once("template/vueFooter.php");  

 ?>