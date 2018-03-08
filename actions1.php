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
include_once("model/Map.php");
include_once("model/REQUETE.php");



$titre = "actions1";
$page = "actions1";//__variable pour la classe "active" du menu-header
$map=new Map();
$bdd = new REQ();
  // $s=$map->getVillesTaux();
if($_SESSION['name'] !=="ADMIN"){

      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }

 
			 
	 

  include_once("view/vueActions1.php");

     
?>
 






