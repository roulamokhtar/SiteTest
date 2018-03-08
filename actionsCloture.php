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



$titre = "actions";
$page = "actions";//__variable pour la classe "active" du menu-header
$map=new Map();
$bdd = new REQ();
  // $s=$map->getVillesTaux();
if($_SESSION['name'] !=="ADMIN"){

      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }

 $nomC=$map->getNomDepartements($circonscription);
$nomCommune=$nomC->nom_departement;
$localites=$map->getLocalite($circonscription);
 $composantes=$map->getTheme();

  // var_dump($composantes[1]);
  
		$departements = $map->getDepartements( $circonscription); //_On affiche les départements dans une liste déroulante
		//var_dump($departements);
		$Annees=$map->getAnnee();
		$Nomactions=$map->getAction();
		//Nom de l'action qui doit etre afficher dans de le resultat $Nomact
		if(isset($_POST['nomactions'])){
		$Nomact =$map-> getNomAction();
}else{
	$Nomact="";
}
 	 
       


		if(!empty($_POST)){	
			extract($_POST);
			
			if(!empty($departement )) {
				$departement = $_POST['departement'];
				
			} else {
				$departement = "";
				
			}

			if(!empty($circonscription )){

      $circonscription= $_SESSION['name'];
    }else{
      $circonscription="";
    }

			if(!empty($annee )) {
				$annee = $_POST['annee'];

			} else {
				$annee = "";
				
			}
			if(!empty($localite )) {
				$localite = $_POST['localite'];

				
			} else {
				$localite = "";
				
			}

			if(!empty($composante )) {
				$composante = $_POST['composante'];
				
			} else {
				$composante = "";
				
			}
 
if(!empty($nomactions )) {
				$nomactions = $_POST['nomactions'];

				
			} else {
				$nomactions = "";
 			}

 			if(!empty($cloture )) {
				$cloture = $_POST['cloture'];

				
			} else {
				$cloture = "";
 			}
 			
 if(!empty($etat )) {
				$etat = $_POST['etat'];

				
			} else {
				$etat = "";
 			}
 
 

			if(!empty($_POST["finance"])) 
			{
				 
				foreach($_POST["finance"] as $finance) {
					 $finance=$_POST["finance"] ;
				
			}}else{

				$finance = "";
				
			}
			
	   
if(!empty($physique )) {
				$physique = $_POST['physique'];
				if($physique==="00"){

 $etatAction= "Action non entammée";
				}elseif($physique==50){
 $etatAction="inférieur ou égal  à 50 %";
				}elseif($physique==75){
 $etatAction= "inférieur ou égal  à 75 %";
				}elseif($physique==99){
 $etatAction= "inférieur ou égal  à 99 %";

				}elseif($physique==100){
 $etatAction= "Action Términée";

				}

			} else {
				$physique = "0";
				
			}
			

			
			if(!empty($habitants)){
			
			$habitants = $_POST['habitants'];
			
			switch ($habitants) {

					case "egal0":
         			 //$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
          			 $CODE= $bdd->realisationaction( 0, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription ,  $localite,$composante); 
$nombreactiontrouve= $bdd->realisationactionTROUVE(0, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(0, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
           			  
          			break;
				
					case "moins10":
					//$stations = $map->getVillesTaux( 0, 10, $departement,$Annee);
					 $CODE= $bdd->realisationaction( 10, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante); 
$nombreactiontrouve= $bdd->realisationactionTROUVE( 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 10, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(10, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
           			
					break;
				case "moins25":
					//$stations = $map->getVillesTaux(10, 25, $departement,$Annee);
					 $CODE= $bdd->realisationaction( 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
$nombreactiontrouve= $bdd->realisationactionTROUVE( 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 25, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(25, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
	    			 
					break;
				case "moins50":
				//	$stations = $map->getVillesTaux(25, 50, $departement,$Annee);
					 $CODE= $bdd->realisationaction( 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE( 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 50, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);

 $PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(50, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
	    		 
					break;
				case "moins75":
					//$stations = $map->getVillesTaux(50, 75, $departement,$Annee);
 				    $CODE= $bdd->realisationaction( 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE( 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);

	$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 75, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
       			 
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(75, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat, $circonscription,  $localite,$composante);	       			  
					break;
				case "inferieur100":
					//$stations = $map->getVillesTaux(75, 99, $departement,$Annee);
 				    $CODE= $bdd->realisationaction( 99.999, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
					$nombreactiontrouve= $bdd->realisationactionTROUVE( 99.999, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( 99.999, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 99.999, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);

$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 99.999, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(99.999, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);
					  
	       			 
					break;
				case "100":
					//$stations = $map->getVillesTaux(99, null, $departement,$Annee);
 				    $CODE= $bdd->realisationaction( 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
					 $nombreactiontrouve= $bdd->realisationactionTROUVE( 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
 $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( 100, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);

$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(100, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);	    			  
					break;	
			}
			}else {
				 	$habitants="";
					//$stations = $map->getVillesTaux(NULL,NULL,$departement,$Annee);
 				    $CODE= $bdd->realisationaction(NULL, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante); 
					$nombreactiontrouve= $bdd->realisationactionTROUVE(NULL, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE( null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
$montantprevutrouve= $bdd->MONTANTpervuactionTROUVE( null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);

$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE( null, $departement,$annee,$finance,$physique,$nomactions,$cloture,$etat,$circonscription,  $localite,$composante);
	    			   
$PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(null, $departement,$annee,$finance,$physique,$nomactions ,$cloture,$etat,$circonscription,  $localite,$composante);	    			 

				  }

				  //////////////////
		} else {
			$nbVille = 284;
			$nbLocalite = 217;
			//$stations = $map->getVillesTaux();
			  $CODE= $bdd->realisationaction(null, null,null,null,null,null ,null,null,$circonscription,null,null);
			   $nombreactiontrouve= $bdd->realisationactionTROUVE(null, null,null,null,null,null ,null,null,$circonscription,null,null);
			   $montantactiontrouve= $bdd->MONTANTrealisationactionTROUVE(null, null,null,null,null,null ,null,null,$circonscription,null,null);
			   $montantprevutrouve= $bdd->MONTANTpervuactionTROUVE(null, null,null,null,null,null ,null,null,$circonscription,null,null);
$PhysiquerealisationactionTROUVE= $bdd->PhysiquerealisationactionTROUVE(null, null,null,null,null,null ,null,null,$circonscription,null,null);
 $PhysiqueprevuactionTROUVE =$bdd-> PhysiqueprevuactionTROUVE(null, null,null,null,null,null ,null,null,$circonscription,null,null);	    			 
      		 
		}

	 // var_dump($Annee);
		
		 
//$nbreaction=$CODE->rowCount();
		
 

  include_once("view/vueActions.php");

     
?>
 
<script> 
$(document).ready(function()
		 {
		 	 
 
$("#anneee").on("change",function()
{
  
	  annee = $("#anneee").val();
	   
	     

	    
	   
  alert("vous allez envoyer une requete ajax ...............");
     
   

 $.ajax(
 {
 	url:'actions.php',
 	type:'POST',
 	data:  $(this).serialize() ,

 	beforSend:function(hxr){
console.log('beforSend: Requete en cours.............');
// $("#resultatAjax").html(' Working in ................');
 
 	},
 	success:function(data,status, xhr){
console.log('SUUCCESS DATA ='+data +' -- status = '+ status +'-- xhr = '+ xhr );
console.log( data );
 		 

$("#resultatAjax").html(data);

 	},
 	error:function(xhr,status, error){

console.log("ERROR:Erreur execution requete ajax");
console.log("jqXhr ="+ xhr

+"-- textStatut="+status
+"-- errorThrown="+error);
 	},
 	complete : function(xhr, status){
console.log('COMPLETE hxr='+ xhr +'-- status = '+ status );

 	},
 	statusCode: {
404 :function(){

	console.log("STATUSCODE: 404 : Page not found !!!!!!!!!!!!");
}
 	} 

 });

	});

	});


function downloadCSV(csv,filename){
	var csvFile;

    var downloadLink;
 
    // CSV file
    csvFile = new Blob([csv], {type: 'text/csv;charset = utf-8;\uFEFF" + downloadLink'} );

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
 	 

function exportTableToCSV(filename){
 var csv = [];
 
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row =[] , cols = rows[i].querySelectorAll("td, th");
     
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(";"));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}


// Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();
    
    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });    
}).resize(); // Trigger resize handler


</script>





