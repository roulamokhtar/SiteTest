<?php 
include_once("model/BDD.php");

include_once("model/REQUETE.php");
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php");
  include_once("template/vueFooter.php"); 
//$a=$result->fetchAll(PDO::FETCH_OBJ);
  //var_dump($a);
	$connect= new PDO("pgsql:host=localhost;dbname=AA", "postgres", "foret");
    
 

 
$circonscriptions = $bdd->circonscription();
if(isset($_post['circonscriptionchoisie'])){
$data =$_POST['circonscriptionchoisie'];

$realisationTotalAjax="SELECT  distinct commune, count(cloture) as receptions , (select count(action.code_actions) as NombreAction  ),circonscription
	 FROM 
	  ppdri,action,realisation_financiere, ppdridate 
	    WHERE
	ppdri.Code_du_PPDRI  = action.Code_PPDRI and  ppdridate.codeppdri  = ppdri.Code_du_PPDRI and
	realisation_financiere.code=  action.code_actions AND action.source_financement ='FNDR' and observation   not like 'annulee'   and circonscription=? group by  commune,circonscription";

 $resultat= $bdd->prepare($realisationTotalAjax);
			$resultat->execute(array($data));
	$result=   json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
}


	 

 		 
 
	//var_dump($CODE);	 
		

?>
<!DOCTYPE html>

 
    

	<head>
		
		<title>Résultat graphyque</title>
 		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				


	</head>

	<body>
	<div id ="container" >
		<form method="post"  id="cir"   class="  formMaps"   > 

<h5>Choisir la Circonscription :</h5>
					<select name="circonscriptionchoisie" id="bb"  size="1" >
					  	 
						 <option value ="taher">  taher </option>
						  <option value ="el ancer">  el ancer </option>
						   <option value="el milia">  el milia </option>
						    <option value="texenna">  texenna </option>
						      <option value="el aouana">  el aouana </option>
						 
				</select><br/><br/>


	<button type="submit" class="btn btn-default" id="search" name="search">Recherche</button>

		</form>

</div>
	
  
  <div id="piechart"> </div> 
 
</body>
	<script src="jquery.js"></script>
<script type="text/javascript">


		 google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
					['communes','réception','prévue'],
					<?php
					  


							  if (isset( $_POST['search'])) {
					   			$result=$bdd->tableGraph();
					  				}
					  	
					  	
				 
					
				 
					

					foreach (  $result as $row   )
 				
					{
					 
							echo  "['".addslashes($row['commune']) ."', ".$row['receptions'].", ".$row['nombreaction']." ],";
					
					} 
					 
 					?>
				]);

			var options = {
				title:'Nombre d\'actions réceptionnées    <?php 

if(  $_SESSION['name']  != "ADMIN"){

	 echo  "par la circonscription de ". $circonscription   ; 
}else{

 echo  "par Commune "    ; 

}
				




				 ?> '  ,
				 

			};
			
				var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
			chart.draw(data, options);
		
			

		}

		 var x =  $(location).attr('search') ;
		 //alert(x)	 
 

if(x==""){
$('#piechart').css({
	"width":"75%",
	"height":"50%" ,
	"align-center":"left"
	 
});



  
}else{
	$('#piechart').css({
	"width":"60%",
	"height":"40%",
	"align-center":"center" 

});
	 
}

	




 



			

 $(document).ready(function()
		 {

$('#bb').on('change',function()
{
  
	  value = $(this).val();
alert(value);
 

	}



	);

  $ajax({

url:'ppdri/graph.php',
type:'post',
data: $(this).serialize(),
dataType:'json',

success:function(){
		drawChart(data);

  

},


 });


 

 
 });
  
</script>

 