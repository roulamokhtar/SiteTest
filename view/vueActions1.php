<?php 
	include_once("model/BDD.php");
	include_once("model/Map.php");
	include_once("model/REQUETE.php");
	include_once("template/vueHeader.php");
	include_once("template/vueNavbar.php");
	include_once("template/vueFooter.php");
?>
<!DOCTYPE html>

<html lang="fr"> 
	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		 
	</head>
	
	 
		
	 <body >
 
 
			 
				 
				 <div id="formulaireAjax">
					 
						<h5 style="display: inline;">Choisir une Année :</h5>
						<SELECT  name="annee" size="1" id="ajax"  style="display: inline;">
							 <option  value="2010" >2010 </option>
							 <option  value="2011" >2011 </option>
							 <option  value="2012" >2012 </option>
							 <option  value="2013" >2013 </option>
							 <option  value="2014" >2014 </option>
						</SELECT >
						 
						 
				 
						</div>



						</br>
			<button type="submit" class="btn btn-default" id="recheche"   >Recherche</button> 
				 
<button onclick="exportTableToCSV('members.csv')"  > Exporter les resultats dans Excel	</button>
	 
	<a href="graph.php<?php if($_SESSION['name'] !="ADMIN"){echo '?circonscription='.$circonscription ;}else{echo "";} ?>"> Voir l'histogramme   </a>		
	  
 


 

	

<?php
	 
echo '<table  class ="action  table-bordered"  id="resultatAjax">';
echo '<thead>';
echo '<tr>';
 

echo ' <th>ANNEE </th>';
echo '<th>circonsncription </th>';
echo '<th>COMMUNE </th> ';
echo '<th>LOCALITE </th> ';
echo '<th>ACTION</th> ';
echo '<th>SOURCE FINANCEMENT</th> ';
echo ' <th>UNITE </th>';
echo ' <th>QUANTITE PREVUE</th>';
echo '<th>REALISATION</th>';
echo ' <th>TAUX PHYSIQUE</th>';
echo '<th>MONTANT PREVU</th> ';
echo ' <th>PAIEMENT</th>';
echo ' <th>TAUX PAIEMENT</th>';
echo ' <th>CLOTURE</th>';
echo ' <th>OBS </th>';
 
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ( $CODE as $actions){

	echo '<tr>';
		echo'<td>'.$actions->annee. '</td>';
			echo'<td>'.$actions->circonscription_foret. '</td>';
				echo'<td>'.stripcslashes($actions->commune) . '</td>';
					echo'<td>'.$actions->localite. '</td>';
						echo'<td>'.$actions->nomactions. '</td>';
							echo'<td>'.$actions->source_financement. '</td>';
								echo'<td>'.$actions->unit. '</td>';
									echo'<td>'.number_format($actions->quantite,2,',',' '). '</td>';

									echo'<td>'.number_format($actions->realisation_physique, 2, ',', ' '). '</td>';
									echo'<td>'.number_format($actions->tauxphysique,2, ',', ' ')  . '</td>';
									echo'<td>'.number_format($actions->montant,2,',',' '). '</td>';
									echo'<td>'.number_format($actions->paiement,2,',',' '). '</td>';
									echo'<td>'.number_format($actions->tauxpaiemant, 2, ',',' ') . '</td>';
									echo'<td>'.$actions->cloture. '</td>';
									echo'<td>'.$actions->observation. '</td>';


									 

	echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>
 
 
 </body>
 <script type="text/javascript">
 	



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
 </script>