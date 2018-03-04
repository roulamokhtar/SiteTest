<?php
session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
   // echo 'Bonjour ' . $_SESSION['name'];

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
$aa = new REQ();


// RETOURNE  $a stdclass resultats multiples de la fonction suiviEvaluation()

$a =$aa->suiviEvaluation();
  
  //$commune=$a->fetch(PDO::FETCH_OBJ);
// RETOURNE un nombre : nombre d'action trouver dans la requete $nbrActions=$req->rowCount(); de fonction nbrActions()
 
$s=$aa->nbrActions();

// RETOURNE le nom de la localite string resultat unique
$nomLocalite=$aa->nomLocalite()->localite; 
$nomComposante=$aa->nomLocalite()->type_de_programme;
  	
//  RETOURNE le code du projet string resultat unique
 
$codeProjet=$aa->nomLocalite()->code_ppdri;
//  RETOURNE le code du projet string resultat unique

$commune=$aa->nomLocalite()->commune;

$map=new Map();
 
$objectifs=$aa->getObjectif();
 ($objectifs);


//  RETOURNE le .................;;
 

 

	
 

 




 $url=$_GET['Code_du_PPDRI'];
  include_once("view/vueSuiviEvaluation.php");

    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }












