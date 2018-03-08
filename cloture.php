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

$titre = "Projets";
$page = "projets";//__variable pour la classe "active" du menu-header


try {
	
$bdd = new REQ();


// RETOURNE  $a stdclass resultats multiples de la fonction actionsProjet() 

$a=$bdd->realisation();
  
  // RETOURNE l'anée  du projet  
$annee=$bdd->anneeCloture()->annee;
// RETOURNE date de formulation du projet  
$formulation=$bdd->anneeCloture()->formulation;
  
  // RETOURNE date de confirmation du projet  
$confirmation=$bdd->anneeCloture()->confirmation;

 // RETOURNE date de validation du projet  
$validation=$bdd->anneeCloture()->validation;
// RETOURNE date de approbation du projet  
$approbation=$bdd->anneeCloture()->approbation;

// RETOURNE le nom de la localite string resultat unique
$nomLocalite=$bdd->nomLocalite()->localite;

// RETOURNE le nom de la commune string resultat unique

 $commune=$bdd->nomLocalite()->commune;
 // RETOURNE le nom de la daira string resultat unique

 $daira=$bdd->nomLocalite()->daira;

//  RETOURNE le code du projet string resultat unique
 
$codeProjet=$bdd->nomLocalite()->code_ppdri;

 //  RETOURNE le montant payé du secteur des forêts  
 $tauxprojets= $bdd->tauxProjetCloture();
 

 $pourcentage=$bdd->tauxActionCloture() ;
   $PaiementTotalLigne2=$bdd->SommeLigne2ProjetCloture() ;
  
$actions=$bdd->Projets();
 
 $montantprojet= $tauxprojets->montantprojet;
 $totalpaiement= $tauxprojets->totalpaiement;
 
  include_once("view/vueCloture.php");


    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }












