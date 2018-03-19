<?php
include_once ("BDD.php");
/*
Classe REQUETE pour se faire des requetes sue la BDD Markerclusterer
 */
class REQ Extends BDD{



/* renvoi le differents   projets trouvés en fOnction de la selection parametres commune, Annee $_POST['search'] */
public function  Projets (){
$bdd = parent::getBdd();	



if(isset($_POST['Annee']) and isset($_POST['Communes']) and isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?  and Annee=?  and 'tauxPaiemant' = ?   GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($d,$ann,$t));
	$datas=$req->fetchAll(PDO::FETCH_OBJ);
		$req->closeCursor();	
		return 	$datas;
}
 if(isset($_POST['Annee']) and isset($_POST['Communes']) and !isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?  and Annee=?   GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($d,$ann));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	$req->closeCursor(); 
			return 	$datas;
	 
}
 if(isset($_POST['Annee']) and !isset($_POST['Communes']) and isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	   Annee=? and 'tauxPaiemant'=?  GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($ann,$t));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 $req->closeCursor(); 
	 		return 	$datas;
	 
	}
 if(!isset($_POST['Annee']) and isset($_POST['Communes']) and isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?  and 'tauxPaiemant'=?   GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($d,$t));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 $req->closeCursor();
	 		return 	$datas;
 
	 }	 
 if(isset($_POST['Annee']) and !isset($_POST['Communes']) and !isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Actions AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Annee=?    GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($_POST['Annee']));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 $req->closeCursor();
	 		return 	$datas;
 	 
	}
 if(!isset($_POST['Annee']) and isset($_POST['Communes']) and !isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?    GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($d));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 $req->closeCursor(); 
	 		return 	$datas;

	 }

 if(!isset($_POST['Annee']) and !isset($_POST['Communes']) and isset($_POST['Taux']) ){
$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM(action.Montant) AS tauxPaiemant
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 'tauxPaiemant'=?    GROUP BY Code_du_PPDRI ";
	$req=$bdd->prepare($projets);
	$req->execute(array($t));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 $req->closeCursor();
	var_dump($datas); 		
	 	
}
if(isset($_POST['Annee']) ){
	$ann=$_POST['Annee'];
}else{
	$ann="";
} 

if(isset($_POST['Communes']) ){
$d= $_POST['Communes'];
}else{
	$d="";
} 
if(isset($_POST['Taux']) ){
$t=$_POST['Taux'];
}
else{
	$t="";
} 

}
		 
				
					
						// 
						
/////////////////////////////////////////////////
						 
						 
						
	// Accès au résultat}
		 		

		public function  nbrProjets (){
// cetTE fonction permet de calculer le nombre de projets trouvé en fOnction de la selection parametres commune, Annee $_POST['search']

$bdd = parent::getBdd();

if(isset($_POST['search']) and isset($_POST['Communes']) and isset($_POST['Annee']) ){
	/* si l'utilisateur clique sur chercher et Communes et sur l'année*/


$ann=$_POST['Annee'];
$d= $_POST['Communes'];

$projets="SELECT * from ppdri  WHERE Commune=?  and Annee=? order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d,$ann));
 	$datas= number_format($req->rowCount());

	 	  $req->closeCursor();

	 	 	}
  if( isset($_POST['search']) and isset($_POST['Communes']) and empty($_POST['Annee'])){
/* si l'utilisateur clique sur chercher et Communes*/

$d= $_POST['Communes'];
/*var_dump($d);*/
$projets="SELECT * from ppdri  WHERE Commune=?   order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d));
	 
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

	 	 	}
	 
	 if(isset($_POST['search']) and isset($_POST['Annee']) and empty($_POST['Communes'])){
/* si l'utilisateur clique sur chercher et Annee*/
$ann=$_POST['Annee'];

$projets="SELECT * from ppdri  WHERE Annee=?   order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($ann));
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

 	 	}
 if(!isset($_POST['search'])){
	 	/* si l'utilisateur ouvre la page projet sans cliquer sur chercher */


	 		$projets="SELECT * from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }
	 if( isset($_POST['search']) and empty($_POST['Communes']) and empty($_POST['Annee'])){
	 	/* si l'utilisateur clique sur chercher */


	 		$projets="SELECT * from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }
	
	 	 return $datas; 
	 	 	 	  $req->closeCursor();
	// Accès au résultat

		 			}
 


public function  NbrLocalite (){

/* renvoi le nombre de projets trouvé en fOnction de la selection parametres commune, Annee $_POST['search']

*/

	$bdd = parent::getBdd();

if(isset($_POST['search']) and isset($_POST['Communes']) and isset($_POST['Annee']) ){

$ann=$_POST['Annee'];
$d= $_POST['Communes'];

$projets="SELECT DISTINCT(`ville`) from ppdri  WHERE Commune=?  and Annee=? order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d,$ann));
 	$datas= number_format($req->rowCount());

	 	  $req->closeCursor();

	 	 	}
  if( isset($_POST['search']) and isset($_POST['Communes']) and empty($_POST['Annee'])){

$d= $_POST['Communes'];

$projets="SELECT DISTINCT(`ville`)from ppdri  WHERE Commune=?   order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d));
	 
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

	 	 	}
	 
	 if(isset($_POST['search']) and isset($_POST['Annee']) and empty($_POST['Communes'])){

$ann=$_POST['Annee'];

$projets="SELECT DISTINCT(`ville`)from ppdri  WHERE Annee=?   order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($ann));
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

 	 	}
 if(!isset($_POST['search'])){
	 

	 		$projets="SELECT DISTINCT(ville) from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }

	 if( isset($_POST['search']) and empty($_POST['Communes']) and empty($_POST['Annee'])){
	 

	 		$projets="SELECT DISTINCT(`ville`) from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }
	
	 	 return $datas; 
	 	 	 	  $req->closeCursor();
	// Accès au résultat

		 			}



	  	 	public function  actionsProjet (){
/* cette fonction permet de lister les actions en fonction du code de projet*/
	$bdd = parent::getBdd();
	$action="SELECT * FROM action, ppdri,   WHERE
	ppdri.Code_du_PPDRI = action.Code_PPDRI AND
 Code_PPDRI='$_GET[Code_du_PPDRI]'  ";

$res= $bdd->query($action) ; 
$actions=$res->fetchAll(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
		 			}
		 			public function  nbrActions (){
	/* cette fonction permet de calculer le NOMBRE  Des actions en fonction du code de projet*/


	$bdd = parent::getBdd();

    $action="SELECT * FROM action, ppdri  WHERE
	ppdri.Code_du_PPDRI = action.Code_PPDRI AND
 action.source_financement=? AND
action.Code_PPDRI=?
  ";

$actiong="SELECT * FROM action, ppdri  WHERE
	ppdri.Code_du_PPDRI = action.Code_PPDRI AND
	action.Code_PPDRI=?

	 ";


 

if(!isset ($_POST['source'])  ){

$req= $bdd->prepare($actiong) ; 
$req->execute(array($_GET['Code_du_PPDRI']));
 
 $req->closeCursor();

}else
{
	$req= $bdd->prepare($action) ; 
$req->execute(array($_POST['source'],$_GET['Code_du_PPDRI']));
 
$req->closeCursor();

}
if(empty($_POST['source'])  ){

$req= $bdd->prepare($actiong) ; 
$req->execute(array($_GET['Code_du_PPDRI']));
 $req->closeCursor();
}
	$nbrActions=$req->rowCount();

	return $nbrActions ; // Accès au résultat

		 			}

		 			public function  nomLocalite (){

	$bdd = parent::getBdd();

    $action="SELECT * FROM action, ppdri  WHERE
	ppdri.Code_du_PPDRI = action.Code_PPDRI AND
 Code_PPDRI=? ";

  $actiong="SELECT * FROM action, ppdri  WHERE
	ppdri.Code_du_PPDRI = action.Code_PPDRI  ";

if(isset($_GET['Code_du_PPDRI'])){
$req= $bdd->prepare($action) ; 
$req->execute(array($_GET['Code_du_PPDRI']));
 
}else{
$req= $bdd->prepare($actiong) ; 
$req->execute();
 

}

 
 	$nomLocalite=$req->fetch(PDO::FETCH_OBJ);
	return $nomLocalite ;  
	// Accès au résultat
		 			}
public function  Composante (){

/* renvoi le differents   projets trouvés en fOnction de la selection parametres commune, Annee $_POST['search'] */


	$bdd = parent::getBdd();

if(isset($_POST['search']) and isset($_POST['Communes']) and isset($_POST['Type_de_programme'])){

$ann=$_POST['Type_de_programme'];
$d= $_POST['Communes'];

$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM( action.Montant ) AS tauxPaiemant 
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Actions AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?  and Type_de_programme=?    GROUP BY Code_du_PPDRI order by       Annee  asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d,$ann));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 	  $req->closeCursor();
	 	 	}
  if( isset($_POST['search']) and isset($_POST['Communes']) and empty($_POST['Type_de_programme'])){

$d= $_POST['Communes'];

$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM( action.Montant ) AS tauxPaiemant 
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Actions AND ppdri.Code_du_PPDRI = action.Code_PPDRI  and
  	 Commune=?      GROUP BY Code_du_PPDRI order by   Annee asc  ";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d));
	 
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 	  $req->closeCursor();
	 	 	}
	 
	 if(isset($_POST['search']) and isset($_POST['Type_de_programme']) and empty($_POST['Communes'])){

$ann=$_POST['Type_de_programme'];

$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM( action.Montant ) AS tauxPaiemant 
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI and 
  	  Type_de_programme=?   GROUP BY Code_du_PPDRI order by   Annee asc" ;
	$req=$bdd->prepare($projets);
	 $req->execute(array($ann));
	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 	  $req->closeCursor();
	 	 	}
 if(!isset($_POST['search'])){
	 

	 		$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM( action.Montant ) AS tauxPaiemant 
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI GROUP BY Code_du_PPDRI order by   Annee asc"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 	 	  $req->closeCursor();
	 	 	 
	 }

	 if( isset($_POST['search']) and empty($_POST['Communes']) and empty($_POST['Type_de_programme'])){
	 

	 		$projets="SELECT Code_du_PPDRI,Annee, Daira, Commune, Localite,Type_de_programme, sum(action.Montant) as montantProjet, SUM(realisation_financiere.paiement) as TotalPaiement
 ,SUM(realisation_financiere.paiement)*100/SUM( action.Montant ) AS tauxPaiemant 
 from ppdri , action ,realisation_financiere
  WHERE realisation_financiere.Code =action.Code_Action AND ppdri.Code_du_PPDRI = action.Code_PPDRI GROUP BY Code_du_PPDRI order by   Annee asc"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

	 $datas=$req->fetchAll(PDO::FETCH_OBJ);
	 	 	  $req->closeCursor();
	 	 	 
	 }
	
	 	 return $datas; 
	 	 	 	  $req->closeCursor();
	// Accès au résultat
		 }			


		 			public function  nbrProjetsComposante (){
// cetTE fonction permet de calculer le nombre de projets trouvé en fOnction de la selection parametres commune, Annee $_POST['search']

$bdd = parent::getBdd();

if(isset($_POST['search']) and isset($_POST['Communes']) and isset($_POST['Type_de_programme']) ){
	/* si l'utilisateur clique sur chercher et Communes et sur l'année*/


$ann=$_POST['Type_de_programme'];
$d= $_POST['Communes'];

$projets="SELECT * from ppdri  WHERE Commune=?  and Type_de_programme=? order by   Annee asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d,$ann));
 	$datas= number_format($req->rowCount());

	 	  $req->closeCursor();

	 	 	}
  if( isset($_POST['search']) and isset($_POST['Communes']) and empty($_POST['Type_de_programme'])){
/* si l'utilisateur clique sur chercher et Communes*/

$d= $_POST['Communes'];
/*var_dump($d);*/
$projets="SELECT * from ppdri  WHERE Commune=?   order by   Type_de_programme asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($d));
	 
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

	 	 	}
	 
	 if(isset($_POST['search']) and isset($_POST['Type_de_programme']) and empty($_POST['Communes'])){
/* si l'utilisateur clique sur chercher et Annee*/
$ann=$_POST['Type_de_programme'];

$projets="SELECT * from ppdri  WHERE Type_de_programme=?   order by   Type_de_programme asc";
	$req=$bdd->prepare($projets);
	 $req->execute(array($ann));
 	$datas= number_format($req->rowCount());
	 	  $req->closeCursor();

 	 	}
 if(!isset($_POST['search'])){
	 	/* si l'utilisateur ouvre la page projet sans cliquer sur chercher */


	 		$projets="SELECT * from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }
	 if( isset($_POST['search']) and empty($_POST['Communes']) and empty($_POST['Type_de_programme'])){
	 	/* si l'utilisateur clique sur chercher */


	 		$projets="SELECT * from ppdri"  ;
	 		$req=$bdd->prepare($projets);
	 $req->execute();

 	$nombre= number_format($req->rowCount());
 	 	$datas=$nombre ;

	 	 	  $req->closeCursor();
	 }
	
	 	 return $datas; 
	 	 	 	  $req->closeCursor();
	// Accès au résultat

		 			}
 

		 			public function  suiviEvaluation (){
//cette fonction permet de 
	$bdd = parent::getBdd();
	$url=$_GET['Code_du_PPDRI'];
	$SuiviEvaluation="SELECT distinct nomactions,activite,resultat,objectif_specifique,og_composante.og_composante,type_de_programme, indicateur,codeindicateur,code_du_ppdri
	from
	 ppdri,action,activite_resultat,objectif_specifique,indicateurs, resultat, iov, os_composante, og_composante 
	 WHERE 
	ppdri.Code_du_PPDRI  = action.Code_PPDRI  AND
	activite_resultat.idactivite=action.Activites and
	resultat.id=activite_resultat.id_resultat and 
resultat.id=indicateurs.Resultats AND ppdri.Code_du_PPDRI=iov.code_projet
   and indicateurs.id=iov.codeindicateur and
objectif_specifique.id=resultat.id_objectif_specifique and
 objectif_specifique.id=os_composante.id and
og_composante.id=os_composante.og_composante and action.observation  != 'annulee'  and 
ppdri.Code_du_PPDRI=?";

$SuiviEvaluationPost="SELECT distinct nomactions,activite,resultat,objectif_specifique,og_composante.og_composante,type_de_programme, indicateur,codeindicateur,code_du_ppdri
 from 
 ppdri,action,activite_resultat,objectif_specifique,indicateurs, resultat,	 iov, os_composante, og_composante 
 WHERE 
	ppdri.Code_du_PPDRI  = action.Code_PPDRI  AND
	activite_resultat.idactivite=action.Activites and
	resultat.id=activite_resultat.id_resultat and 
resultat.id=indicateurs.Resultats AND ppdri.Code_du_PPDRI=iov.code_projet   and indicateurs.id=iov.codeindicateur and
objectif_specifique.id=resultat.id_objectif_specifique and
 objectif_specifique.id=os_composante.id and
og_composante.id=os_composante.og_composante and  action.observation != 'annulee' and
ppdri.Code_du_PPDRI=? and
objectif_specifique.objectif_specifique=? ";

if(!isset ($_POST['objectif'])  ){

$datas= $bdd->prepare($SuiviEvaluation) ; 
$datas->execute( array($_GET['Code_du_PPDRI']));
 
$da=$datas->fetchAll(PDO::FETCH_OBJ);
$datas->closeCursor();

}else
{
	$datas= $bdd->prepare($SuiviEvaluationPost) ; 
$datas->execute( array($url, $_POST['objectif']));
$da=$datas->fetchAll(PDO::FETCH_OBJ);

$datas->closeCursor();

}
if(empty($_POST['objectif'])  ){

$datas= $bdd->prepare($SuiviEvaluation) ; 
$datas->execute( array($_GET['Code_du_PPDRI']));
$da=$datas->fetchAll(PDO::FETCH_OBJ);
$datas->closeCursor();
}


	return $da ; // Accès au résultat
		 			}

function getObjectif() {
 	    //__Affiche l'ensemble des objectifs specifique

        $bdd = parent::getBdd();
		
		$sql =parent:: SELECT('* ');
		$sql .= parent::FROM('objectif_specifique');
		$sql .= parent::ORDERBY('id');
		
        $datas = $bdd->query($sql);
		
		$resultat = $datas->fetchAll(PDO::FETCH_OBJ);
           
		
        return $resultat  ; // Accès au résultat
    }


		 			
		 			public function realisation (){
$bdd = parent::getBdd();

	$realisation="SELECT * FROM  action, realisation_physique, realisation_financiere,ppdri  WHERE
	realisation_physique.Code = action.Code_Actions AND
	ppdri.Code_du_PPDRI=action.code_actions and
	realisation_financiere.Code =action.Code_Actions and Code_PPDRI=? " ; 
	$realisationg="SELECT * FROM  action, realisation_physique, realisation_financiere,ppdri  WHERE
	realisation_physique.Code = action.Code_Actions AND
	ppdri.Code_du_PPDRI=action.code_actions and
	realisation_financiere.Code =action.Code_Actions   " ; 
	

if(isset($_GET['Code_du_PPDRI']) ){
	 
	$res= $bdd->prepare($realisation) ; 
  $res -> execute(array($_GET['Code_du_PPDRI'] ));
	}else{
	$res= $bdd->prepare($realisationg) ; 	
$res->execute();

	} 
	$actions=$res->fetchAll(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
		 			}



	
 
public function realisationaction($population=""  , $departement=""  , $Annee="", $finance="" ,$physique ="",$action="" , $cloture="",$etat="" , $circonscription="", $localite="", $composante=""){
$bdd = parent::getBdd();

	$realisation="SELECT *,(realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique,(realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant 
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature,ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions
		and action.nomactions = nomenclature.nomenclature 
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS' " ; 
    
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
			$realisation .=  " and markers_villes.ville_id = '".$localite."'";
		} 

		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 

		if (!empty($Annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
			$realisation .=  " and ppdri.annee in ('" . implode("','", $Annee) . "')"; 
		}
		
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) and  $population != 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant ) <= " .$population;
		}
		 
		 
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
		 
		if ( isset($_POST['physique']) and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique']) and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($action)){
			$realisation .=  "  and  nomenclature.id =   " .$action    ;
		}

		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
			}
			if(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
			}

		

if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation =' '"  ;		}

		 $realisation .= " group by Code_Actions,ppdri.code_du_ppdri,realisation_physique.id ,realisation_physique.code,realisation_financiere.id, realisation_financiere.code,  markers_villes.ville_nom_reel, markers_villes.ville_id,markers_departements.id_departement ,markers_departements.nom_departement ,action.source_financement,nomenclature.nomenclature, nomenclature.id ,cloture,codeppdri, circonscription,circonscription_foret,observation,ppdri.localite, action.composante";
	 $realisation .= " order by annee  ";
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	
$actions=$res->fetchAll(PDO::FETCH_OBJ);
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			} 

		 			// a revoir
public function realisationactionCloture($population=""  , $departement=""  , $Annee="", $finance="" ,$physique ="",$action="" , $cloture="",$etat="" , $circonscription="", $localite="", $composante=""){
$bdd = parent::getBdd();

	$realisation="SELECT *,(realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique,(realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant 
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature,ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions
		and action.nomactions = nomenclature.nomenclature 
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'

		" ; 
    
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
			$realisation .=  " and markers_villes.ville_id = '".$localite."'";
		} 

		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 

		if (!empty($Annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
			$realisation .=  " and ppdri.annee in ('" . implode("','", $Annee) . "')"; 
		}
		
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) and  $population != 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant ) <= " .$population;
		}
		 
		 
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
		 
		if ( isset($_POST['physique']) and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique']) and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($action)){
			$realisation .=  "  and  nomenclature.id =   " .$action    ;
		}

		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
			}
			if(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
			}

		

if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation =''"  ;		}

		 $realisation .= " group by Code_Actions,ppdri.code_du_ppdri,realisation_physique.id ,realisation_physique.code,realisation_financiere.id, realisation_financiere.code,  markers_villes.ville_nom_reel, markers_villes.ville_id,markers_departements.id_departement ,markers_departements.nom_departement ,action.source_financement,nomenclature.nomenclature, nomenclature.id ,cloture,codeppdri, circonscription,circonscription_foret,observation,ppdri.localite, action.composante";
	 $realisation .= " order by annee  ";
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	
$actions=$res->fetchAll(PDO::FETCH_OBJ);
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}
 
public function realisationactionTROUVE($population=""   , $departement=""  , $Annee="", $finance=""  , $physique="" ,$action="" , $cloture="" , $etat="" ,$circonscription="",$localite="",$composante=""){
		//Affiche nombre actions trouvés dont le taux financier different de 0

$bdd = parent::getBdd();

	$realisation="SELECT *,(realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique,(realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant 
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature,ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions   
		and action.nomactions = nomenclature.nomenclature
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'
		" ; 



	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
	$realisation .=  " and markers_villes.ville_id = '".$localite."'";
			} 
		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 
		if (!empty($Annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
						$realisation .=  " and ppdri.annee in ('" . implode("','", $Annee) . "')"; 


		}



		
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) ){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  <= " .$population;
		}


		 
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
		 
		if ( isset($_POST['physique'])and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique'])and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($action)){
			$realisation .=  "  and  nomenclature.id =   " .$action    ;
		}

		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){

			$realisation .=  "  and  action.cloture not".'null'. ""      ;
			
			}elseif(isset($_POST['cloture']) and $_POST['cloture']==""){

			$realisation .=  "  and  action.cloture is".'null'. ""      ;
			}


		if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}

		 if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}
 
		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

 if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation = ''"  ;		}

if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}
		
		 $realisation .= " group by Code_Actions,ppdri.code_du_ppdri,realisation_physique.id ,realisation_physique.code,realisation_financiere.id, realisation_financiere.code,  markers_villes.ville_nom_reel, markers_villes.ville_id,markers_departements.id_departement ,markers_departements.nom_departement ,action.source_financement ,nomenclature.nomenclature,cloture, nomenclature.id, codeppdri,circonscription,circonscription_foret, observation,action.composante";
	 $realisation .= " order by annee  ";
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	
$actions=$res->rowCount();
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}


public function MONTANTrealisationactionTROUVE($population=""  , $departement=""  , $Annee="", $finance="" , $physique="",$action="" , $cloture="" , $etat="", $circonscription="",$localite="",$composante="" ){
		//calcule le montan d'actions trouvés dont le taux financier different de 0

$bdd = parent::getBdd();

	$realisation="SELECT sum(paiement) as decaissement
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature,ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions
		and action.nomactions = nomenclature.nomenclature  
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'

	   " ; 
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
	$realisation .=  " and markers_villes.ville_id = '".$localite."'";
			}

		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		}  
		if (!empty($Annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
						$realisation .=  " and ppdri.annee in ('" . implode("','", $Annee) . "')"; 

		}
		 
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) ){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  <= " .$population;
		}


		  
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }

			 
 
		if ( isset($_POST['physique'])and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique'])and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($action)){
			$realisation .=  "  and  nomenclature.id =   " .$action    ;
		}
		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
		}elseif(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
		}
		
	 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}
 if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation = ''"  ;		}

	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	$actions=$res->fetch(PDO::FETCH_OBJ);
 
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}
		 			
		 			public function PhysiquerealisationactionTROUVE($population=""  , $departement="" ,$annee="" ,$finance="" ,$physique="" ,$nomactions=""  ,$cloture="" ,$etat="" ,$circonscription="" ,  $localite="" ,$composante=""  ){
		//calcule le volume d'actions trouvés dont le taux financier different de 0

$bdd = parent::getBdd();

	$realisation="SELECT sum(realisation_physique) as realisation
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature, ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions
		and action.nomactions = nomenclature.nomenclature  
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'

	   " ; 
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
	$realisation .=  " and markers_villes.ville_nom_reel = '".$localite."'";
			} 
		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 
		if (!empty($annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
						$realisation .=  " and ppdri.annee in ('" . implode("','", $annee) . "')"; 

		}
		 
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) ){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  <= " .$population;
		}


		  
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }

			 
 
		if ( isset($_POST['physique'])and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique'])and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($nomactions)){
			$realisation .=  "  and  nomenclature.id =   " .$nomactions    ;
		}
		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
		}elseif(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
		}

		 
	 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		 if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}
 if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation = ''"  ;		}


	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	$actions=$res->fetch(PDO::FETCH_OBJ);
 
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}

		 			public function PhysiqueprevuactionTROUVE($population=""    , $departement="",$annee="",$finance="",$physique="",$nomactions="" ,$cloture="",$etat="",$circonscription="",  $localite="",$composante=""){
		//calcule le volume d'actions trouvés dont le taux financier different de 0

$bdd = parent::getBdd();

	$realisation="SELECT sum(action.quantite) as volume_prevu
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature, ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions
		and action.nomactions = nomenclature.nomenclature  
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'

	   " ; 
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
	$realisation .=  " and markers_villes.ville_nom_reel = '".$localite."'";
			} 
		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 
		if (!empty($annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
						$realisation .=  " and ppdri.annee in ('" . implode("','", $annee) . "')"; 

		}
		 
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) ){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  <= " .$population;
		}

		  
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }

			 
 
		if ( isset($_POST['physique'])and $physique =="") {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique'])and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=""){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($nomactions)){
			$realisation .=  "  and  nomenclature.id =   " .$nomactions    ;
		}
		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
		}elseif(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
		}

		 
	 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		 if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}
 if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation = ''"  ;		} 

	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	$actions=$res->fetch(PDO::FETCH_OBJ);
 
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}



		 			public function MONTANTpervuactionTROUVE($population=""  , $departement=""  , $Annee="", $finance="" , $physique="",$action="" , $cloture="" , $etat="" , $circonscription="" ,$localite="",       $composante=""){
		//calcule le montan d'actions prevu dont le taux financier different de 0

$bdd = parent::getBdd();

	$realisation="SELECT sum(montant) as montant_prevu
	 FROM 
	  ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,nomenclature, ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
	realisation_financiere.Code =action.Code_Actions  
		and action.nomactions = nomenclature.nomenclature  
		and ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'


	 " ; 
	if (!empty($departement)){
			$realisation .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($localite)){
	$realisation .=  " and markers_villes.ville_id = '".$localite."'";
			} 
		if (!empty($composante)){
			$realisation .=  " and action.composante = '".$composante."'";
		} 
		if (!empty($Annee)){
			//$realisation .=  " and ppdri.annee = " .$Annee;
						$realisation .=  " and ppdri.annee in ('" . implode("','", $Annee) . "')"; 

		}
		
		if (isset($population) and  $population == 100){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  = " .$population;
		}
		if (isset($population) ){
			$realisation .=  " and (realisation_financiere.paiement)*100/( action.Montant )  <= " .$population;
		}
		  
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$realisation .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }

			 
 
		if ( isset($_POST['physique'])and $physique ==0) {
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=0 " ;
		}
 
		if ( isset($_POST['physique'])and $physique == 100){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )=".$physique            ;
		}
		if (  isset($_POST['physique']) and $physique !=100 and $physique !=0){
			$realisation .=  " and (realisation_physique.realisation_physique)*100/( action.Quantite )<=".$physique            ;
		}
		if (!empty($action)){
			$realisation .=  "  and  nomenclature.id =   " .$action    ;
		}
		if ( isset($_POST['cloture']) and $_POST['cloture']=="ok"){
			$realisation .=  "  and  action.cloture not".'null'. ""      ;
		}elseif(isset($_POST['cloture']) and $_POST['cloture']==""){
			$realisation .=  "  and  action.cloture is".'null'. ""      ;
		}
		 

	 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription_foret = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$realisation .=  "  and observation <>'annulee'"  ;
		}

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$realisation .=  "  and observation ='annulee'"  ;		}
if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$realisation .=  "  and observation ='volumeAnnulée'"  ;		}
 if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$realisation .=  "  and observation = ''"  ;		}

	 
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	$actions=$res->fetch(PDO::FETCH_OBJ);
 
$res ->closeCursor();
	return $actions ; // Accès au résultat
		 			}



		 			
public function selectForm (){
$bdd = parent::getBdd();

	$realisation="SELECT * FROM action, realisation_physique, realisation_financiere, ppdri  WHERE
	realisation_physique.Code = action.Code_Actions AND
	realisation_financiere.Code =action.Code_Actions AND
 ppdri.code_du_ppdri=action.code_ppdri and
 code_actions='$_GET[code_actions]'  ";

$res= $bdd->query($realisation) ; 
$actions=$res->fetch(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
		 			}
public function selectFormIndicateur ($codeindicateur="",$code_projet=""){
$bdd = parent::getBdd();
//CodeIndicateur represente est 
$indicateur=" SELECT * from iov, indicateurs,ppdri where 
indicateurs.id  = iov.codeindicateur and
 ppdri.Code_du_PPDRI = iov.code_projet AND

codeindicateur='$_GET[codeindicateur]' and
code_projet='$_GET[code_projet]'

 ";
$res= $bdd->query($indicateur) ; 
$indicateurs=$res->fetch(PDO::FETCH_OBJ);
	return $indicateurs ; // Accès au résultat

}

public function elevage($a){
	$bdd = parent::getBdd();
$a=$_GET['code_actions'];
$realisation="SELECT * FROM action, elevage WHERE
	action.Code_Actions = elevage.co AND
	 
 code_actions='$_GET[code_actions]'  ";

$res= $bdd->query($realisation) ; 
$actions=$res->fetchAll(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
     
}
public function SommPaiementelevage($a){
	$bdd = parent::getBdd();
$a=$_GET['code_actions'];
$realisation="SELECT sum(asf) as montant  FROM action, elevage WHERE
	action.Code_Actions = elevage.co AND
	 
 code_actions='$_GET[code_actions]'   ";

$res= $bdd->query($realisation) ; 
$actions=$res->fetch(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
     
}
public function NombreBeneficiareElevage($a){
	$bdd = parent::getBdd();
$a=$_GET['code_actions'];
$realisation="SELECT count(asf) as beneficiare FROM action, elevage WHERE
	action.Code_Actions = elevage.co AND
	 
 code_actions='$_GET[code_actions]'   ";

$res= $bdd->query($realisation) ; 
$actions=$res->fetch(PDO::FETCH_OBJ);
	return $actions ; // Accès au résultat
     
}
public function getBdd(){
	$bdd = parent::getBdd();

     $this->bdd=$bdd;
     return $bdd;
}
public function formulaire(){
	$bdd = parent::getBdd();
 $req = $bdd->prepare('UPDATE realisation_physique, realisation_financiere SET NomActions=:NomActions, Quantite=:Quantite, realisation_physique=:realisation_physique,
  Montant =:Montant , Paiement=:Paiement WHERE Code=".$_GET["Code"]');
$req->execute(array(
	'NomActions'=>UTF8_decode(addslashes($NomActions)),
	'Quantite'=>addslashes($Quantite),
	'realisation_physique'=>UTF8_decode(addslashes($realisation_physique)),
	'Montant'=>UTF8_decode(addslashes($Montant)),
	'Paiement'=>UTF8_decode(addslashes($Paiement)),
	'Code'=>$p
    ));
    $req->closeCursor();
 
				$req->execute();
				$data = $req->fetch();
				$NomActions = $data['NomActions'];
				$Quantite = $data['Quantite'];
				$realisation_physique = $data['realisation_physique'];
				$Montant = $data['Montant'];
				$Paiement=$data['Paiement'];
				$req->closeCursor();
   
  }
  //taux de realisation par action

public function tauxAction (){

$bdd = parent::getBdd();
$url=$_GET['Code_du_PPDRI'];

$sql = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,cloture,observation,maitre_ouvrage,
  (realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique ,
   (realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant
    FROM 
    action, realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI AND
   /*observation   not like  'annulee' and*/
     Code_PPDRI= ? 
     ";
     $sql1 = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,cloture,observation,maitre_ouvrage,
  (realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique ,
   (realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant
    FROM 
    action, realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI AND
/*observation   not like  'annulee' and*/
     Code_PPDRI= '$_GET[Code_du_PPDRI]' and action.source_financement=?  
     ";
$sql2 = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,cloture,observation,maitre_ouvrage,
  (realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique ,
   (realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant
    FROM 
    action, realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI AND
Code_PPDRI= '$_GET[Code_du_PPDRI]'  ";

 $sql3 = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,cloture,observation,maitre_ouvrage,
  (realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique ,
   (realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant
    FROM 
    action, realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI AND
Code_PPDRI= '$_GET[Code_du_PPDRI]' and    action.source_financement=?  ";


if(!isset ($_POST['source']) and  !isset ($_POST['etat']) ){
// l'utilisateur n' a pas choisi aucun critère 
$datas= $bdd->prepare($sql) ; 
$datas->execute( array($url));
 
$da=$datas->fetchAll(PDO::FETCH_OBJ);
$datas->closeCursor();

}
if( isset ($_POST['source']) and  !isset ($_POST['etat']))
{
	// l'utilisateur  a   choisi uniquement la source de financement 
	$datas= $bdd->prepare($sql1) ; 
$datas->execute( array(  $_POST['source']));
$da=$datas->fetchAll(PDO::FETCH_OBJ);

$datas->closeCursor();

}

if(   isset($_POST['etat']) and !isset($_POST['source'])     )
{
// l'utilisateur  a   choisi uniquement l'état de l'action???????????

	$etat = $_POST['etat'];
		 
		if (  $_POST['etat']=="validee" ){
		 
	  
			$sql2 .=  "  and observation <>'annulee'"  ;
		}elseif( $_POST['etat'] =="annulee" ){
   
$sql2 .=  "  and observation ='annulee'"  ;	
	}elseif($_POST['etat'] =="volumeAnnulée" ){
   
$sql2 .=  "  and observation ='volumeAnnulée'"  ;
		}elseif(  $_POST['etat'] =="volumesansrar" ){
   
$sql2 .=  "  and observation =' ' "  ;
		}elseif($_POST['etat']=="ok"){
			$sql2 .=  "  and  action.cloture not".'null'. ""      ;
		}elseif($_POST['etat']=="non"){
		$sql2 .=  "  and  action.cloture is".'null'. ""      ;	
		}

 	$datas= $bdd->prepare($sql2) ; 
$datas->execute() ;
$da=$datas->fetchAll(PDO::FETCH_OBJ);

$datas->closeCursor();

}
 	
if(isset($_POST['source']) and   isset($_POST['etat']))
{


	$etat = $_POST['etat'];
		 
		if (  $_POST['etat']=="validee" ){
		 
	  
			$sql3 .=  "  and observation <>'annulee'"  ;
		}elseif( $_POST['etat'] =="annulee" ){
   
$sql3 .=  "  and observation ='annulee'"  ;	
	}elseif($_POST['etat'] =="volumeAnnulée" ){
   
$sql3 .=  "  and observation ='volumeAnnulée'"  ;
		}elseif(  $_POST['etat'] =="volumesansrar" ){
   
$sql3 .=  "  and observation =''"  ;
		} elseif($_POST['etat']=="ok"){
			$sql3 .=  "  and  action.cloture not".'null'. ""      ;
		}elseif($_POST['etat']=="non"){
		$sql3 .=  "  and  action.cloture is".'null'. ""      ;	
		}

 	$datas= $bdd->prepare($sql3) ; 
$datas->execute(array( $_POST['source'])) ;
$da=$datas->fetchAll(PDO::FETCH_OBJ);

$datas->closeCursor();

}






if(empty($_POST['source']) and  empty($_POST['etat']))
 {
	 
$datas= $bdd->prepare($sql) ; 
$datas->execute( array($url));
$da=$datas->fetchAll(PDO::FETCH_OBJ);
$datas->closeCursor();

} 

	return $da ; // Accès au résultat
}
public function tauxActionCloture (){

$bdd = parent::getBdd();

$sql = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,annee,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,observation,maitre_ouvrage,
  ( action.Quantite ) - (realisation_physique.realisation_physique) AS rarPhysique ,
    ( action.Montant ) -(realisation_financiere.paiement) AS rarPaiemant
    FROM 
    action, realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI   and
     Code_PPDRI='$_GET[Code_du_PPDRI]' 

      ";
 $resTaux= $bdd->query($sql) ;
$TAUX=$resTaux->fetchAll(PDO::FETCH_OBJ);
return $TAUX;


}
public function anneeCloture (){

$bdd = parent::getBdd();

$sql = "SELECT *
    FROM 
    ppdridate , ppdri
  WHERE codeppdri = Code_du_PPDRI 
   
   and
     codeppdri='$_GET[Code_du_PPDRI]'  ";
 $resTaux= $bdd->query($sql) ;
$TAUX=$resTaux->fetch(PDO::FETCH_OBJ);
return $TAUX;


}

public function tauxActionglobal (){

$bdd = parent::getBdd();

$sql = "SELECT NomActions,Unit,Quantite,realisation_physique, Montant, paiement,
 Source_Financement,Code_Actions, Code_du_PPDRI,Code_PPDRI,commune,
  (realisation_physique.realisation_physique)*100/( action.Quantite ) AS tauxPhysique ,
   (realisation_financiere.paiement)*100/( action.Montant ) AS tauxPaiemant FROM action
 , realisation_physique,realisation_financiere, ppdri
  WHERE realisation_physique.Code = action.Code_Actions 
  AND realisation_financiere.Code =action.Code_Actions and 
action.Code_PPDRI=ppdri.Code_du_PPDRI  and  realisation_physique!=0  ";
 $resTaux= $bdd->query($sql) ;
$TAUX=$resTaux->fetchAll(PDO::FETCH_OBJ);
return $TAUX;


}
public function tauxProjet (){

$bdd = parent::getBdd();
$url=$_GET['Code_du_PPDRI'];

$sql = "SELECT Localite,sum(action.Montant) as montantProjet,
SUM(realisation_financiere.paiement) as totalpaiement  FROM action ,
 ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI AND action.Montant!=0 and
     Code_PPDRI=?   
     group by ppdri.localite";
$sql1 = "SELECT Localite,sum(action.Montant) as montantProjet,
SUM(realisation_financiere.paiement) as totalpaiement  FROM action ,
 ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI AND action.Montant!=0 and
     Code_PPDRI='$_GET[Code_du_PPDRI]' and action.source_financement=?  
     group by ppdri.localite";


if(!isset ($_POST['source'])  ){

$datas= $bdd->prepare($sql) ; 
$datas->execute( array($url));
 
$da=$datas->fetch(PDO::FETCH_OBJ);
$datas->closeCursor();

}elseif(isset ($_POST['source']) and $_POST['source']!=null ){

$datas= $bdd->prepare($sql1) ; 
$datas->execute( array(  $_POST['source']));
$da=$datas->fetch(PDO::FETCH_OBJ);

$datas->closeCursor();
}elseif(empty($_POST['source'])  ){

$datas= $bdd->prepare($sql) ; 
$datas->execute( array($url));
$da=$datas->fetch(PDO::FETCH_OBJ);
$datas->closeCursor();
}
 

	return $da ; // Accès au résultat

}
public function tauxProjetCloture (){

$bdd = parent::getBdd();

$bdd = parent::getBdd();


$sql = "SELECT Localite,sum(action.Montant) as montantProjet, maitre_ouvrage,
SUM(realisation_financiere.paiement) as totalpaiement 
 FROM action , ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI AND action.Montant!=0 
  	  and
     Code_PPDRI='$_GET[Code_du_PPDRI]' and
        maitre_ouvrage='C-FORETS'
     group by ppdri.localite,maitre_ouvrage 
     order by maitre_ouvrage ";
 $resTaux= $bdd->query($sql) ;

$TAUX=$resTaux->fetch(PDO::FETCH_OBJ);
return $TAUX;


}

public function SommeLigne2ProjetCloture (){

$bdd = parent::getBdd();


$sql = "SELECT Localite,sum(action.Montant) as montantProjet, maitre_ouvrage,
SUM(realisation_financiere.paiement) as totalpaiement 
 FROM action , ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI AND action.Montant!=0 
  	and maitre_ouvrage='C-FORETS' 
  	and Source_Financement ='FNDR'AND

     Code_PPDRI='$_GET[Code_du_PPDRI]'   
     group by ppdri.localite,maitre_ouvrage , Source_Financement";
 $resTaux= $bdd->query($sql) ;

$TAUX=$resTaux->fetch(PDO::FETCH_OBJ);
return $TAUX;


}

 
public function NombreEtatCloture (){
// model qui gere le nombre d'actions non receptionnées ligne 2
	// si =0 tous les actions ligne 2 receptionnées définitivement
	// si <>0 au moins 1 actions n'est pas récéptionnnée
$bdd = parent::getBdd();

$sql = "SELECT  *  
 FROM action , ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI  
  	and Source_Financement ='FNDR'
  	AND action.cloture is  null and
  	observation not like'annulee' and

     Code_PPDRI='$_GET[Code_du_PPDRI]'   
     group by ppdri.localite,maitre_ouvrage , Source_Financement,action.code_ppdri ,action.code_actions, ppdri.code_du_ppdri,realisation_financiere.id,realisation_financiere.code";

 $sqlCloture= $bdd->prepare($sql) ;
 $sqlCloture->execute();

 $NombreActionsNonCloture=$sqlCloture->rowCount();



 
 return $NombreActionsNonCloture;


}

public function existeLigne2 (){
// model qui gere la presence ou non de la ligne 2  
	// si =0 ligne 2 inexistante
	// si <>0 ligne 2  existe
$bdd = parent::getBdd();

$sql = "SELECT  *   
 FROM action , ppdri, realisation_financiere
  WHERE  realisation_financiere.Code =action.Code_Actions AND
  	ppdri.Code_du_PPDRI = action.Code_PPDRI  
  	and Source_Financement ='FNDR'
  	  and
  	observation is not null   and

     Code_PPDRI='$_GET[Code_du_PPDRI]'   
     group by ppdri.localite,maitre_ouvrage , Source_Financement,action.code_ppdri ,action.code_actions, ppdri.code_du_ppdri,realisation_financiere.id,realisation_financiere.code";

 $sqlCloture= $bdd->prepare($sql) ;
 $sqlCloture->execute();

 $NombreActionsNonCloture=$sqlCloture->rowCount();



 
 return $NombreActionsNonCloture;


}
public function graphReceptionDefinitive($population=""  , $departement=""  , $Annee="", $finance="" ,$physique ="",$action="" , $cloture="" , $circonscription=""){
$bdd = parent::getBdd();

	$realisation="SELECT  circonscription,count(cloture) as receptions
	 FROM 
	  ppdri,action,ppdridate
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 
		 ppdridate.codeppdri=ppdri.code_du_ppdri AND action.maitre_ouvrage ='C-FORETS'
		 " ; 
    
	

if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription = '".$circonscription."'";
		 	}
			
		}
		

		 $realisation .= " group by    circonscription   ";
	  
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	

$res ->closeCursor();
	return $res ; // Ac

}

public function circonscription(){
$bdd = parent::getBdd();

	$realisation="SELECT  * from users 
	    WHERE
	name   <>'ADMIN' order by name  asc
		 " ; 
    
	


	  
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	$cir=$res->fetchAll(PDO::FETCH_OBJ);

$res ->closeCursor();
	return $cir ; // Ac

}
public function tableGraph($url=""){
$bdd = parent::getBdd();
 

	$realisation="SELECT  distinct commune, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ) ,circonscription , ( count(cloture)*100/count(action.code_actions)) as tauxreception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like'annulee'  and circonscription = ? group by   commune,circonscription  " ; 



		 $realisationTotal="SELECT  distinct commune, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ),circonscription ,( count(cloture)*100/count(action.code_actions)) as tauxreception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like'annulee'      group by   commune ,circonscription   " ; 

		 $realisationTotalPost="SELECT  distinct commune, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ),circonscription ,( count(cloture)*100/count(action.code_actions)) as tauxreception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like 'annulee'   and circonscription=? group by  commune,circonscription "; 
		
		 if(isset($_GET['circonscription']) and ! isset($_POST['search'])){
		 	$url=$_GET['circonscription'];
		 	 $result= $bdd->prepare($realisation);
			$result->execute(array($_GET['circonscription']));
			$users = $result->fetchAll(PDO::FETCH_ASSOC);

		 }
		 if (! isset($_GET['circonscription']) and ! isset($_POST['search'])) {
		 	 
			$result= $bdd->prepare($realisationTotal);
			$result->execute();
			$users = $result->fetchAll(PDO::FETCH_ASSOC);
		 }
		 if ( isset($_POST['search'])) {
		 	  
			extract($_POST);
			$users=$_POST['circonscriptionchoisie'];
			$result= $bdd->prepare($realisationTotalPost);
			$result->execute(array($users))  ;
			$users = $result->fetchAll(PDO::FETCH_ASSOC);
		 } 
		 
 

	return $users ; // Ac

}
public function tableGraphCirconscription($url="", $request=""){
$bdd = parent::getBdd();
 

	$realisation="SELECT  distinct circonscription, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ) ,
   (count(action.code_actions)-count(cloture))  as nbrrestant ,( count(cloture)*100/count(action.code_actions)) as tauxreception

	from  
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like'annulee'  and circonscription = ? group by   circonscription " ; 

		 $realisationTotal="SELECT  distinct circonscription, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ) ,
   (count(action.code_actions)-count(cloture))  as nbrrestant ,( count(cloture)*100/count(action.code_actions)) as tauxreception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like'annulee'      group by    circonscription  " ; 

		 $realisationTotalPost="SELECT  distinct circonscription, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ) ,
   (count(action.code_actions)-count(cloture))  as nbrrestant ,( count(cloture)*100/count(action.code_actions)) as tauxreception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like 'annulee'   and circonscription=? group by   circonscription"; 
		
		 if(isset($_GET['circonscription']) and ! isset($_POST['search'])){
		 	$url=$_GET['circonscription'];
		 	 $result= $bdd->prepare($realisation);
			$result->execute(array($_GET['circonscription']));
			$users = $result->fetchAll(PDO::FETCH_ASSOC);

		 }
		 if (! isset($_GET['circonscription']) and ! isset($_POST['search'])) {
		 	 
			$result= $bdd->prepare($realisationTotal);
			$result->execute();
			$users = $result->fetchAll(PDO::FETCH_ASSOC);
		 }
		 if ( isset($_POST['search'])) {
		 	  
			extract($_POST);
			$users=$_POST['circonscriptionchoisie'];
			$result= $bdd->prepare($realisationTotalPost);
			$result->execute(array($users))  ;
			$users = $result->fetchAll(PDO::FETCH_ASSOC);
		 } 
		 
 

	return $users ; // Ac

}

public function ReceptionDefinitiveGenerale( $circonscription=""){
$bdd = parent::getBdd();

	$realisation="SELECT   count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ) ,
   (count(action.code_actions)-count(cloture))  as nbrRestant ,( count(cloture)*100/count(action.code_actions)) as tauxReception
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like'annulee'     
		 " ; 
    
	

if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$realisation .=  " and circonscription = '".$circonscription."'";
		 	}
			
		}
		

 	  
	$res= $bdd->prepare($realisation) ; 
  $res -> execute();
	
			$users = $res->fetch(PDO::FETCH_ASSOC);

$res ->closeCursor();
	return $users ; // Ac

}

}

