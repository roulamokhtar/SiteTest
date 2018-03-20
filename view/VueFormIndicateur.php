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
 
		<title>Modification</title>
		

	</head>

	<body>	
 
<div class="container">

      <div class="container-fluid">
      <div class="row">
        <div class="col-sm-14 main">
          <h2 class="page-header" style="text-align: center">Fiche de l'IOV du projet en cours  </h2>

          <h4 class="page-header" style="text-align: center"> <a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Retour à la page précédente</a>
  Projet  de : <?php echo  '<font size="3" color="red">'.$r->localite. '</font>'  ?> - Code du projet :<?php  echo  '<font size="4" color="red">'.$r->code_projet .'</font>'  ?> </h3>

          
          <div class="form">
				<form method="post" action="Indicateurs.php?ID=<?php echo $r->id;?>&code_projet=<?php echo $r->code_projet ;?>" class="form-horizontal formContact" role="form">
					<div class="form-group">
						<label for="inputNom" class="col-sm-3 control-label">Code Indicateur de base:</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" id="codeindicateur" name="codeindicateur" value="<?php echo stripslashes($r->codeindicateur);?>" placeholder="Action">
						</div>
					</div>
					<div class="form-group">
						<label for="inputNom" class="col-sm-3 control-label"> Indicateur de base:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="indicateur" name="indicateur" value="<?php echo stripslashes($r->indicateur);?>" placeholder="Indicateur de base">
						</div>
					</div>


					<div class="form-group">
						<label for="inputPrenom" class="col-sm-3 control-label">Indicateur specifique  :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="indicateurs_specifique" name="indicateurs_specifique" value="<?php echo stripslashes($r->indicateurs_specifique);?>" placeholder="Indicateur spécifique pour ce projet">
						</div>
					</div>
					<div class="form-group">
						<label for="inputMail" class="col-sm-3 control-label">Unite :</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="Unite" name="Unite" value="<?php echo stripslashes( $r->unite);?>" placeholder="Unite">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Base 2010 2014 :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="Base_2010_2014" name="Base_2010_2014" value="<?php echo stripslashes($r->base_2010_2014);?>" placeholder="Indicateur de base 2010 2014">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Valeurs Cumulatives :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="ValeursCumulatives" name="ValeursCumulatives" value="<?php echo stripslashes($r->valeurscumulatives);?>" placeholder="Valeurs Cumulatives">
						</div>
					</div>

						<div class="form-group">

						<label for="inputSujet" class="col-sm-3 control-label">Frequence :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="paiement" name="paiement" value="<?php echo stripslashes($r->frequence);?>" placeholder="Frequence">
						</div>
					</div>
						<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Données Méthodologie :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="paiement" name="paiement" value="<?php echo stripslashes($r->sourcesdonneesmethodologie);?>" placeholder="Méthodologie de collecte de données">
						</div>
					</div>
						<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Responsabilité Collecte Données :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="paiement" name="paiement" value="<?php echo stripslashes($r->responsabilitecollectedonnees);?>" placeholder="Qui Collecte les données ?">
						</div>
					</div>
						<div class="form-group">
						<label for="inputSujet" class="col-sm-3 control-label">Description :</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="paiement" name="paiement" value="<?php echo stripslashes($r->description);?>" placeholder="Description">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="Modifier" class="btn btn-default">Envoyer</button>
						</div>
					</div>

				</form>

			</div>
			
			 
          
        </div>
      </div>
    </div>

    </div>



			


	</body>
</html>
