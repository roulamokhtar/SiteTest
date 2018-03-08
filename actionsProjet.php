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
Contrôleur de notre page de projet
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
include_once("model/BDD.php");
include_once("model/REQUETE.php");



try {
$bdd = new REQ();


// RETOURNE  $a stdclass resultats multiples de la fonction actionsProjet() 

$a=$bdd->realisation();
  

// RETOURNE un nombre : nombre d'action trouver dans la requete $nbrActions=$req->rowCount(); de fonction nbrActions()
$s=$bdd->nbrActions();

// RETOURNE le nom de la localite string resultat unique
$nomLocalite=$bdd->nomLocalite()->localite;

// RETOURNE le nom de la commune string resultat unique

 $commune=$bdd->nomLocalite()->commune;

//  RETOURNE le code du projet string resultat unique
 
$codeProjet=$bdd->nomLocalite()->code_ppdri;

 //  RETOURNE le taux physqiue resultat unique


 $pourcentage=$bdd->tauxAction() ;
 
$actions=$bdd->Projets();

 $tauxprojets= $bdd->tauxProjet();
 if($tauxprojets!=null){
 	 $montantprojet= $tauxprojets->montantprojet;

 	}else{
 		 $montantprojet=0;
 	}
 	if($tauxprojets !=null){
 		 $totalpaiement= $tauxprojets->totalpaiement;
 	}else{
 		 $totalpaiement=0;
 	}
 	if($tauxprojets!=null){
 		$tauxfinanciertotal= ROUND($totalpaiement*100/$montantprojet,2);
 	}else{
 		 $tauxfinanciertotal=0;
 	}

 	
  
  $NombreclotureActions=$bdd->NombreEtatCloture();
    $existeLigne2=$bdd->existeLigne2();

   // var_dump($NombreclotureActions );

  if ($NombreclotureActions==0 and $existeLigne2<>0 and $totalpaiement<>0)

{
	$status="Action(s) Ligne 2 réceptionnée(s)";
  }elseif($NombreclotureActions==0 and $existeLigne2==0 and $totalpaiement<>0){
	$status="Projet ne contienant pas d'actions Ligne 2";
 }elseif($NombreclotureActions <> 0 and $existeLigne2<>0 and $totalpaiement<>0){
 $status="Action(s) Ligne 2 non réceptionnée(s)";
 }elseif( $totalpaiement==0){
$status="Projet annulée";

 }

 
  include_once("view/vueActionsProjet.php");

    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }












