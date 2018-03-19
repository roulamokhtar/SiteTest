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

 
$r=$bdd->selectFormIndicateur();

     //  var_dump($r ) ;
$fname=$r->id; 
      //var_dump($fname);
 $fPROJET=$r->code_projet; 
  
  ($fname);
   ($fPROJET);

  ($r); 

 
  
if(isset ($_POST['Modifier'])){
$Indicateur=$_GET["codeindicateur"];
$Indicateurs_specifique=$_POST['indicateurs_specifique'];
$Unite=$_POST['Unite'];
$Base_2010_2014=$_POST['base_2010_2014'];
$ValeursCumulatives=$_POST['valeurscumulatives'];
$Frequence=$_POST['Frequence'];
$SourcesDonneesMethodologie=$_POST['sourcesdonneesmethodologie'];
$ResponsabiliteCollecteDonnees=$_POST['responsabilitecollectedonnees'];
$Description=$_POST['description'];


   $reqIndicateur = 'UPDATE iov SET indicateurs_specifique=?,  unite=?, base_2010_2014=?, valeurscumulatives=?, frequence=?, sourcesdonneesmethodologie=?, 
  responsabilitecollectedonnees=?, description=?
   WHERE code_projet =? and codeindicateur =? ' ;
var_dump($reqIndicateur);
   $resultatIndicateur= $bdd->getBdd()->prepare($reqIndicateur);
   

  
   $resultatIndicateur->execute(array($Indicateurs_specifique,$Unite,$Base_2010_2014,$ValeursCumulatives,$Frequence,$SourcesDonneesMethodologie,$ResponsabiliteCollecteDonnees,$Description,$code,$Indicateur));
 $resultatIndicateur->closeCursor();
 
    // header('Location:SuiviEvaluation.php?Code_du_PPDRI='.$fPROJET   );


   /*$reqFinancier = 'UPDATE realisation_financiere SET  paiement=:paiement WHERE Code=:Code' ;
  $resultatFinancier=$bdd->getBdd()->prepare($reqFinancier);
  $resultatFinancier->bindParam('paiement',$paiement);
  $resultatFinancier->bindParam('Code',$get );
  $updateFinancier=$resultatFinancier->execute();
 µ*/
  header('Location:actions.php'   );
 
 


}
 


 include_once("view/vueFormIndicateur.php");


    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
