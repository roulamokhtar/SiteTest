
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
		<link rel="stylesheet" href="common/css/style.css" />
		<link rel="stylesheet" href="common/css/html.css">
		<link rel="stylesheet" href="common/css/bootstrap.css" />
	</head>
	<body>
		<div><h4 align="center"> Suivi évaluation du projet: <?php echo '<font size="3" color="red">  '. $nomLocalite.'</font>' ; ?> </h4></div>
		<div><h4 align="center">commune de :<?php echo '<font size="3" color="red">  '.$commune.'</font>' ;  ?> </h4></div>
		<div><h4 align="center"> composante : <?php echo '<font size="3" color="red">  '. $nomComposante.'</font>' ; ?></h4></div>
		<div><h4 align="center"> Code du projet : <?php echo '<font size="3" color="red">  '. $codeProjet.'</font>' ; ?></h4></div>

 <form charset="utf-8" method="post" role="form" name="objectif_specifique "   action="suiviEvaluation.php?Code_du_PPDRI=<?php echo $url;?>" >
					<div style="text-align: center;"><a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Retour à la page précédente</a>
 <label   > Choisir un objectif spécifique Niveau Projet</label>
					<select name="objectif" size="1"  >
						<option value="" >    </option>
						<option   > Mettre en application des études d'aménagement forestier   </option>

						<option   > Elaborer des études daménagement et de développement forestier   </option>
						<option   > Préserver et restaurer les espaces forestiers dégradés   </option>
						<option   > Consolider et réhabiliter laire du barrage vert   </option>
						<option   > Réhabiliter la nappe à alfa   </option>
						<option   > Protéger et gérer de manière rationnelle les parcours   </option>
						<option   > Protéger les milieux oasiens   </option>
						<option   > Réduire la pression sur les ressources naturelles  </option>
						<option   > Réduire la superficie touchée par l'érosion hydrique  </option>
						<option   > Diversifier les moyens d’existence et améliorer les conditions de vie des populations  </option>
						<option   > Conserver les espaces naturels et les aires protégées   </option>
						<option  > Réhabiliter la faune sauvage et développer la chasse
 </option>
						<option   > Protéger le patrimoine forestier contre les incendies, les parasites et maladies  </option>

					</select>
<button type="submit" class="btn btn-default" id="submit" name="objectif_specifique">Envoyer</button></br>		
				</form>

<div></div>
<?php
 $req=$aa->suiviEvaluation();

     


if(!empty ($_POST['objectif']) and isset ($req )){
	$selected= $_POST['objectif'] ;

 	
echo   "Resultat pour  objectif spécifique Niveau Composante:" .'<font size="4" color="red">  '. $_POST['objectif'].'</font>'; 

}elseif(!empty ($_POST['objectif']) AND $nbrActions === 0 ){
echo '<font size="4" color="red">   Aucune action trouvée </font>' ;

}
elseif(!isset($_POST['objectif'])  ){
echo "";



}
	?>
	
</div>

<?php if( $a=$aa->suiviEvaluation() ){?>

<div style="  padding-left:  100px ; padding-right:00px;  width:100%;  "   >
<table  class ="scroll table-bordered ">
	<thead >
<tr>
		<th> Action </th>
		<th> Activité </th>
		<th>  Résultat</th>
		<th>  Objectif spécifique -Niveau Composante-</th>
		<th>  Objectif gobal -Niveau Composante-</th>
		<th>  Composante </th>
		<th> Indicateur de base </th>
		<th> Description de l'IOV pour ce projet</th>
</tr>
</thead>
<tbody>

<?php


foreach ($a AS $data  ) {
 
?>
<tr>		
		<td> <?php echo $data->nomactions;?></td>
		<td> <?php echo $data->activite ; ?></td>
		<td> <?php echo $data->resultat ; ?></td>
		<td> <?php echo $data->objectif_specifique ; ?></td>
		<td> <?php echo $data->og_composante ; ?></td>
		<td> <?php echo $data->type_de_programme ; ?></td>
		<td> <?php echo $data->indicateur ; ?></td>
		 <td> <a href="Indicateurs.php?codeindicateur=<?php  echo   $data->codeindicateur   ;?>&code_projet=<?php echo $data->code_du_ppdri  ;?>"> Remplir le détail IOV pour ce projet </a></td>

</tr>
<?php
}
}else {echo "il n'ya pas d'actions";}
?>

 </tbody>	
</table>
</body>