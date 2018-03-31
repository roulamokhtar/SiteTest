<?php
/*
 * Modele de classe PHP : Map.php
 * Classe d'affichage des markers sur une Google Maps
 */

class Map extends BDD{
 
 

 
//__Affiche l'ensemble des annees
//__l'ordre est fait selon les noms de annees
    function getAnnee() {
        $bdd = parent::getBdd();
		
		$sql =parent:: SELECT('');
		$sql .=parent:: DISTINCT ('annee') ;
		$sql .= parent::FROM('ppdri');
		$sql .= parent::ORDERBY('annee ');
		
        $datas = $bdd->query($sql);
		
		while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
             
        }
		
        return $billet; // Accès au résultat
    } 

 function getAction() {
 	$bdd = parent::getBdd();
 	$sql ="select distinct action.nomactions,nomenclature.id from action,nomenclature 
 	WHERE 
 action.nomactions = nomenclature.nomenclature  
 and action.source_financement like 'FNDR'
 	order by id asc";
        
        $datas = $bdd->query($sql);
		
		while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
             
        }
		
        return $billet; // Accès au résultat
    }
function getNomAction() {
 	$bdd = parent::getBdd();
 	$a=$_POST['nomactions'];
 	$sql ="select distinct action.nomactions,nomenclature.id from action,nomenclature 
 	WHERE 
 action.nomactions = nomenclature.nomenclature  
 and
 	nomenclature.id= ?
  order by id asc";
        
        $datas = $bdd->prepare($sql);
        $datas->execute(array($a));
		
		while ($resultat = $datas->fetch()) {
            $billet = $resultat[0];
             
        }
		 $datas->closeCursor();
        return $billet; // Accès au résultat
    }


//__l'ordre est fait selon les noms de annees
   
//__Affiche l'ensemble des Communes
//__l'ordre est fait selon les noms de Communes
    function getDepartements($circonscription="" ) {
        $bdd = parent::getBdd();
		
		$sql = parent::SELECT('distinct id_departement as id, nom_departement as departement, circonscription_foret');
		$sql .= parent::FROM('markers_departements');

		if (!empty($circonscription)){
		$circonscription =$_SESSION['name'];

		 	if($circonscription !=="admin"){
		 		$sql .= parent::WHERE("circonscription_foret='".$circonscription."'");
 		 	}
			
		} 
		$sql .= parent::ORDERBY('departement');
		
        $datas = $bdd->query($sql);
		
		while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
        }
		
        return $billet; // Accès au résultat
    }

	function getNomDepartements($circonscription="" ) {
        $bdd = parent::getBdd();
		
		$sql = "SELECT  * FROM markers_departements ";
		 
		 if(isset($_POST['departement'])){
	$departementss = $_POST['departement'];
	$sql .= " where id_departement=".$departementss."";
}
		
        $res = $bdd->prepare($sql);
        $res->execute();
		 $datas=$res->fetch(PDO::FETCH_OBJ);
        return $datas; // Accès au résultat
    }
    function getNomLocalites($localitess="" ) {
        $bdd = parent::getBdd();
		
		$sql = "SELECT  ville_nom_reel,ville_id  FROM markers_villes ";
		 
		 if(isset($_POST['localite'])){
	$localitess = $_POST['localite'];
	$sql .= " where ville_id=".$localitess ;
}
		
        $res = $bdd->prepare($sql);
        $res->execute();
		 $datas=$res->fetch(PDO::FETCH_OBJ);
        return $datas; // Accès au résultat
    }
	
//__Affiche les villes selon un nombre déterminé d'habitants
//__Permet de choisir le MIN et le MAX d'habitants que l'on veut 
    function getVilles( $populationStart = "", $populationEnd = "", $departement = "", $order = "" ) {
        $bdd = parent::getBdd();
		
		$sql = parent::SELECT('`ville_id` AS id, `ville_population_2010` , `nom_departement`, `ville_nom_reel` AS ville, `ville_longitude_deg` AS longitude, `ville_latitude_deg` AS latitude');
		$sql .= parent::FROM('`markers_villes`, `markers_departements`');
		$sql .= parent::WHERE('markers_departements.id_departement = markers_villes.ville_departement');
		
		if (!empty($populationStart)){
			$sql .= parent::WHEREAND('ville_population_2010 >= '.$populationStart);
			if (!empty($populationEnd)){
				$sql .= parent::WHEREAND('ville_population_2010 < '.$populationEnd);
			}
		} else {
			$sql .= parent::WHEREAND('ville_population_2010 <= 100');
		}
		
		if (!empty($departement)){
			$sql .= parent::WHEREAND('markers_villes.ville_departement = '.$departement);
		}
		
		if (!empty($order)){
			$sql .= parent::ORDERBY( $order );
		} else {
			$sql .= parent::ORDERBY( 'ville_population_2010', 'ASC' );
		}
		
        $datas = $bdd->query($sql);
		
		return $datas; // Accès au résultat
    }
 
function getCODE0( $population="", $departement = "", $Annee="",$finance="",$localite="",$circonscription="") {
      	 // pour la partie MAPS
  	 $bdd = parent::getBdd();
  // destruction  de la table table_Pourcentage si elle existe

	$taableS="DROP  table IF EXISTS table_Pourcentage   ";
	$ts = $bdd->prepare($taableS); 
  $ts->execute();
  // creation de la nouvelle table table_Pourcentage

 $taable  =" CREATE  table 	table_Pourcentage as 
 	select  Code_du_PPDRI as code_porcentage, round(SUM(realisation_financiere.paiement)*100/SUM(action.Montant ),2) AS tauxPaiemant, ville  ,source_financement as source
    FROM ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements,ppdridate 
    where  
  		ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND

		  ppdri.code_du_ppdri=ppdridate.codeppdri and
         localite is not null";

	if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$taable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
 if (!empty($localite)){
			$taable .=  " and markers_villes.ville_id = '".$localite."'";
		} 
		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$taable .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}

	$taable  .=" group by  ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,annee,type_de_programme,Commune,code_du_ppdri, circonscription,ville_id, source_financement ";	
if ( $population== 'egal0'){
			$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  = 0"  ;
		}
		
		  

  $tt = $bdd->prepare($taable); 
  $tt->execute();
  // creation de la table
$sql = "SELECT  
    localite,ville_longitude_deg AS longitude ,ville_latitude_deg  AS latitude ,   ville_id as id  ,   ville_departement  ,ville_id , type_de_programme,

count(distinct Code_du_PPDRI ) as nombreprojets, 
 array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI)  )  ORDER BY 1),',') as ccode, 
 

array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI ||' : ' ||   tauxPaiemant|| ' % '  ) )  ORDER BY 1),',') as codeDesProjets ,array_to_string(ARRAY(SELECT unnest(array_agg(distinct source_financement ||'  '    ) )  ORDER BY 1),' ') as  financement

 FROM ppdri, markers_villes,markers_departements, table_Pourcentage ,action

  WHERE 
  table_Pourcentage.code_porcentage  = ppdri.Code_du_PPDRI and  action.code_ppdri = ppdri.Code_du_PPDRI and
  		 
		 table_Pourcentage.source=action.source_financement and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement ";
		  if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$sql .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
		  
		 $sql .=" group by
		   localite,ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,type_de_programme  ";

	 $datas = $bdd->prepare($sql); 
	 $datas->execute();
 
  
        return $datas;

 	}


function getCODE( $populationStart = "", $populationEnd = "", $departement = "", $Annee="",$finance="",$localite="",$etat="",$cloture="",$programme="",$circonscription="") {
      	 // pour la partie MAPS
  	 $bdd = parent::getBdd();
  // destruction  de la table table_Pourcentage si elle existe

	$taableS="DROP  table IF EXISTS table_Pourcentage   ";
	$ts = $bdd->prepare($taableS); 
  $ts->execute();
  // creation de la nouvelle table table_Pourcentage

 $taable  =" CREATE  table 	table_Pourcentage as 
 	select  Code_du_PPDRI as code_porcentage, round(SUM(realisation_financiere.paiement)*100/SUM(action.Montant ),2) AS tauxPaiemant 
    FROM ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements , ppdridate
    where  
  		ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
		  ppdridate.codeppdri = ppdri.Code_du_PPDRI and
         localite is not null ";

	if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}
		 if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$taable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
		 }
		 if (!empty($localite)){
			$taable .=  " and markers_villes.ville_id = '".$localite."'";
		} 
		if (isset($_POST['programme'])){
					$programme=$_POST['programme'];
					 
				$taable .=  " and ppdri.type_de_programme in ('" . implode("','", $programme) . "')";  
		 }
		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$taable .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}
		 if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$taable .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$taable .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$taable .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$taable .=  "  and observation =' '"  ;		}

if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$taable .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$taable .=  "  and cloture is  null"  ;		}

 //var_dump($localite);
	$taable  .= " group by  ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,annee,type_de_programme,Commune,code_du_ppdri,circonscription ,ville_id ";	
if (!empty ($populationStart) and $populationStart!=150 ){
			$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
		}elseif(!empty ($populationStart) and $populationStart==150  ){
$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) =0 " ;
		}else{

						$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= 0";

		}
		
		if ( !empty($populationEnd)){
			$taable .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) < ".$populationEnd;	 
		} 
// var_dump($populationStart);

  $tt = $bdd->prepare($taable); 
  $tt->execute();
  // creation de la table
$sql = "SELECT  
  distinct  localite,ville_longitude_deg AS longitude ,ville_latitude_deg  AS latitude ,   ville_id as id  ,   ville_departement  ,ville_id , type_de_programme,

count(distinct Code_du_PPDRI ) as nombreprojets, 
 array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI)  )  ORDER BY 1),',') as ccode ,
 

array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI ||' : ' ||   tauxPaiemant|| ' % '  ) )  ORDER BY 1),',') as codeDesProjets, 
array_to_string(ARRAY(SELECT unnest(array_agg(distinct source_financement ||'   '    ) )    ORDER BY 1),' ')  as  financement

 FROM ppdri, markers_villes,markers_departements, table_Pourcentage,action

  WHERE 
  table_Pourcentage.code_porcentage  = ppdri.Code_du_PPDRI and action.code_ppdri = ppdri.Code_du_PPDRI and 
  		 
		 table_Pourcentage.code_porcentage  = action.code_ppdri and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement ";
if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$sql .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
		 }
		 
		 $sql .= " group by ppdri.localite,ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,type_de_programme     ";
 
							 

	 $datas = $bdd->prepare($sql); 
	 $datas->execute();
	  
	  return $datas;
 	}


function getNombreProjets0( $population="", $departement = "", $Annee="",$finance="",$circonscription="") {
      	 // pour la partie MAPS
  	 $bdd = parent::getBdd();
$sql = "SELECT distinct Code_du_PPDRI,localite,ville_longitude_deg AS longitude ,ville_latitude_deg AS latitude , ville_id as id , ville_departement ,ville_id , type_de_programme, count(distinct Code_du_PPDRI ) as nombreprojets, array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI) ) ORDER BY 1),',') as ccode, array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI ||' : ' || tauxPaiemant|| ' % ' ) ) ORDER BY 1),',') as codeDesProjets FROM ppdri, markers_villes,markers_departements, table_Pourcentage,ppdridate

 WHERE table_Pourcentage.code_porcentage = ppdri.Code_du_PPDRI and markers_villes.ville_id = ppdri.ville and markers_departements.id_departement=markers_villes.ville_departement and ppdri.code_du_ppdri=ppdridate.codeppdri
group by Code_du_PPDRI,localite,ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement ,type_de_programme,circonscription  ";
 
							 

	 $datas = $bdd->prepare($sql); 
	 $datas->execute();
	  
	  return $datas;
	}





 	function getprojetCloture( $populationStart = "", $populationEnd = "", $departement = "", $Annee="") {
      	 // pour la partie  cloture de projets
  	 $bdd = parent::getBdd();
  // destruction  de la table table_Pourcentage si elle existe

	$taableS="DROP  table IF EXISTS table_cloture   ";
	$ts = $bdd->prepare($taableS); 
  $ts->execute();
  // creation de la nouvelle table table_Pourcentage

 $taable  =" CREATE  table 	table_cloture as 
 	select  Code_du_PPDRI as code_porcentage, round(SUM(realisation_financiere.paiement)*100/SUM(action.Montant ),2) AS tauxPaiemant 
    FROM ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements 
    where  
  		ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement AND
         localite is not null";

	if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}

	$taable  .=" group by  ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,annee,type_de_programme,Commune,code_du_ppdri  ";	
if (!empty($populationStart)){
			$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
		}
		
		if (!empty($populationEnd)){
			$taable .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) < ".$populationEnd;	 
		} 
 

  $tt = $bdd->prepare($taable); 
  $tt->execute();
  // creation de la table
$sql = "SELECT  
  distinct  localite,ville_longitude_deg AS longitude ,ville_latitude_deg  AS latitude ,   ville_id as id  ,   ville_departement  ,ville_id , type_de_programme,

count(distinct Code_du_PPDRI ) as nombreprojets, 
 array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI)  )  ORDER BY 1),',') as ccode, 
 

array_to_string(ARRAY(SELECT unnest(array_agg(distinct Code_du_PPDRI ||' : ' ||   tauxPaiemant|| ' % '  ) )  ORDER BY 1),',') as codeDesProjets 

 FROM ppdri, markers_villes,markers_departements, table_Pourcentage

  WHERE 
  table_Pourcentage.code_porcentage  = ppdri.Code_du_PPDRI and 
  		 
		 
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement=markers_villes.ville_departement 
		  
		  group by
		   localite,ville_id,ville_longitude_deg,ville_latitude_deg,ville_departement
,type_de_programme   ";
 
							 

	 $datas = $bdd->prepare($sql); 
	 $datas->execute();
	  
	  return $datas;
 	}

function getBase0( $population ,  $departement = "", $Annee="", $finance="",$circonscription="",$programme="",$circonscription_foret="") {
      	 // pour la partie BASE DE DONNEES
 		  	 $bdd = parent::getBdd();
  	$sql = "SELECT  round(  (SUM(realisation_financiere.paiement)   / 
        SUM(action.montant)  ) * 100,2) 
        	AS tauxPaiemant,(select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement='FNDR' AND cloture is null and observation not like  'annulee' GROUP BY action.Code_PPDRI ) as t,(select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement='FNDR'  and observation not like  'annulee' GROUP BY action.Code_PPDRI ) as z,
      Code_du_PPDRI,localite,ville_id,type_de_programme,Commune,annee,circonscription,circonscription_foret
FROM    action
       JOIN realisation_financiere 
             ON        action.Code_Actions  =realisation_financiere.Code   
                 
             JOIN ppdri 
             ON       action.Code_PPDRI  = ppdri.Code_du_PPDRI
             
              JOIN markers_villes 
             ON        ppdri.ville  =markers_villes.ville_id  

             JOIN markers_departements 
             ON        markers_departements.id_departement=markers_villes.ville_departement
             JOIN ppdridate 
             ON        ppdridate.codeppdri=ppdri.Code_du_PPDRI


        where localite is not null   

       
";
					  

		if (!empty($departement)){
			$sql .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$sql .=  " and ppdri.annee = " .$Annee;
		}

if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$sql .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
 if (isset($_POST['programme'])){
					$programme=$_POST['programme'];
					 
				$sql  .=  " and ppdri.type_de_programme in ('" . implode("','", $programme) . "')";  
		 }
if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$sql .=  " and circonscription = '".$circonscription."'";
		 	}
			
		}
		 if(   !isset($circonscription_foret)){
	  $circonscription_foret ="";
		 		 $sql .= " and ville_departement is not null "; 
		 	 
		 	}
		 	//else{
 //$circonscription_foret =  $_POST['circonscription_foret'] ;
  
// $sql .=  " and circonscription_foret in ('" . implode("','", $circonscription_foret) . "')";  

		 		
		 //	}

	 $sql.=" GROUP  BY ppdri.Code_du_PPDRI,ville_id ,ppdridate.circonscription, type_de_programme,circonscription_foret";
 		if ( $population =="egal0"){
			$sql .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  = 0" ;
		}
		
		 
		$sql.=" ORDER  BY annee";
	 $datas = $bdd->query($sql); 
	  
        return $datas;
 	}



 	function getBaseDonnees(   $populationStart = "", $populationEnd = "", $departement = "", $Annee="",$finance="", $circonscription="",$pv="", $programme="",$circonscription_foret="",$localite="",$etat="") {
      	 // pour la partie BASE DE DONNEES
 		  	 $bdd = parent::getBdd();

$tableCloture="DROP  table IF EXISTS table_cloture   ";
 $tc = $bdd->prepare($tableCloture);  
  $tc->execute();
  		  	 $taable  =" CREATE  table 	table_cloture as
 		  	SELECT  round(  (SUM(realisation_financiere.paiement)* 100   / 
        SUM(action.montant)  ) ,2) 
        	AS tauxPaiemant, (select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement='FNDR' AND cloture is null and observation not like  'annulee' GROUP BY action.Code_PPDRI ) as t,(select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement  like'FNDR'  GROUP BY action.Code_PPDRI ) as f,(select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement='FNDR'  and observation not like  'annulee' GROUP BY action.Code_PPDRI ) as z,
      Code_du_PPDRI,localite,markers_villes.ville_id,type_de_programme,Commune,annee,circonscription, circonscription_foret,markers_villes.ville_departement, code_ppdri
FROM    action,markers_villes,markers_departements,ppdridate,
       realisation_financiere, ppdri where
                    action.Code_Actions  =realisation_financiere.Code   and
                 
             
                    action.Code_PPDRI  = ppdri.Code_du_PPDRI and
             
                   Code_du_PPDRI  is not null and ppdri.ville  =markers_villes.ville_id   and 
markers_departements.id_departement=markers_villes.ville_departement and 
ppdridate.codeppdri=ppdri.Code_du_PPDRI "  ;
					 
		if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}
		if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$taable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
		 }
		 if (!empty($localite)){
			$taable .=  " and markers_villes.ville_id = '".$localite."'";
		} 
if (isset($_POST['programme'])){
					$programme=$_POST['programme'];
					 
				$taable .=  " and ppdri.type_de_programme in ('" . implode("','", $programme) . "')";  
		 }

		 
			
		 
		 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$taable .=  " and ppdridate.circonscription = '".$circonscription."'";
		 	}
			
		}
 
if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$taable .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$taable .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$taable .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$taable .=  "  and observation =''"  ;		}

 if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$taable .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$taable .=  "  and cloture is  null"  ;		}
		
	 $taable .=" GROUP  BY ppdri.Code_du_PPDRI,ville_id ,ppdridate.circonscription ,localite,ville_departement,type_de_programme , circonscription_foret , code_ppdri  ";

	 

if ( isset($populationStart ) ){

				$taable .=  "  HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;

			
		}else {
		 
 			$taable .=  "  HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  >= 0"  ;
		}
		 
		if (isset($populationEnd) ){
			$taable .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) <= ".$populationEnd;	 
		} 
  
		 
		$taable.=" ORDER  BY t desc";

		 $tt = $bdd->prepare($taable); 
  $tt->execute();
  $tt->closeCursor();
  // creation de la nouvelle table table

	 $sql = " select * from table_cloture where Code_du_PPDRI is not null "; 



	 if(isset($pv)&& $pv==1){
	 	$pv=$_POST['pv']; 
	 	$sql .= "and t is null and f is not null ";
	 }elseif (isset($pv)&& $pv ==2) {
	 	$pv=$_POST['pv'];
	 $sql .= "and t is not null and tauxpaiemant<>0 ";
	 } elseif (isset($pv)&& $pv ==3) {
	 	$pv=$_POST['pv'];
	 $sql .= "and tauxpaiemant=0  ";
	 }  elseif (isset($pv)&& $pv ==4) {
	 	$pv=$_POST['pv'];
	 $sql .= " and f is  null and tauxpaiemant<>0  ";
	 } 

	 if (   !empty($_POST['circonscription_foret'])){
	 
		 	 $circonscription_foret =  $_POST['circonscription_foret'] ;
 $sql .=  " and circonscription_foret in ('" . implode("','", $circonscription_foret) . "')";   
		 	}else{
		 		 $sql .= " and ville_departement is not null "; 
		 	}
$datas =$bdd->prepare($sql);
$datas->execute();

        return $datas;
 	}

 


function getVillesCommunes( $departement = "" ) {
      	 //__Affiche les localités selon les communes : $departement

  	 $bdd = parent::getBdd();
   	
	$sql = parent::SELECT( '*' );
	$sql .= parent::FROM('Tauxpaiement ');
	$sql .= parent::WHERE('ville_departement ='.$departement);
		
		
	 $datas = $bdd->query($sql); 

        return $datas;
	}

	function getLocalits(  $departement = "",$order = "" ) {
        $bdd = parent::getBdd();
		
		$sql = parent::SELECT('`ville_id` AS id, `ville_population_2010` , `nom_departement`, `ville_nom_reel` AS ville, `ville_longitude_deg` AS longitude, `ville_latitude_deg` AS latitude');
		$sql .= parent::FROM('`markers_villes`, `markers_departements`');
		$sql .= parent::WHERE('markers_departements.id_departement = markers_villes.ville_departement');
		
		if (!empty($departement) ){
			$sql .= parent::WHEREAND('markers_villes.ville_departement = '.$departement);
			
		} else {
			$sql .= parent::WHEREAND('markers_villes.ville_departement = ""');
		}
					
		if (!empty($order)){
			$sql .= parent::ORDERBY( $order );
		} else {
			$sql .= parent::ORDERBY( 'ville_population_2010', 'ASC' );
		}
		
        $datas = $bdd->query($sql);
		
		return $datas; // Accès au résultat
    }
	function getLocalite($circonscription="" ) {

 $bdd = parent::getBdd();
		
		$sql = parent::SELECT('   markers_villes.ville_id  ,ville_nom_reel, nom_departement as departement, circonscription_foret');
		$sql .= parent::FROM('markers_departements , markers_villes');

$sql .= parent::WHERE('markers_departements.id_departement = markers_villes.ville_departement');
		if (!empty($circonscription)){
		$circonscription =$_SESSION['name'];

		 	if($circonscription !=="admin"){
		 		$sql .= parent::WHEREAND("circonscription_foret='".$circonscription."'");
 		 	}
			
		} 
		$sql .= parent::GROUPBY('ville_id,markers_departements.nom_departement,circonscription_foret');
		$sql .= parent::ORDERBY('ville_id');
		
        $datas = $bdd->query($sql);
		
		while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
        }
		
        return $billet; // Accès au résultat
    }



















/*

        $bdd = parent::getBdd();



        $sql =" select distinct  localite  from ppdri order by localite";
        $datas = $bdd->query($sql);
while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
             
        }


 
		
		return $billet; // Accès au résultat
    }
    */
function getTheme() {
        $bdd = parent::getBdd();

        $sql =" select distinct  composante  from action order by composante";
        $datas = $bdd->query($sql);
while ($resultat = $datas->fetch()) {
            $billet[] = $resultat;
             
        }


 
		
		return $billet; // Accès au résultat
    }


function getCount0( $population,  $departement = "",$Annee="",$physique="", $finance="", $circonscription="") {
	$bdd = parent::getBdd();

$t="DROP  table IF EXISTS table_projet   ";
	$tz = $bdd->prepare($t); 
  $tz->execute();
  // creation de la nouvelle table table_Pourcentage

 $taaable  =" CREATE  table 	table_projet as 

SELECT (CAST(SUM(realisation_financiere.paiement) AS FLOAT) / 
        CAST(SUM(action.montant) AS FLOAT)) * 100 
        	AS tauxPaiemant,
       code_du_ppdri  
FROM    action
       JOIN realisation_financiere 
             ON        action.Code_Actions  =realisation_financiere.Code   
                 
             JOIN ppdri 
             ON       action.Code_PPDRI  = ppdri.Code_du_PPDRI
             
              JOIN markers_villes 
             ON        ppdri.ville  =markers_villes.ville_id  

             

JOIN ppdridate 
             ON        ppdridate.codeppdri=ppdri.Code_du_PPDRI
        where ville is not null 
 
      
";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		if (!empty($departement)){
			$taaable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taaable .=  " and ppdri.annee = " .$Annee;
		}
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$taaable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }

 
		 	if($circonscription !=="ADMIN"){
 $taaable .=  " and circonscription = '".$circonscription."'";
		 	}else{
		 		$taaable .=  " and ville not null"   ;
		 	} 
			
		 
	 $taaable.=" GROUP  BY  code_du_ppdri ";
 		if ($population == 'egal0'){
			$taaable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  = " .$population;
		}
		
		 

		$dat   = $bdd->query($taaable); 
$sqla="select count ( distinct code_du_ppdri) from table_projet";
	 $dd  = $bdd->query($sqla); 
	$dass=count($dd);

		 
            
 
		
		return $dass; // Accès au résultat
  
} 

    function getCount( $populationStart = "", $populationEnd = "" , $departement = "",$Annee="",$finance="", $circonscription="",$pv="") {
//__Compte le nombre de projets POUR LA PARTIE BASE DE DONNEES
$bdd = parent::getBdd();
  	$sql = "SELECT * from table_cloture  ";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		
		
	 $datas = $bdd->query($sql); 


		 
             	$count=  $datas->rowCount(); 
 
		
		return $count; // Accès au résultat
}

function getCountMaps( $populationStart = "", $populationEnd = "" , $departement = "",$Annee="",$finance="", $localite="",$etat="",$cloture="",$programme="",$circonscription="") {
	// nombre de projetssssssssssssssssss maps
 $bdd = parent::getBdd();
  	$sql = "SELECT distinct Code_du_PPDRI,(CAST(SUM(realisation_financiere.paiement) AS FLOAT) / 
        CAST(SUM(action.montant) AS FLOAT)) * 100 
        	AS tauxPaiemant,
       ville_id,type_de_programme,Commune,annee
FROM    action
       JOIN realisation_financiere 
             ON        action.Code_Actions  =realisation_financiere.Code   
                 
             JOIN ppdri 
             ON       action.Code_PPDRI  = ppdri.Code_du_PPDRI
             
              JOIN markers_villes 
             ON        ppdri.ville  =markers_villes.ville_id  

             JOIN markers_departements 
             ON        markers_departements.id_departement=markers_villes.ville_departement
             JOIN ppdridate 
             ON        ppdridate.codeppdri=ppdri.code_du_ppdri

        where localite is not null 
 
      
";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		if (!empty($departement)){
			$sql .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$sql .=  " and ppdri.annee = " .$Annee;
		}
if (isset($_POST['finance'])){
					$natureFinance=$_POST['finance'];
					 
				$sql .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
		 }

if (isset( $_POST['localite'])){
			$sql .=  " and markers_villes.ville_id = '".$localite."'";
		} 

		if (isset($_POST['programme'])){
				
					 
				$sql .=  " and ppdri.type_de_programme in ('" . implode("','", $programme) . "')";  
		 }
		if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$sql .= "  and circonscription = '".$circonscription."'";
		 	}
			
		}
		if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$sql .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$sql .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$sql .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$sql .=  "  and observation =''"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$sql .=  "  and cloture is not null"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="" ){
   
$sql .=  "  and cloture is  null "  ;		}



	 $sql.=" GROUP  BY ppdri.Code_du_PPDRI,ville_id,circonscription,annee,ville_departement";


 		if (isset($populationStart)){
			$sql .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
		}
		
		if (isset($populationEnd)){
			$sql .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) <= ".$populationEnd;	 
		} 
	 $datas = $bdd->query($sql); 

		 
             	$count=  $datas->rowCount(); 
 
		
		return $count; // Accès au résultat
}

        

		 // Accès au résultat
    function getCountLocalite0( $population ,  $departement = "", $Annee="", $finance="",$circonscription="",$programme="",$localite="",$circonscription_foret="") {
		//__Compte le nombre de localite POUR LA PARTIE BASE DE DONNEES ayant un taux 0
 
		       

$bdd = parent::getBdd();

$taableS="DROP  table IF EXISTS table_localite   ";
	$ts = $bdd->prepare($taableS); 
  $ts->execute();
  // creation de la nouvelle table table_Pourcentage

 $taable  =" CREATE  table 	table_localite as 

SELECT (CAST(SUM(realisation_financiere.paiement) AS FLOAT) / 
        CAST(SUM(action.montant) AS FLOAT)) * 100 
        	AS tauxPaiemant, 
       localite  , code_du_ppdri
FROM    action
       JOIN realisation_financiere 
             ON        action.Code_Actions  =realisation_financiere.Code   
                 
             JOIN ppdri 
             ON       action.Code_PPDRI  = ppdri.Code_du_PPDRI
             
              JOIN markers_villes 
             ON        ppdri.ville  =markers_villes.ville_id  

             JOIN markers_departements 
             ON        markers_departements.id_departement=markers_villes.ville_departement

JOIN ppdridate 
             ON        ppdridate.codeppdri=ppdri.Code_du_PPDRI
        where localite is not null 
 
      
";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$taable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
 if (!empty($localite)){
			$taable .=  " and markers_villes.ville_id = '".$localite."'";
		} 

if (!empty($circonscription) && $circonscription !=="admin" ){
		  
 $taable .=  " and circonscription = '".$circonscription."'";
		 	}
			
		 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$taable .=  " and circonscription = '".$circonscription."'";
		 	}
			
		}
		 

	 $taable.=" GROUP  BY Code_du_PPDRI,circonscription";
 		if ($population == 'egal0'){
			$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  = " .$population;
		}
		
		 

		$dat   = $bdd->query($taable); 
$sql="select count ( distinct localite) from table_localite";
	 $da  = $bdd->query($sql); 
	$datas=$da->fetch(PDO::FETCH_OBJ);
	//var_dump($datas);
$stationsCount=  $datas->count; 
		 
            
 
		
		return $stationsCount; // Accès au résultat
}



	
	function getCountLocalite( $populationStart = "", $populationEnd = "" , $departement = "",$Annee="",$finance="", $circonscription="", $pv="", $programme="",$localite="",$etat="",$cloture="",$circonscription_foret="") {
		//__Compte le nombre de localite POUR LA PARTIE BASE DE DONNEES
 
		       

$bdd = parent::getBdd();

$taableS="DROP  table IF EXISTS table_localite   ";
	$ts = $bdd->prepare($taableS); 
  $ts->execute();
  // creation de la nouvelle table table_Pourcentage

 $taable  =" CREATE  table 	table_localite as 

SELECT (CAST(SUM(realisation_financiere.paiement) AS FLOAT) / 
        CAST(SUM(action.montant) AS FLOAT)) * 100 
        	AS tauxPaiemant, (select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement='FNDR' AND cloture is null  GROUP BY action.Code_PPDRI ) as t,
        	(select count(*) from action WHERE action.Code_PPDRI= ppdri.code_du_ppdri and source_financement  like'FNDR'  GROUP BY action.Code_PPDRI ) as f,
        	Code_du_PPDRI, localite 
FROM    action
       JOIN realisation_financiere 
             ON        action.Code_Actions  =realisation_financiere.Code   
                 
             JOIN ppdri 
             ON       action.Code_PPDRI  = ppdri.Code_du_PPDRI
             
              JOIN markers_villes 
             ON        ppdri.ville  =markers_villes.ville_id  

             JOIN markers_departements 
             ON        markers_departements.id_departement=markers_villes.ville_departement


JOIN ppdridate 
             ON        ppdridate.codeppdri=ppdri.Code_du_PPDRI

        where localite is not null  
 
      
";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		if (!empty($departement)){
			$taable .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$taable .=  " and ppdri.annee = " .$Annee;
		}
		if (isset($_POST['finance'])){
			$natureFinance=$_POST['finance'];
			 
		$taable .=  " and action.source_financement in ('" . implode("','", $natureFinance) . "')";  
 }
		if (isset($_POST['programme'])){
					$programme=$_POST['programme'];
					 
				$taable .=  " and ppdri.type_de_programme in ('" . implode("','", $programme) . "')";  
		 }

		 if (!empty($localite)){
			$taable .=  " and markers_villes.ville_id = '".$localite."'";
		} 

if (!empty($circonscription_foret)){
	$circonscription_foret=$_POST['circonscription_foret'];
		 	 
 $taable .=  " and markers_departements.circonscription_foret in ('" . implode("','", $circonscription_foret) . "')";   
		 	}

 if (!empty($circonscription)){
		 	if($circonscription !=="admin"){
$taable .=  " and circonscription = '".$circonscription."'";
		 	}
			
		}
if ( isset($_POST['etat'])){
			$etat = $_POST['etat'];
		}
		if ( isset($_POST['etat']) and $_POST['etat']=="validee" ){
		 
	  
			$taable .=  "  and observation <>'annulee'"  ;
		}
		
		

		  if ( isset($_POST['etat']) and $_POST['etat'] =="annulee" ){
   
$taable .=  "  and observation ='annulee'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumeAnnulée" ){
   
$taable .=  "  and observation ='volumeAnnulée'"  ;		}

if ( isset($_POST['etat']) and $_POST['etat'] =="volumesansrar" ){
   
$taable .=  "  and observation =''"  ;		}
if ( isset($_POST['cloture']) and $_POST['cloture'] =="ok" ){
   
$taable .=  "  and cloture is not null"  ;		}

if ( isset($_POST['cloture']) and $_POST['cloture'] ==" " ){
   
$taable .=  "  and cloture is null"  ;		}
	 $taable.=" GROUP  BY Code_du_PPDRI   ";
 		if ( !empty($populationStart ) ){

				$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;

			
		}else {
		 
 			$taable .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant )  >= 0"  ;
		}
		 
		if (!empty($populationEnd) ){
			$taable .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) <= ".$populationEnd;	 
		} 

$taable.="   order by localite";


		$dat   = $bdd->query($taable); 
$sql="select  distinct localite   from table_localite";



	  
if(isset($pv)&& $pv==="1"){
	 	$pv=$_POST['pv'];
	 	$sql .= " where t is null and f is not null ";
	 }elseif (isset($pv)&& $pv ==="2") {
	 	$pv=$_POST['pv'];
	 $sql .= " where t is not null and tauxpaiemant<>0 ";
	 } elseif (isset($pv)&& $pv ==="3") {
	 	$pv=$_POST['pv'];
	 $sql .= " where tauxpaiemant=0  ";
	 }elseif (isset($pv)&& $pv ==="4") {
	 	$pv=$_POST['pv'];
	 $sql .= " where f is  null and tauxpaiemant<>0  ";
	 } elseif (!isset($pv) ) {
	 $sql .= " where Code_du_PPDRI is not null ";
	 }



	 $da  = $bdd->prepare($sql); 
	 $da->execute();

   
 $projetCount=$da->rowCount();
 $da->closeCursor();
		//var_dump($projetCount);
		return $projetCount; // Accès au résultat
}


 function getCountLocaliteMaps( $populationStart = "", $populationEnd = "" , $departement = "",$Annee="") {
		//__Compte le nombre de localite POUR LA PARTIE Maps
 $bdd = parent::getBdd();
		 
$sql = "SELECT  
  ville_id,localite,ville_departement , Annee
 FROM ppdri,action,realisation_physique,realisation_financiere,markers_villes,markers_departements  

  WHERE ppdri.Code_du_PPDRI  = action.Code_PPDRI and
		 action.Code_Actions =realisation_physique.Code  and
		 action.Code_Actions  =realisation_financiere.Code and
		 markers_villes.ville_id = ppdri.ville and
		  markers_departements.id_departement = markers_villes.ville_departement 
";
					 //$sql .=parent::WHEREAND(' Source_Financement= "FNDR" ');
					//$sql .=parent::WHEREOR('  Source_Financement= "FSAEPEA" ');
					//$sql .=parent::WHEREOR(' Source_Financement= "PSD-FORETS"');

		if (!empty($departement)){
			$sql .=  " and markers_villes.ville_departement = " .$departement;
		} 
		if (!empty($Annee)){
			$sql .=  " and ppdri.annee = " .$Annee;
		}
	$sql .=	" group by  ville_id,localite,ville_departement , Annee ";
 		if (isset($populationStart)){
			$sql .=  " HAVING SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) >= " .$populationStart;
		}
		
		if (isset($populationEnd)){
			$sql .= " and SUM(realisation_financiere.paiement)*100/SUM(action.Montant ) <= ".$populationEnd;	 
		} 
	 $datas = $bdd->query($sql); 


		 
             	$count=  $datas->rowCount(); 
 
		
		return $count; // Accès au résultat
}

function login(){
$bdd = parent::getBdd();

if(!isset ($_POST['name']) AND !isset ($_POST['pwd'])){

$name=null;
$pwd=null;
}else{
$name=$_POST['name'];
$pwd=$_POST['pwd'];
	
}


 
  $sql="select * from users where name='$name' and pwd='$pwd' ";
	$result = $bdd->prepare($sql);
  $result->execute();
 
  return $result;


}


}

?>
<script>


	
	</script>
	
