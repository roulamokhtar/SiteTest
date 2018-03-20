<?php
session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
   // echo 'Bonjour ' . $_SESSION['name'];

}else{

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

 
$r=$bdd->selectForm();


 $a=$r->code_ppdri;
  $g=$r->code_actions;
// var_dump($a);

if(isset ($_POST['Modifier'])){

try{
    $code=$_GET["code_actions"];
    $nomelevage=$bdd->elevage($code);
    // exemple $CODE= $map->getBase0();
    // var_dump($nomelevage);
       // $Code_du_PPDRI=$_GET["Code_du_PPDRI"];

$realisation_physique=$_POST['realisation_physique'];
$quantite=$_POST['quantite'];

$paiement=$_POST['paiement'];
$MontantPrevu=$_POST['montant'];
$observation=$_POST['observation'];



$reqPhysique = 'UPDATE realisation_physique SET realisation_physique=? WHERE code =?' ;
   $resultatPhysique= $bdd->getBdd()->prepare($reqPhysique);

   $reqPhysiquePrevu = 'UPDATE action SET quantite=? WHERE code_actions =?' ;
   $resultatPhysiquePrevu= $bdd->getBdd()->prepare($reqPhysiquePrevu);

$reqFinancier = 'UPDATE realisation_financiere SET paiement=? WHERE code =?' ;
   $resultatFinancier= $bdd->getBdd()->prepare($reqFinancier);

$reqMonntantPrevu = 'UPDATE action SET montant=? WHERE code_actions =?' ;
   $resultatMontantPrevu= $bdd->getBdd()->prepare($reqMonntantPrevu);

$reqobservation = 'UPDATE action SET observation=? WHERE code_actions =?' ;
   $resultatobservation= $bdd->getBdd()->prepare($reqobservation);
  // gestion en cas de supprimer la date de cloture
if(!empty($_POST['cloture'])){

 $cloture=$_POST['cloture'];
 $reqcloture = 'UPDATE action SET cloture=? WHERE code_actions =?' ;
   $resultatcloture= $bdd->getBdd()->prepare($reqcloture);
   $resultatcloture->execute(array($cloture,$code));
}else{
  $cloture=$_POST['cloture'];
 $reqcloture = 'UPDATE action SET cloture=NULL WHERE code_actions =?' ;
   $resultatcloture= $bdd->getBdd()->prepare($reqcloture);
   $resultatcloture->execute(array( $code));
}




  
   $resultatPhysique->execute(array($realisation_physique,$code));
      $resultatPhysiquePrevu->execute(array($quantite,$code));

      $resultatFinancier->execute(array($paiement,$code));
$resultatMontantPrevu->execute(array($MontantPrevu,$code));

$resultatobservation->execute(array($observation,$code));


      
 $resultatPhysique->closeCursor();
 $resultatPhysiquePrevu->closeCursor();
$resultatFinancier->closeCursor();
$resultatMontantPrevu->closeCursor();
$resultatobservation->closeCursor();
$resultatcloture->closeCursor();
 /*
      $sup= "DROP TABLE `suivievaluation` ";
      

$suppresion=$bdd->getBdd()->prepare($sup);
$suppresion->execute();
$suppresion->closeCursor();

$actua=" CALL suivievaluation()";
$creation=$bdd->getBdd()->prepare($actua);
$creation->execute();
$creation->closeCursor();
  */

  header('Location:actions.php'   );

   /*$reqFinancier = 'UPDATE realisation_financiere SET  paiement=:paiement WHERE Code=:Code' ;
  $resultatFinancier=$bdd->getBdd()->prepare($reqFinancier);
  $resultatFinancier->bindParam('paiement',$paiement);
  $resultatFinancier->bindParam('Code',$get );
  $updateFinancier=$resultatFinancier->execute();
 µ*/

}catch(PDOException $exc){
echo $exc->getTraceAsString();
exit();
}

}


 include_once("view/VueEdit.php");


    } catch (Exception $e) {
        $msgErreur = $e->getMessage();
        require_once("view/vueErreur.php");
    }
