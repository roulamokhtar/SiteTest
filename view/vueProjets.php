
<?php 


/*
la vue
*/
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php"); 
include_once("template/vueFooter.php");


 ?>


  
	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		 <script type="text/javascript" src="common/js/form/jquery.validate.min.js"></script>
		<script type="text/javascript" src="common/js/form/additional-methods.min.js"></script>
		<script src="common/js/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="common/js/bootstrap.min.js"></script>

	
	
	 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
     
 select.foo   { width: 10em }
 
    . thead{
    	 background-color: green;
    }
.table-fixed thead {
  width: 100%;

   
  border-radius: 5px;
}
 
.table-fixed tbody {
  height: 200px;
  overflow-y: auto;
  width: 100%;
  
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}
 
</style>
	</head>
	<body>
 		 	 
<div class="container">
	 
		<form method="post" id="form" class="form-horizontal"   action="projets.php" >
			<div>
			<legend style="text-align: center; padding-top:  50px; ">             Formulaire de recherche </legend>  
			</div>
			<div class="form-group"> 
				<label class="col-sm-1 control-label"> Commune    </label> 
				<div class="col-sm-2">
					<select name="departement" class="foo" size="2">
						<?php foreach ($departements as $departement): ?>
						 <option value="<?php echo $departement['id']; ?>"><?php echo $departement['departement']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

			
				 <label class="col-sm-1 control-label">  Localité </label>
				 <div class="col-sm-2"> 
					<select  name="localite"   size="2" class="foo"   >
						<?php foreach ($localites as $localite): ?>
						<option value="<?php echo $localite['ville_id']; ?>"><?php echo $localite['ville_nom_reel'];?></option>
						<?php endforeach; ?>
					</select >
					</div>
			

				<label class="col-sm-1 control-label"> Année </label>
				<div class="col-sm-1"> 
					<select  name="Annee" size="2">
						<?php foreach ($Annees as $Annee): ?>
						 <option value="<?php echo $Annee['annee']; ?>"><?php echo $Annee['annee']; ?></option>
						<?php endforeach; ?>
					</select >
				</div>


				<label class="col-sm-1 control-label"> Ligne 2</label> 
				<div class="col-sm-2">
					<SELECT  name="pv" class="foo"size="2">
					<option value="1">Ligne 2 cloturé</option>
					<option value="2">Ligne 2 en cours</option>
					<option value="3">Projet Annulé</option>
					<option value="4">Ligne 2 inexistante</option>	 
					</SELECT>
				</div>
			 
				
			</div>

			<div class="form-group">		
				<label class="col-sm-2 control-label"> Taux financier </label> 
				<div class="col-sm-10">	 
					 <input type="radio" name="habitants" value="egal0" id="egal0" /> <label for="egal0">= à 0 %</label> 
					<input type="radio" name="habitants" value="moins10" id="moins10" /> <label for="moins10"><= à 10 %</label> 
					<input type="radio" name="habitants" value="medium11-25" id="medium11-25" /> <label for="medium11-25">Entre 10 et 25%</label>  
					<input type="radio" name="habitants" value="medium25-50" id="medium25-50" /> <label for="medium25-50">Entre 25 et 50 %</label> 
					<input type="radio" name="habitants" value="medium50-75" id="medium50-75" /> <label for="medium50-75">Entre 50 et 75 %</label> 
					<input type="radio" name="habitants" value="medium75-99" id="medium75-99" /> <label for="medium75-99"> < 100 %</label> 
					<input type="radio" name="habitants" value="plus99" id="plus99" /> <label for="plus99">=  100 %</label>
				</div>
			</div>
			<div class="form-group">		
				<label class="col-sm-2 control-label"> Etat actions</label>
				<div class="col-sm-10"> 
					 <input type="radio" name="etat" value="validee" /> <label class="labelinput"> Validée  </label>
					<input type="radio" name="etat" value="annulee"/> <label class="labelinput"> Annulée</label>   
					<input type="radio" name="etat" value="volumeAnnulée"/> <label class="labelinput">avec RAR</label> 
					<input type="radio" name="etat" value="volumesansrar"/> <label class="labelinput">sans RAR</label>
 					<input type="radio" name="cloture" value="ok"   /> <label class="labelinput" >PV définitive </label>  
					<input type="radio" name="cloture" value=""   /> <label class="labelinput">sans PV définitive  </label>
				</div>    
			</div>
			<div class="form-group">		 
				<label class="col-sm-2 control-label"> Source financement </label>
				<div class="col-sm-4"> 
					<input type="checkbox" name="finance[]" value="FNDR"> Ligne 2</input>
					<input type="checkbox" name="finance[]" value="FSAEPEA"> Ligne 3</input> 
					<input type="checkbox" name="finance[]" value="PSD-FORETS"> PSD-FORETS</input> 
					<input type="checkbox" name="finance[]" value="PSD-PARC"> PARC TAZA</input>
				</div>

				<label class="col-sm-1 control-label">Programme</label> 
				<div class="col-sm-4">
					<INPUT type="checkbox" name="programme[]" value="TBV" > TBV</INPUT> 
					<INPUT type="checkbox" name="programme[]" value="GEPF" > GEPF </INPUT> 
					<INPUT type="checkbox" name="programme[]" value="CEN" > CEN</INPUT>
					</div>
			</div>	

			<div  class=" form-group">
				<div class="   col-sm-1 ">
				<button type="submit" class="btn btn-danger" id="submit" name="submit">Recherche</button> 
		 		</div>
		 	</div>
		</form>
</div>
	 
 <div class="container-fluid">

<table  class="table table-border table-responsive table-fixed  table-hover table-streped ">
	<thead  >
	<div class="form-group" >
	<tr  >
		<th   class="col-sm-2"> Code du projet </th>
		<th  class="col-sm-1"> Année </th>
		<th  class="col-sm-2"> Communes </th>
		<th  class="col-sm-2"> Localités </th>
 		<th  class="col-sm-1"> Taux de paiement </th>
 		<th  class="col-sm-2"> Situation Ligne 2</th>
   		<th  class="col-sm-1"> Programme </th>
  		<th  class="col-sm-1"> Détails </th>
 </tr>
	 
 </div>
 
	</thead>
	 
	 
 
<tbody>
	

 
<tr>
<?php 
 $result  = $CODE->fetchAll(PDO::FETCH_OBJ);
	  
 foreach ( $result as $data) {

 	 		
?> 
	<td class="col-sm-2"> <?php echo $data->code_du_ppdri;?></td>
		<td class="col-sm-1"> <?php echo $data->annee  ;?></td>
		<td class="col-sm-2"> <?php echo $data->commune  ;?></td>
		<td class="col-sm-2"> <?php echo $data->localite ; ?></td>
 		<td class="col-sm-1"> <?php echo  $data->tauxpaiemant ; ?> %</td>
 		<td class="col-sm-2"> <?php
 		 if($data->t <> 0 and $data->tauxpaiemant<>0){ echo '<font   color= "orange"  > '. $data->t.' action (s) de la ligne 2 non réceptionnée <font>';
 		 }elseif($data->t = " " and $data->z <> 0 and $data->tauxpaiemant<>0 ) {echo '<font   color="green">   ligne 2 réceptionnée <font>';}elseif($data->t = " " and $data->z = " " and $data->tauxpaiemant<>0) {echo '<font   color="blue"> ligne 2 non existante <font>';}elseif($data->t = " "  and $data->z = " " and $data->tauxpaiemant==0) {echo '<font   color="red"   > Projet Annulé <font>';}?> 
 </td>
		
  		<td class="col-sm-1"> <?php echo $data->type_de_programme  ;?></td>
 		<td class="col-sm-1"> <a href="actionsProjet.php?Code_du_PPDRI=<?php echo $data->code_du_ppdri ;?>"> Voir le détail  </a> </td>
	 
</tr>
<?php
}
?>

 </tbody>	
</table>
 </div>
<h4  style="text-align: center  ">Vous avez   <?php
  
			   echo '<font size="4" color="red"> '.number_format($stationsCount).' </font>' ; ?>

			 	  projet(s) dans 
			 	     <?php  
			 		 echo '<font size="4" color="red"> '.number_format($projetCount) .' </font>' ; ?> localité(s)  

			 		 
			 		 <?php

			 		 if(!empty($_POST["finance"])){
 echo "- Le calcule est basé sur la (les) Source(s) de financement " .'<font size="3" color="red"> '.implode("-", $_POST["finance"]). ' </font>' ;   }else{echo "Toutes sources de financement confondus";} ?> </h4>
  
</div>
			 		 
</body>
 

 
</div>
 