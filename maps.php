<?php
session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
   // echo 'Bonjour ' . $_SESSION['name'];

}else{

  // echo 'Bonjour ' . $_SESSION['name']; 
}
/*
 * Contrôleur de notre page de maps
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
	
	include_once("model/BDD.php");
	include_once("model/Map.php");

	$titre = "Maps";
	$page = "maps"; //__variable pour la classe "active" du menu-header
	
 

    
    	$map=new Map();
  // $s=$map->getVillesTaux();
if($_SESSION['name'] !=="ADMIN"){

      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }
		$departements = $map->getDepartements( $circonscription); //_On affiche les départements dans une liste déroulante
		$Annees=$map->getAnnee();
$localites=$map->getLocalite($circonscription);

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
			if(!empty($_POST["finance"])) 
      {
         
        foreach($_POST["finance"] as $finance) {
           $finance ;
        
      }}else{

        $finance = "";
        
      }
if(!empty($localite )) {
				$localite = $_POST['localite'];

				
			} else {
				$localite = "";
				
			}
if(!empty($etat )) {
				$etat = $_POST['etat'];

				
			} else {
				$etat = "";
 			}
 			if(!empty($cloture )) {
				$cloture = $_POST['cloture'];

				
			} else {
				$cloture = "";
 			}
  if(isset($programme )) {
        $programme  = $_POST['programme']   ;
        }else{
           $programme  = "";
        }
	   //var_dump($cloture);  

			if(!empty($habitants)){
			
			$habitants = $_POST['habitants'];
			
			switch ($habitants) {

					case "egal0":
         			 //$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
					/* $stationsCount pour le nombre de projets 
					   $projetCount pour le nombre de localoites*/
    $CODE= $map->getCODE( 150,null, $departement,$annee,$finance ,$localite,$etat,$cloture,$programme,$circonscription);
    //var_dump($CODE);
    $stationsCount1= $map->getNombreProjets0( 0, $departement,$annee,$finance,$localite,$etat,$circonscription);
    
     $stationsCount=  $stationsCount1->rowCount();  
	 
 	$projetCount = $map->getCountLocalite0( 0, $departement,$annee,$finance,$circonscription,null,$localite,$etat,null);
          			break;
				
					case "moins10":
					//$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
	$CODE= $map->getCODE(1, 10, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
 	$stationsCount = $map->getCountMaps(1, 10, $departement,$annee,$finance,$localite,$etat,$cloture,$programme,$circonscription);
 	$projetCount = $map->getCountLocalite( 1, 10,  $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;
				case "medium11-25":
					 
					 $CODE= $map->getCODE(10, 25, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
	$stationsCount = $map->getCountMaps(10, 25, $departement,$annee,$finance,$localite,$etat,$cloture,$programme,$circonscription);
   $projetCount = $map->getCountLocalite(10, 25,  $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;
				case "medium25-50":
				 
	$CODE= $map->getCODE(25, 50, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
 	$stationsCount = $map->getCountMaps(25, 50, $departement,$annee,$finance,$localite,$etat,$cloture,$programme,$circonscription);
   	$projetCount = $map->getCountLocalite(25, 50,  $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;
				case "medium50-75":
					 
 	$CODE= $map->getCODE(50, 75, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
  	$stationsCount = $map->getCountMaps(50, 75, $departement,$annee,$finance,$localite,$cloture,$programme,$circonscription);
	$projetCount = $map->getCountLocalite(50, 75, $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;
				case "inf100":
					//$stations = $map->getVillesTaux(75, 99, $departement,$Annee);
 	$CODE= $map->getCODE( 0,99.99, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
	$stationsCount = $map->getCountMaps(0,99.99, $departement,$annee,$finance,$localite,$etat,$cloture,$programme,$circonscription);
	 $projetCount = $map->getCountLocalite(0.001, 99.99, $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;
				case "egal100":
					//$stations = $map->getVillesTaux(99, null, $departement,$Annee);
 	$CODE= $map->getCODE(100, null, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
	$stationsCount = $map->getCountMaps(100, null, $departement,$annee,$localite,$finance,$etat,$cloture,$programme,$circonscription);
	$projetCount = $map->getCountLocalite(100,null,  $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);
					break;	
			}
			}else {
				 	$habitants="";
					//$stations = $map->getVillesTaux(NULL,NULL,$departement,$Annee);
 	$CODE= $map->getCODE(NULL,NULL, $departement,$annee,$finance,  $localite,$etat,$cloture,$programme,$circonscription); 
    $stationsCount = $map->getCountMaps(NULL, NULL,$departement,$annee,$finance,$localite,$etat,$cloture,$programme,$circonscription);
	$projetCount = $map->getCountLocalite(NULL, NULL, $departement,$annee,$finance,$circonscription,null,null,$localite,$etat,$cloture,NULL);

				  }

				  //////////////////
		} else {
	//$nbVille = 284;
	//$nbLocalite = 213;
			//$stations = $map->getVillesTaux();
	$CODE= $map->getCODE(NULL,NULL, null, null,null,null,null,null,null,$circonscription); 
	$stationsCount = $map->getCountMaps(NULL, NULL, null, null,null,null,null,null,null,$circonscription);
			$projetCount = $map->getCountLocalite(NULL, NULL, null,null,null,$circonscription,null,null,null,null,null,null);


   //  $stationsCount = $nbVille;
    // $projetCount= $nbLocalite;
		}

		if($stationsCount>0){
 			($stationsCount);

		}else {
			$stationsCount=0;
 			
		}
		//var_dump( $programme  );
			 	// var_dump($CODE);
		

  
		$filename= "common/js/points.json";
		
		if (file_exists($filename)){
			unlink($filename);
		}else{
			echo "le fichier json n'existe pas.<br />";
		}
  


		$id = $stationsCount[0]+1;
		$json = 'marker = [';

		
		while (  $result  = $CODE->fetch(PDO::FETCH_OBJ)){
			$id--;
			$json .= "[";
			$json .= number_format($result->latitude,5).",";//0
			$json .= number_format($result->longitude,5).",";//1
			
			if(!empty($result->localite)){
				$json .= '"'.utf8_decode($result->localite).'",';//2
		}
			 
			if(!empty($result->tauxPaiemant) ){
				$json .= number_format($result->tauxPaiemant,2).",";//3
			} 
			else {
				$json .= '"",';
			}
			 
			$json .= '"'.utf8_decode($result->codedesprojets).'",';//4

					if(!empty($result->annee)){
				
			$json .= $result->annee.",";//5

			}
			else {
				$json .= '"",';
			}
			 

			$json .= '"'.utf8_decode($result->type_de_programme).'",';//6
			
			

			$json .= '"'.utf8_decode($result->id).'",';//7

$json .= '"'.utf8_decode($result->ccode).'",';//8
$json .= '"'.utf8_decode($result->nombreprojets).'",';//9
 

 
	 $json .= '"'.utf8_decode($result->financement).'",';//10
 
	 
 //var_dump($result);
 
			if ("1" == $id){
				$json .= '"'.$id.'"]';
			}elseif ("1" != $id){
				$json .= '"'.$id.'"],';
			}
			 
		}
		 //fin de la boucle while
		$json .= '] ';

		file_put_contents($filename,utf8_encode($json));
		chmod($filename, 0777);
 

///////////////////////////////////////////////////////////////////////////////////////////////////////
		//connexion postgresql

try {
  $pdo = new PDO("pgsql:host='ec2-50-17-206-214.compute-1.amazonaws.com';dbname=dcn748odolklt7", "vpxvhvftohqcoq", "57606f9441058e43b836e87aa125de6a843803c3e671bf9e254654723119abac");
   $pdo->exec("SET NAMES utf8");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

//echo "connexion reussiS";

} catch (Exception $e) {

  echo "Pas de connexion essayez!!!!!";
}
//$bdd = new dbconnect();
/*
ppdri_ligne, action, realisation_financiere,realisation_physique 
  where lim_jijel_nord_sahara_31n.code = ppdri_ligne.commune and action.code_actions = ppdri_ligne.code_action and
action.code_actions = realisation_physique.Code and action.code_actions = realisation_financiere.Code
*/
try {
	if(isset ($_POST['departement'])){
		$departement = $_POST['departement'];
	}else{
		$departement="";
	} 
if(isset ($_POST['annee'])){
		$Annee = $_POST['annee'];
	}else{
		$Annee = "";
	} 
	if(isset ($_POST['habitants'])){
		$habitants = $_POST['habitants'];
	}else{
		$habitants = "";
	} 
//requete Ligne
 $sql = "SELECT  ppdri_ligne.annee ,communeligne,  paiement,ligne_geom,nomactions,nomactions as icon, public.ST_AsGeoJSON(public.ST_Transform((ligne_geom),4326),6) AS ligne ,ppdri.localite,commune ,realisation_physique ,action.quantite,unit ,cloture ,source_financement ,code_ppdri 
  FROM   ppdri_ligne, action, realisation_financiere,realisation_physique, ppdri , ppdridate ,table_localite
  where  action.code_actions = ppdri_ligne.code_action and
action.code_actions = realisation_physique.Code and action.code_actions = realisation_financiere.Code
 and ppdri.code_du_ppdri=action.code_ppdri  and ppdridate.codeppdri= ppdri.code_du_ppdri  and table_localite.code_du_ppdri = ppdri.code_du_ppdri ";
  
  
if (!empty($departement)){
			$sql .=  " and communeligne   = " .$departement;
		} 
		if (!empty($Annee)){
			$sql .=  " and ppdri_ligne.annee  = " .$Annee;
		}
		if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$sql .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$sql .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$sql .=  "  and cloture is  null"  ;		}

		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$sql .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$sql .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$sql .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$sql .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$sql .=  "  and observation =''"  ;		}

		$sql.=" GROUP  BY ppdri.Code_du_PPDRI,action.code_actions ,ppdri_ligne.ligne_geom 
 ,ppdri_ligne.annee ,communeligne, paiement,realisation_physique ,action.quantite,unit";





 
$point = "SELECT  code_commune ,ppdri_point.annee ,  public.ST_AsGeoJSON(public.ST_Transform((geom),4326),6) AS points, ppdri.localite,nomactions,nomactions as icon,paiement ,realisation_physique,action.quantite,unit,cloture ,source_financement ,commune ,code_ppdri     
  FROM   ppdri_point, action, realisation_financiere,realisation_physique , ppdri ,table_localite,ppdridate
  where  action.code_actions = ppdri_point.code_actio and  ppdridate.codeppdri= ppdri.code_du_ppdri and
action.code_actions = realisation_physique.Code and action.code_actions = realisation_financiere.Code and ppdri.code_du_ppdri=action.code_ppdri   and table_localite.code_du_ppdri = ppdri.code_du_ppdri";


if (!empty($departement)){
			$point .=  " and code_commune = " . pg_escape_string($departement);
		} 
		if (!empty($Annee)){
			$point .=  " and ppdri_point.annee  =" . pg_escape_string($Annee);
		}
		if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$point .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
}


		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$point .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$point .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$point .=  "  and cloture is  null"  ;		}

if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$point .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$point .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$point .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$point .=  "  and observation =''"  ;		}

		$point.=" GROUP  BY ppdri.Code_du_PPDRI,action.code_actions ,ppdri_point.geom 
 ,code_commune,ppdri_point.annee , paiement,realisation_physique,action.quantite,unit ";


 
 

$polygone = "SELECT  code_commune,polygone.annee ,ppdri.localite,nomactions,nomactions as icon,paiement,  public.ST_AsGeoJSON(public.ST_Transform((geom),4326),6) AS polygone  ,realisation_physique ,action.quantite,unit,cloture ,source_financement,commune,code_ppdri
  FROM    action, realisation_financiere,realisation_physique , ppdri,polygone ,table_localite,ppdridate
  where  action.code_actions = polygone.code_actio and
action.code_actions = realisation_physique.Code and action.code_actions = realisation_financiere.Code and ppdri.code_du_ppdri=action.code_ppdri and table_localite.code_du_ppdri = ppdri.code_du_ppdri and ppdridate.codeppdri= ppdri.code_du_ppdri";

 if (!empty($departement)){
			$polygone .=  " and code_commune = " . pg_escape_string($departement);
		} 
		if (!empty($Annee)){
			$polygone .=  " and polygone.annee  =" . pg_escape_string($Annee);
		}
if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$polygone .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
}

		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$polygone .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}

		if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$polygone .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$polygone .=  "  and cloture is  null"  ;		}

	if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$polygone .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$polygone .=  "  and cloture is  null"  ;		}

if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$polygone .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$polygone .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$polygone .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$polygone .=  "  and observation =''"  ;		}

$polygone.=" GROUP  BY ppdri.Code_du_PPDRI,action.code_actions ,polygone.geom 
 ,code_commune,polygone.annee , paiement,realisation_physique,action.quantite,unit ";
/*
		if(!empty($departement)) {
				// $sql .= "  and communeligne = " . pg_escape_string($departement);
				 //$point .= "  and code_commune = " . pg_escape_string($departement);
				// $polygone .="  and code_commune = " . pg_escape_string($departement);
}

if(!empty($Annee)) {
				// $sql .= "  and anneeligne =" . pg_escape_string($Annee);
				// $point .= "  and anneepoint =" . pg_escape_string($Annee);
			     $polygone .="  and anneepolygone = " . pg_escape_string($Annee);

}
/*
if (!empty($populationStart)){
			$sql .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
			$point .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
			$polygone .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;

		}
		
		if (!empty($populationEnd)){
			$sql .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) <= ".$populationEnd;
			$point .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
			$polygone .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;				 
		} 

 $sql.=" GROUP  BY Code_du_PPDRI,action.code_ppdri,action.code_actions ,realisation_physique.realisation_physique,ppdri_ligne.ligne_geom ,realisation_financiere.paiement,anneeligne,communeligne";


 $point.=" GROUP  BY Code_du_PPDRI,action.code_ppdri,action.code_actions,realisation_physique.realisation_physique,realisation_financiere.paiement,ppdri_point.geom,ppdri_point.code_commune,anneepoint, ppdri_point.gid  ";


 $polygone.=" GROUP  BY Code_du_PPDRI,action.code_ppdri,action.code_actions,realisation_physique.realisation_physique,realisation_financiere.paiement,ppdri_point.geom, anneepolygone";
*/

//requete ligne
  
			$rs = $pdo->prepare($sql);
			$rs->execute();
//requete point
		
			$rspoint = $pdo->prepare($point);
			$rspoint->execute();
			
//requete polygone 
			$rspolygone = $pdo->prepare($polygone);
			$rspolygone->execute();



  } catch (Exception $e) {
  echo"Proble dans la requete";
  
}

# Build GeoJSON feature collection ppdri_ligne

$ligne_geom = array(
	
   'type'      => 'FeatureCollection',
   'features'  => array()
);
# Loop through rows to build feature arrays

while ($row =  $rs->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    //print_r($properties);
    # Remove geojson and geometry fields from properties
    
    unset($properties['ligne']);
   unset($properties['ligne_geom']);
 

    $feature = array(
         'type' => 'Feature',
         'properties' => $properties,

         'geometry' => json_decode($row['ligne'], true),
 

    );
    # Add feature arrays to feature collection array
    array_push($ligne_geom['features'], $feature);
};

//header('Content-type: application/json');
$p=json_encode($ligne_geom, JSON_NUMERIC_CHECK);


$filenames= "common/js/lignes.geojson";

if (file_exists($filenames)){
      unlink($filenames);
    }else{
      echo "le fichier lignes n'existe pas.<br />";
    }
    //json_encode(array_merge(json_decode($a, true),json_decode($b, true)))
  
    file_put_contents($filenames,utf8_encode($p));
    chmod($filenames, 0777);

///////////////////////////////////////////////////////////////////////
# Build GeoJSON feature collection ppdri_point

    $point_geom = array(
	
  
   'features'  => array()
);
# Loop through rows to build feature arrays

while ($row_point =  $rspoint->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row_point;
    # Remove geojson and geometry fields from properties
    
    unset($properties['points']);
   unset($properties['geom']);
      

    $feature = array(
         'type' => 'Feature',
         'properties' => $properties,
         'geometry' => json_decode($row_point['points'], true),
        

    );
    # Add feature arrays to feature collection array
    array_push($point_geom['features'], $feature);
};
//header('Content-type: application/json');
$g=json_encode($point_geom, JSON_NUMERIC_CHECK);

$filePoints= "common/js/ppdri_point.geojson";

if (file_exists($filePoints)){
      unlink($filePoints);
    }else{
      echo "le fichier ppdri_point Géojson n'existe pas.<br />";
    }
   

 // echo "<strong>Le resultat de g est de </strong>   ".$g." ";
    file_put_contents($filePoints,utf8_encode($g));
    chmod($filePoints, 0777);
    ///////////////////////////////////////////////////////////////////////////////////////////

# Build GeoJSON feature collection ppdri_polygone

    $polygones = array(
	
  
   'features'  => array()
);
# Loop through rows to build feature arrays

while ($row_polygone =  $rspolygone->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row_polygone;
    # Remove geojson and geometry fields from properties
    
    unset($properties['polygone']);
   unset($properties['geom']);
      

    $feature = array(
         'type' => 'Feature',
         'properties' => $properties,
         'geometry' => json_decode($row_polygone['polygone'], true),
        

    );
    # Add feature arrays to feature collection array
    array_push($polygones['features'], $feature);
};

//header('Content-type: application/json');
$h=json_encode($polygones, JSON_NUMERIC_CHECK);

$filePolygone= "common/js/ppdri_polygone.geojson";

if (file_exists($filePolygone)){
      unlink($filePolygone);
    }else{
      echo "le fichier ppdri_polygone Géojson n'existe pas.<br />";
    }
   

 // echo "<strong>Le resultat de g est de </strong>   ".$g." ";
    file_put_contents($filePolygone,utf8_encode($h));
    chmod($filePolygone, 0777);



    ///////////////////////////////////////////////////////////////////////////////////////////

$Total= "common/js/total.geojson";

if (file_exists($Total)){
      unlink($Total);
    }else{
      echo "le fichier total Géojson n'existe pas.<br />";
    }

    $a1 = json_decode( $p, true );
$a2 = json_decode( $g, true );
$a3 = json_decode( $h, true );

$res = array_merge_recursive( $a1, $a2,$a3 );

$resJson = json_encode( $res, JSON_NUMERIC_CHECK );
    
 

 // echo "<strong>Le resultat de g est de </strong>   ".$g." ";
    file_put_contents($Total,utf8_encode($resJson));
    chmod($Total, 0777);

/////////////////////////////////////////////////////////////////////////////////////////////










 
//header('Content-type: application/json');



//echo $p;
//$mokh= json_encode($geojson, JSON_NUMERIC_CHECK);


$pdo=null;


     	require_once("view/vueMaps.php");
       
    
/*
# Build GeoJSON feature collection ppdriTaher
//  $reqppdri = "SELECT *, public.ST_AsGeoJSON(public.ST_Transform((geom),4326),6) AS st FROM polygonetaher ";

  $rp = $pdo->prepare($reqppdri);

$rp->execute();


$geojsonTAHER = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);
# Loop through rows to build feature arrays

while ($rows =  $rp->fetch(PDO::FETCH_ASSOC)) {
    $properties = $rows;
    # Remove geojson and geometry fields from properties
    unset($properties['st']);
    unset($properties['geom']);
    $feature = array(
         'type' => 'Feature',
         'properties' => $properties,
         'geometry' => json_decode($rows['st'], true),
    );
    # Add feature arrays to feature collection array
    array_push($geojsonTAHER['features'], $feature);
};

//header('Content-type: application/json');
$w=json_encode($geojsonTAHER, JSON_NUMERIC_CHECK);

//echo $p;
//$mokh= json_encode($geojson, JSON_NUMERIC_CHECK);
$filenamesPPDRItaher= "common/js/geojsonTAHER.geojson";

if (file_exists($filenamesPPDRItaher)){
      unlink($filenamesPPDRItaher);
    }else{
      echo "le fichier Géojson TAHER n'existe pas.<br />";
    }

    file_put_contents($filenamesPPDRItaher,utf8_encode($w));
    chmod($filenamesPPDRItaher, 0777);

*/


	
?>


