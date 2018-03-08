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
		<link rel="stylesheet" href="../css/style.css" />
		<link rel="stylesheet" href="../css/html.css">
		<link rel="stylesheet" href="../css/bootstrap.css" />
	</head>
	<body>
	
 	<div> <a href="">Retour aux actions</a>  </div>
 
<div class="table-responsive" >
<table class ="table table-hover table-bordered">
	<thead >
<tr>
		<th> Action </th>
		<th>  Quantité prévu</th>
		<th>  Réalisation</th>
		<th> Montant prévu </th>
		<th> Paiement </th>
		<th> Modifier </th>
</tr>
</thead>
<tbody>
<tr>		
		<td> <?php echo $a->NomActions;?></td>
		<td> <?php echo $a->Quantite; ?></td>
		<td> <?php echo $a->realisation_physique	; ?></td>
		<td> <?php echo $a->Montant ;?></td>
		<td> <?php echo $a->paiement ; ?></td>
		<td> <a href="edit.php?Code=<?php echo $a->Code  ;?>">Modifier</a> </td>
		
</tr>

?>
 </tbody>	
</table>
</body>