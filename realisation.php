<?php
session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
   // echo 'Bonjour ' . $_SESSION['name'];

}else{

   echo 'Bonjour ' . $_SESSION['name']; 
}
/*
Contrôleur de notre page de projet
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
include_once("model/BDD.php");
include_once("model/REQUETE.php");

$titre = "Projets";
$page = "projets";//__variable pour la classe "active" du menu-header


try {
$bdd = new REQ();
var_dump($bdd);

// RETOURNE  $a stdclass resultats multiples de la fonction realisation() 

$a=$bdd->realisation();



 

  

 

  include_once("view/vueRealisation.php");

    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }












