<?php
session_start();
include_once("model/BDD.php");
include_once("model/Map.php");
include_once("model/REQUETE.php");
$map=new Map();
$bdd = new REQ();

 
 if($_SESSION['name'] !=="ADMIN"){
      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }
 $nomC=$map->getNomDepartements($circonscription);
$nomCommune=$nomC->nom_departement;
//var_dump($nomC);
 //var_dump($nomCommune);
		$departements = $map->getDepartements( $circonscription); //_On affiche les départements dans une liste déroulante
		//var_dump($departements);
		$Annees=$map->getAnnee();
		$Nomactions=$map->getAction();
		//Nom de l'action qui doit etre afficher dans de le resultat $Nomact
		if(isset($_POST['nomactions'])){
		$Nomact =$map-> getNomAction();
}else{
	$Nomact="";
}
 
		if(!empty($_POST)){	
			extract($_POST);
			
			if(!empty($departement )) {
				$departement = $_POST['departement'];
				
			} else {
				$departement = "";
				
			}

			if(!empty($annee )) {
				$annee = $_POST['annee'];



				
			} else {
				$annee = "";
				
			}

if(!empty($nomactions )) {
				$nomactions = $_POST['nomactions'];

				
			} else {
				$nomactions = "";
 			}

 			if(!empty($cloture )) {
				$cloture = $_POST['cloture'];

				
			} else {
				$cloture = "";
 			}
 
 // 


			 
//var_dump($nomactions);


			if(!empty($_POST["finance"])) 
			{
				 
				foreach($_POST["finance"] as $finance) {
					 $finance ;
				
			}}else{

				$finance = "";
				
			}
	   
if(!empty($physique )) {
				$physique = $_POST['physique'];
				if($physique==="00"){

 $etatAction= "Action non entammée";
				}elseif($physique==50){
 $etatAction="inférieur ou égal  à 50 %";
				}elseif($physique==75){
 $etatAction= "inférieur ou égal  à 75 %";
				}elseif($physique==99){
 $etatAction= "inférieur ou égal  à 99 %";

				}elseif($physique==100){
 $etatAction= "Action Términée";

				}

			} else {
				$physique = "0";
				
			}
			

			
			if(!empty($habitants)){
			
			$habitants = $_POST['habitants'];
			
			switch ($habitants) {

					case "egal0":
         			 //$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
          			 $CODE= $bdd->realisationaction0( 0, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
$nombreactiontrouve= $bdd->realisationaction0TROUVE(0, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantactiontrouve= $bdd->MONTANTrealisationaction0TROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
$montantprevutrouve= $bdd->MONTANTprevuaction0TROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
$PhysiquerealisationactionTROUVE= $bdd->Physiquerealisationaction0TROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
$PhysiqueprevuactionTROUVE =$bdd-> Physiqueprevuaction0TROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
           			  
          			break;
				
					case "moins10":
					//$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
					 $CODE= $bdd->realisationaction(0, 10, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription); 
$nombreactiontrouve= $bdd->realisationactionTROUVE(0, 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0,10, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
           			
					break;
				case "moins25":
					//$stations = $map->getVillesTaux(10, 25, $departement,$Annee);
					 $CODE= $bdd->realisationaction(0, 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
$nombreactiontrouve= $bdd->realisationactionTROUVE(0, 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0,25, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
	    			 
					break;
				case "moins50":
				//	$stations = $map->getVillesTaux(25, 50, $departement,$Annee);
					 $CODE= $bdd->realisationaction(0, 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE(0, 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);

 $PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0,50, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
	    		 
					break;
				case "moins75":
					//$stations = $map->getVillesTaux(50, 75, $departement,$Annee);
 				    $CODE= $bdd->realisationaction(0, 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE(0, 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);

	$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
       			 
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0,75, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);	       			  
					break;
				case "inferieur100":
					//$stations = $map->getVillesTaux(75, 99, $departement,$Annee);
 				    $CODE= $bdd->realisationaction(0, 99.99, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
					$nombreactiontrouve= $bdd->realisationactionTROUVE(0, 99.99, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, 99.99, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, 99.99, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);

$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, 99.99, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0,99.99, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);
					  
	       			 
					break;
				case "100":
					//$stations = $map->getVillesTaux(99, null, $departement,$Annee);
 				    $CODE= $bdd->realisationaction(100, 100, $departement,$annee,$finance,$physique,$nomactions,$cloture); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE(100, 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(100, 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(100, 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(100, 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);

$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(100,100, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);	    			  
					break;	
			}
			}else {
				 	$habitants="";
					//$stations = $map->getVillesTaux(NULL,NULL,$departement,$Annee);
 				    $CODE= $bdd->realisationaction(NULL,NULL, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription); 
					$nombreactiontrouve= $bdd->realisationactionTROUVE(NULL,NULL, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(null, null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(null, null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);

$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(null, null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$circonscription);
	    			   
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(null,null, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$circonscription);	    			 

				  }

				  //////////////////
		} else {
			$nbVille = 284;
			$nbLocalite = 217;
			//$stations = $map->getVillesTaux();
			  $CODE= $bdd->realisationaction(null,null, null,null,null,null,null ,null,$circonscription);
			   $nombreactiontrouve= $bdd->realisationactionTROUVE(null,null, null,null,null,null,null ,null,$circonscription);
			   $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(null,null, null,null,null,null,null ,null,$circonscription);
			   $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(null,null, null,null,null,null,null ,null,$circonscription);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(null,null, null,null,null,null,null ,null,$circonscription);
 $PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(null,null, null,null,null,null,null ,null,$circonscription);}?><?php include_once("view/VueExport.php"); ?>
