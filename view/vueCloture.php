
<?php 
/*
la vue
*/

 
if(isset($_POST['submit_docs'])){

	header("Content-type: application/vnd.ms-word");
 
  
//$clotureDocument = $nomLocalite.".doc";
//var_dump($clotureDocument);
 header("Content-Disposition: attachment;Filname =".rand().".docx");
header("Pragma:no-cache");
header("Expires:0");


}
 

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
		<p   align="center">République Algérienne démocratique et populaire</p> 
<p align="center"> Ministère de l’Agriculture  et du Développement Rurale etde la Péche</p> 
<p align="center"> Direction Générale des Forêts</p>
<p align="center"> Conservation des forêts de la wilaya de JIJEL</p>
<p align="center">    <font size="4" color="red"  >    Décision de fin de projet de proximité de développement rural intégré </font></p> 

	</head>
	<body>
	
  
 	<div> 


<p> Année du programme : <?php  echo '<font size="3" color="red"  >  '.$annee.'</font>' ;  ?> </p>  
<p> Vu le PV du CARC en date   <?php  echo '<font size="3" color="red"  >  '.$formulation.'</font>' ;  ?> </p>  
<p> Vu le PV du CTD en date du   <?php  echo '<font size="3" color="red"  >  '.$confirmation.'</font>' ;  ?> </p>  
<p> Vu le PV du CTW en date du   <?php  echo '<font size="3" color="red"  >  '.$validation.'</font>' ;  ?> </p>  
<p>Je soussigné Monsieur le Conservateur des forets de la wilaya de Jijel atteste par la présente :</p>

<li>-	Que le projet de proximité de développement rural intégré de <?php echo '<font size="3" color="red"  >  '.$nomLocalite.'</font>' ;  ?>  Commune de <?php echo '<font size="3" color="red">  '. $commune.'   </font>'  ;  ?> Daira de <?php echo '<font size="3" color="red">  '.$daira.'    </font>'  ;  ?> (décision n° 845 du 10/11/2010) à été réaliser totalement et en conformité  avec les prescriptions en vigueur, tel que détaillé dans l’état ci-dessous ;</li>
<li>-	Que les ouvrages à usage collectif  ont été réceptionnés  par la conservation des forêts.
<li>-	Que les actions à usage individuel ont été livrées par le Conservateur des Forêts et réceptionner par les bénéficiaires.</li>
<li>-	Qu’il a été payé, conformément aux réalisations, la somme totale de  <?php echo '<font size="3" color="red">  '.number_format($PaiementTotalLigne2->totalpaiement,2,',',' ')  .' DA  </font>' ?>  ( .... Dinars Algériens et ...... Centimes),  représentant le soutien sur le fonds (FNDR Ligne 02) et la somme totale de <?php echo '<font size="3" color="red">  '.number_format($tauxprojets->totalpaiement,2,',',' ')  .' DA  </font>' ?>   (............ Dinars Algériens et ......... Centimes),  représentant toutes les sources de financement engagées dans ce projet par le Conservateur de Forêts.</li></br>
 

<div class="table-responsive" >
<table class ="table table-hover table-bordered">
	<thead >
<tr>

 <th   >  Maitre d'ouvrage </th>
		<th   >  Nature Action </th>
		<th   >  Année </th>
		<th>  Source de Financement </th>
		<th>  Unité </th>
		<th>  Volume prévue</th>
		<th>  Volume  réalisé</th>
 		<th>  Montant Prévu Da</th>
		<th>  Paiement Da </th>
		<th>  RAR physique</th>
		<th>  RAR financier</th>
		
		<th>  Observation </th>
 </tr>
</thead>
<tbody>

<?php
  
  

foreach ( $pourcentage as $actions) {
  
 ?>
<tr>
<td text-align: left> <?php echo  stripcslashes($actions->maitre_ouvrage );?></td>
		 
		<td text-align: left> <?php echo  stripcslashes($actions->nomactions );?></td>
		<td text-align: left> <?php echo  stripcslashes($actions->annee );?></td>
		<td> <?php echo $actions->source_financement ; ?></td>
		<td> <?php echo $actions->unit ;?></td>
		<td> <?php echo number_format($actions->quantite,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->realisation_physique, 2, ',', ' '); ?></td>
 		<td> <?php echo  number_format($actions->montant,2,',',' ');?></td>
		<td> <?php echo number_format($actions->paiement,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->rarphysique,2,',',' ') ; ?></td>
		<td> <?php echo number_format($actions->rarpaiemant, 2, ',',' ') ; ?> </td>
		
			<td> <?php echo $actions->observation ; ?></td>
		 
		
</tr>
<?php
}
?>
 </tbody>	
</table>
<p>En foi de quoi, je signe la présente attestation.</p></br>
<p   align="right"  > Fait a Jijel le …………………………….</p></br>
 <p   align="right"  >  Le Conservateur  </p> </br>              


<form name="cloture" action ="cloture.php" method ="post"    >
<input type="submit"  name ="submit_docs" value="Export as Ms word" class="input-button" />
	

</form>

</body>