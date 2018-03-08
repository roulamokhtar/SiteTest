
<?php 
/*
la vue
*/
include_once("model/REQUETE.php");
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
	
 	<div> 
<br/>
 	<strong> <u>Statistique du PPDRI</u>: Localité:<?php echo '<font size="3" color="red"  >  '.$nomLocalite.'</font>' ;  ?> code du projet: <?php echo '<font size="3" color="red">  '. $codeProjet.'   </font>'  ;  ?> Commune de : <?php echo '<font size="3" color="red">  '. $commune.'   </font>'  ;  ?>  </strong>
 	</div>
 <div><p>  Nombre d'actions trouvés: <?php 

if($tauxprojets!=null){
 	  
  echo '<font size="3" color="red">  '. $s .'   </font>'  ;  
 	}else{
 		echo  '<font size="3" color="red">  '."0".' </font>';
 	}
 	?>
 </p>


  
 <div><p> 
 Montant total du projet est de : <?php
 if($tauxprojets!=null){
 	  
echo '<font size="3" color="red">  '. number_format($tauxprojets->montantprojet,2,',',' ') .' DA  </font>'   ; 
 	}else{
 		echo  '<font size="3" color="red">  '."0".' </font>';
 	}
 	?>
 </p>

<div><p> Montant des paiement est de :<?php
if($tauxprojets!=null){
 	  
echo '<font size="3" color="red">  '.number_format($tauxprojets->totalpaiement,2,',',' ')  .' DA  </font>'; 
 	}else{
 		echo  '<font size="3" color="red">  '."0".' </font>';
 	}
 	?>


 </p>



<div><p> Taux financier du projet  est de : <?php echo '<font size="3" color="red">  '.number_format($tauxfinanciertotal,2,',',' ')  .' %  </font>' ?>  </p></div>


<div> <p> Etat de cloture :   <?php if ($NombreclotureActions !==0 ){echo '<font size="3" color="red">  '.$NombreclotureActions.' </font>' ;} 
//if($Nombre_cloture=0){echo '<font size="3" color="red">  '. $Nombre_cloture .' </font>'; } 
if($status==="Action(s) Ligne 2 non réceptionnée(s)"){
echo '<font size="3" color="Orange">  '.$status.'</font>';
}elseif($status==="Projet ne contienant pas d'actions Ligne 2"){
echo '<font size="3" color="blue">  '.$status.'</font>';
}elseif($status==="Action(s) Ligne 2 réceptionnée(s)"){
echo '<font size="3" color="green">  '.$status.'</font>';
}elseif($status==="Projet annulée"){
echo '<font size="3" color="red">  '.$status.'</font>';
}
  


?>

 </p>


 </div>


<h4 align="center"> <a href="SuiviEvaluation.php?Code_du_PPDRI=<?php echo $codeProjet  ; ?>"> Cadre logique du projet en cours </a></h4>


<div class="table-responsive" >

<form method="post" role="form" name="source " class="formProjets"  action="actionsProjet.php?Code_du_PPDRI=<?php echo $codeProjet;?>" >
					 <label> Choisir une source de financement</label></br>
					<select name="source" size="2" >
						
						<option   > FNDR   </option>
						<option   > FSAEPEA   </option>
						<option   > PSD-FORETS   </option>
						<option   > PARC TAZA   </option>
						<option   > PCD   </option>
						<option   > FONAL   </option>
						<option   > PSD-HYDRAULIQUE   </option>
						 <option value="" >    </option>
					</select>

					<h4>Etat actions </h4>  
					 
					 <input type="radio" name="etat" value="validee"  /> <label class="labelinput"  > Validée  </label>  
					 <input type="radio" name="etat" value="annulee"  /> <label class="labelinput"  >Action Annulée</label>   
					 <input type="radio" name="etat" value="volumeAnnulée"  /> <label class="labelinput"   > Action avec RAR</label> </br>
					  <input type="radio" name="etat" value="volumesansrar"  /> <label class="labelinput"  > Action sans RAR</label>  
 
					  <input type="radio" name="etat" value="ok"   /> <label class="labelinput"   >PV définitive </label>  
					 <input type="radio" name="etat" value="non"   /> <label class="labelinput"   > sans PV définitive  </label> </br>
<button type="submit" class="btn btn-default" id="submit" name="submit">Envoyer</button></br>		
				</form>

<div>
<?php
$req=$bdd->realisation();
  
 	 

     


if(!empty ($_POST['source']) and isset ($req )){
	$selected= $_POST['source'] ;

echo   "Resultat pour la source de financement:" .'<font size="4" color="red">  '. $_POST['source'].'</font>'; 

}elseif(!empty ($_POST['source']) AND $s === 0 ){
echo '<font size="4" color="red">   Aucune action trouvée </font>' ;

}
elseif(!isset($_POST['source'])  ){
echo "";



}
	?>
	
</div>


<?php if( $a=$bdd->tauxAction() ){?>

<div   >
<table class =" action scroll table table-hover  ">
	<thead >
<tr>

 		<th   >  Action </th>
		<th>  Unité </th>
		<th>  Quantité prévue</th>
		<th>  Réalisation</th>
		<th>  taux physique</th>
		<th> Montant prévu  </th>
		<th>  Paiement   </th>
		<th>  taux financier</th>
		<th>  Financement </th>
		<th>  Pv de Récéption définitive </th>
		<th>  Observation </th>
		<th> Détail </th>
</tr>
</thead>
<tbody>

<?php
  
  

foreach ( $a as $actions) {
  
 ?>
<tr>

 		<td text-align: left> <?php echo  stripcslashes($actions->nomactions );?></td>
		<td> <?php echo $actions->unit ;?></td>
		<td> <?php echo number_format($actions->quantite,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->realisation_physique, 2, ',', ' '); ?></td>
		<td> <?php echo number_format($actions->tauxphysique,2, ',', ' ')   ; ?> %</td>
		<td> <?php echo  number_format($actions->montant,2,',',' ');?></td>
		<td> <?php echo number_format($actions->paiement,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->tauxpaiemant, 2, ',',' ') ; ?> %</td>
		<td> <?php echo $actions->source_financement ; ?></td>
		<td> <?php echo $actions->cloture ; ?></td>
			<td> <?php echo $actions->observation ; ?></td>
		<td> <a href="edit.php?code_actions=<?php echo $actions->code_actions;?>"> Modifier  </a> </td>
		
</tr>
<?php
}
}else {echo "il n'ya pas d'actions";}
?>

 </tbody>	
</table>
</body>
