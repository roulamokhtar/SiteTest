<?php
 session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
    

}  

/*
Contrôleur de notre page de projet
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
include_once("model/BDD.php");
include_once("model/REQUETE.php");
include_once("model/Map.php");

$titre = "Projets";
$page = "projets";//__variable pour la classe "active" du menu-header

try {
$bdd = new REQ();

// RETOURNE  $a stdclass resultats multiples de la fonction Projets() 

$map=new Map();
 
       // $actions=$bdd->Projets();
/*
while ( $s= $actions){ 
     ".<br>";
  $l=$s->Code_du_PPDRI;

 ".</br>";
}
*/
$nombreProjet=$bdd->nbrProjets();
/*var_dump($nombreProjet);*/
$NbrLocalite=$bdd->NbrLocalite();
 $map=new Map();
 
		 if($_SESSION['name'] !=="ADMIN"){

      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }

     
     //var_dump($circonscription);
		$departements = $map->getDepartements($circonscription ); //_On affiche les départements dans une liste déroulante
		$Annees=$map->getAnnee();//_On affiche les Annee dans une liste déroulante
   $localites=$map->getLocalite($circonscription);

 if(!empty($_POST)){  
      extract($_POST);
 
      if(!empty($departement )) {
       
        $departement =  $_POST['departement'] ;
        
      } else {
        $departement = "";
        
      }
      if(!empty($circonscription_foret )) {
       
        $circonscription_foret =  $_POST['circonscription_foret'] ;
        
      } else {
        $circonscription_foret = "";
        
      }
 // var_dump($circonscription_foret);

      if(!empty($Annee )) {
        $Annee = $_POST['Annee'];
        
      } else {
        $Annee = "";
        
      }
      if(!empty($localite )) {
        $localite = $_POST['localite'];

        
      } else {
        $localite = "";
        
      }
 
 if(isset($pv )) {
        $pv  = $_POST['pv']   ;
        }else{
           $pv  = "";
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
 
     //var_dump($cloture);  
if(!empty($_POST["finance"])) {
         
        foreach($_POST["finance"] as $finance) {
           $finance ;
        
      }}else{

        $finance = "";
        
      }
      if(isset($programme )) {
        $programme  = $_POST['programme']   ;
        }else{
           $programme  = "";
        }

      if(!empty($habitants)){
      
      $habitants = $_POST['habitants'];
      
      switch ($habitants) {
       case "egal0":
          //$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
           $CODE= $map->getBase0( 0, $departement,$Annee, $finance, $circonscription,$circonscription_foret, $programme);
           $stationsCount=  $CODE->rowCount(); 
           $projetCount=$map->getCountLocalite0(0, $departement,$Annee, $finance, $circonscription, $programme); 

           //$stationsCount = $map->getCount(0,0,  $departement,$Annee,$finance, $circonscription);
           break;
        
          case "moins10":
        //  $stations = $map->getVillesTaux( 1, 10, $departement,$Annee);
           $CODE= $map->getBaseDonnees(1, 10, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 
$stationsCount=  $CODE->rowCount(); 
           // $stationsCount = $map->getCount( 1, 10, $departement,$Annee, $finance , $circonscription,$pv);
            $projetCount = $map->getCountLocalite( 1, 10, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);
          break;
        case "medium11-25":
        //  $stations = $map->getVillesTaux(10, 25, $departement,$Annee);
           $CODE= $map->getBaseDonnees(10, 25, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 
           $stationsCount=  $CODE->rowCount(); 
           // $stationsCount = $map->getCount(10, 25, $departement,$Annee, $finance, $circonscription,$pv);
            $projetCount = $map->getCountLocalite(10, 25, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);
          break;
        case "medium25-50":
         // $stations = $map->getVillesTaux(25, 50, $departement,$Annee);
           $CODE= $map->getBaseDonnees(25, 50, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 
$stationsCount=  $CODE->rowCount(); 
           // $stationsCount = $map->getCount(25, 50, $departement,$Annee, $finance, $circonscription,$pv);
            $projetCount = $map->getCountLocalite(25, 50, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);
          break;
        case "medium50-75":
         // $stations = $map->getVillesTaux(50, 75, $departement,$Annee);
            $CODE= $map->getBaseDonnees(50, 75, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 
$stationsCount=  $CODE->rowCount(); 
          //    $stationsCount = $map->getCount(50, 75, $departement,$Annee, $finance, $circonscription,$pv);
              $projetCount = $map->getCountLocalite(50, 75, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);
          break;
          case "medium75-99":
         // $stations = $map->getVillesTaux(75, 99, $departement,$Annee);
            $CODE= $map->getBaseDonnees(0, 99.99, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture ); 
$stationsCount=  $CODE->rowCount(); 
              //$stationsCount = $map->getCount(0.001, 99.99, $departement,$Annee, $finance, $circonscription,$pv);
              $projetCount = $map->getCountLocalite(0.001, 99.99, $departement,$Annee, $finance, $circonscription,$pv,$programme,$circonscription_foret);
          break;
        case "plus99":
         // $stations = $map->getVillesTaux(99, null, $departement,$Annee);
            $CODE= $map->getBaseDonnees(100, null, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 

            $stationsCount=  $CODE->rowCount(); 
           // $stationsCount = $map->getCount(100, null, $departement,$Annee, $finance, $circonscription,$pv);
            $projetCount = $map->getCountLocalite(100, null, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);
          break;  
     }
      }else {
         $habitants="";
          //$stations = $map->getVillesTaux(NULL,NULL,$departement,$Annee);
            $CODE= $map->getBaseDonnees(NULL,NULL, $departement,$Annee, $finance , $circonscription,$pv,$programme,$circonscription_foret,$localite,$etat,$cloture); 
$stationsCount=  $CODE->rowCount(); 
            //$stationsCount = $map->getCount(NULL, NULL,$departement,$Annee, $finance, $circonscription,$pv);
            $projetCount = $map->getCountLocalite(NULL, NULL, $departement,$Annee, $finance, $circonscription,$pv,$programme,$localite,$circonscription_foret);

          }

          //////////////////
    }else {
      
     // $stations = $map->getVillesTaux();
 
     $CODE= $map->getBaseDonnees(NULL, NULL,NULL,NULL, NULL,$circonscription,null,null,null,null,null,null); 
     $stationsCount=  $CODE->rowCount(); 
            $projetCount = $map->getCountLocalite(NULL, NULL, NULL,NULL, NULL, $circonscription,NULL,NULL,NULL,null); 
          
 
    }

  
    //var_dump($projetCount);

  
  

  include_once("view/vueProjets.php");

    } catch (Exception $e) {
        //$msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
?>


 





