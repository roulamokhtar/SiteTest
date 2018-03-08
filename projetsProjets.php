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
		$departements = $map->getDepartements($circonscription ); //_On affiche les départements dans une liste déroulante
		$Annees=$map->getAnnee();//_On affiche les Annee dans une liste déroulante
   
 if(!empty($_POST)){  
      extract($_POST);
 
      if(!empty($departement )) {
        $departement = $_POST['departement'];
        
      } else {
        $departement = "";
        
      }

      if(!empty($Annee )) {
        $Annee = $_POST['Annee'];
        
      } else {
        $Annee = "";
        
      }
 if(!empty($pv )) {
        $pv = $_POST['pv'];
        
      } else {
        $pv = "";
        
      }
  
 
if(!empty($_POST["finance"])) 
      {
         
        foreach($_POST["finance"] as $finance) {
           $finance ;
        
      }}else{

        $finance = "";
        
      }

      if(!empty($habitants)){
      
      $habitants = $_POST['habitants'];
      
      switch ($habitants) {
       case "egal0":
          //$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
           $CODE= $map->getBase0( 0, $departement,$Annee, $finance, $circonscription,$pv); 

            $stationsCount = $map->getCount(0,0,  $departement,$Annee,$finance, $circonscription);
            $projetCount = $map->getCountLocalite0( 0, $departement,$Annee,$finance, $circonscription);
          break;
        
          case "moins10":
        //  $stations = $map->getVillesTaux( 1, 10, $departement,$Annee);
           $CODE= $map->getppdriCloture(1, 10, $departement,$Annee, $finance , $circonscription,$pv); 

            $stationsCount = $map->getCount( 1, 10, $departement,$Annee, $finance , $circonscription);
            $projetCount = $map->getCountLocalite( 1, 10, $departement,$Annee, $finance, $circonscription);
          break;
        case "medium11-25":
        //  $stations = $map->getVillesTaux(10, 25, $departement,$Annee);
           $CODE= $map->getppdriCloture(10, 25, $departement,$Annee, $finance , $circonscription,$pv); 
            $stationsCount = $map->getCount(10, 25, $departement,$Annee, $finance, $circonscription);
            $projetCount = $map->getCountLocalite(10, 25, $departement,$Annee, $finance, $circonscription);
          break;
        case "medium25-50":
         // $stations = $map->getVillesTaux(25, 50, $departement,$Annee);
           $CODE= $map->getppdriCloture(25, 50, $departement,$Annee, $finance, $circonscription,$pv); 

            $stationsCount = $map->getCount(25, 50, $departement,$Annee, $finance, $circonscription);
            $projetCount = $map->getCountLocalite(25, 50, $departement,$Annee, $finance, $circonscription);
          break;
        case "medium50-75":
         // $stations = $map->getVillesTaux(50, 75, $departement,$Annee);
            $CODE= $map->getppdriCloture(50, 75, $departement,$Annee, $finance, $circonscription,$pv); 

              $stationsCount = $map->getCount(50, 75, $departement,$Annee, $finance, $circonscription);
              $projetCount = $map->getCountLocalite(50, 75, $departement,$Annee, $finance, $circonscription);
          break;
          case "medium75-99":
         // $stations = $map->getVillesTaux(75, 99, $departement,$Annee);
            $CODE= $map->getppdriCloture(0, 99.99, $departement,$Annee, $finance,  $circonscription,$pv); 

              $stationsCount = $map->getCount(0.001, 99.99, $departement,$Annee, $finance, $circonscription);
              $projetCount = $map->getCountLocalite(0.001, 99.99, $departement,$Annee, $finance, $circonscription);
          break;
        case "plus99":
         // $stations = $map->getVillesTaux(99, null, $departement,$Annee);
            $CODE= $map->getppdriCloture(100, null, $departement,$Annee, $finance,  $circonscription,$pv); 
            $stationsCount = $map->getCount(100, null, $departement,$Annee, $finance, $circonscription);
            $projetCount = $map->getCountLocalite(100, null, $departement,$Annee, $finance, $circonscription);
          break;  
      }
      }else {
         $habitants="";
          //$stations = $map->getVillesTaux(NULL,NULL,$departement,$Annee);
            $CODE= $map->getppdriCloture(NULL,NULL, $departement,$Annee, $finance, $circonscription,$pv); 

            $stationsCount = $map->getCount(NULL, NULL,$departement,$Annee, $finance, $circonscription);
            $projetCount = $map->getCountLocalite(NULL, NULL, $departement,$Annee, $finance, $circonscription);

          }

          //////////////////
    } else {
      
     // $stations = $map->getVillesTaux();
 
     $CODE= $map->getppdriCloture(NULL, NULL,NULL,NULL, NULL,$circonscription,null); 
           $stationsCount = 284; 
          $projetCount =   213;
 
    }
    /*
      $result  = $CODE->fetchAll(PDO::FETCH_OBJ);
    foreach ( $result as $data) {
    var_dump( $data->Montant_Global);
  }
    */

//var_dump($stationsCount);


  

  include_once("view/vueProjetsprojets.php");

    } catch (Exception $e) {
        //$msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }












