<?php
 include_once("../model/BDD.php");
include_once("../model/REQUETE.php");
if(empty($_GET)){
	header('Location: index.php');
}

if(!empty($_GET)){
	extract($_GET);

if(!empty($_POST)){
  extract($_POST);
  $valid=true;
  
  if($valid){
$bdd = new REQ();
   
$req = $bdd->prepare('UPDATE realisation_physique, realisation_financiere SET NomActions=:NomActions, Quantite=:Quantite, realisation_physique=:realisation_physique,
  Montant =:Montant , Paiement=:Paiement WHERE Code=".$_GET["Code"]');
$req->execute(array(
	'NomActions'=>UTF8_decode(addslashes($NomActions)),
	'Quantite'=>addslashes($Quantite),
	'realisation_physique'=>UTF8_decode(addslashes($realisation_physique)),
	'Montant'=>UTF8_decode(addslashes($Montant)),
	'Paiement'=>UTF8_decode(addslashes($Paiement)),
	'Code'=>$p
    ));
    $req->closeCursor();
 
				$req->execute();
				$data = $req->fetch();
				$NomActions = $data['NomActions'];
				$Quantite = $data['Quantite'];
				$realisation_physique = $data['realisation_physique'];
				$Montant = $data['Montant'];
				$Paiement=$data['Paiement'];
				$req->closeCursor();
   
  }
}
}

?>

<!DOCTYPE html> 
<html lang="fr"> 
	<head>	
		<meta charset="utf-8">

		<title>XML et Google Map</title>
		<meta name="description" content="test Google Map !">
		<meta name="keywords" content="Google Map !">
		<meta name="author" content="r">
		<meta name="geo.placename" content="FHGHGHGH">

		<link rel="stylesheet" href="../css/html.css">
		<link rel="stylesheet" href="../css/style.css" />
	</head>

	<body>
		<div id="header"></div>
		<div id="content">
			<h1>Modification</h1>
			<a href="admin.php">Administration</a>

			<?php

$bdd = new REQ();
$req  = $bdd->getBdd()->prepare("SELECT * FROM action, realisation_physique, realisation_financiere  WHERE
 realisation_physique.Code = action.Code_Action AND realisation_financiere.Code =action.Code_Action AND Code =:Code");
				$req ->execute();
				$data = $req->fetch();
				$NomActions = $data['NomActions'];
				$Quantite = $data['Quantite'];
				$realisation_physique = $data['realisation_physique'];
				$Montant = $data['Montant'];
				$Paiement=$data['Paiement'];
				$Code=$data['Code'];
				$req->closeCursor();
			?>
			<form name="edit" action="edit.php?p=<?php echo $p;?>" method="post">
			<label for="titre">Action :</label>
			<input type="text" name="Localite" value="<?php echo stripslashes($NomActions);?>" /></br></br>

			<label for="titre">Quantité prévue :</label>
			<input type="text" name="latitude" value="<?php echo stripslashes($Quantite);?>" />

			<label for="titre">Réalisation	 :</label>
			<input type="text" name="latitude" value="<?php echo stripslashes($realisation_physique);?>" />
			
			<label for="titre">Montant prévu		 :</label>
			<input type="text" name="latitude" value="<?php echo stripslashes($Montant);?>" />

			<label for="titre">Paiement			 :</label>
			<input type="text" name="latitude" value="<?php echo stripslashes($Paiement);?>" />

			

			<input id="ok" type="submit" name="envoyer" value="Modifier" />
			</form>
		</div>
	</body>
</html>
