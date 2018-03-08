<?php 
include_once("model/BDD.php");

include_once("model/REQUETE.php");
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php");
  include_once("template/vueFooter.php"); 
//$a=$result->fetchAll(PDO::FETCH_OBJ);
  //var_dump($a);
  
 
$circonscriptions = $bdd->circonscription();

	$result=$bdd->tableGraph();
	//var_dump($CODE);	 
		

?>
<!DOCTYPE html>

 
    

	<head>
		
		<title>Résultat graphyque</title>
		 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		 <script type="text/javascript">
		 google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart()
		{
			var data = google.visualization.arrayToDataTable([
					['communes','réception','Action  prévue'],
					<?php
					  
					  	$result=$bdd->tableGraph();
					  	
				 
					
				 
					

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

		
 

		 
		 $(document).ready(function(){

$("#aja").submit(function(){

	id = $(this).find("select[name=circonscriptions]").val();
	 
});


		  
		var x =  $(location).attr('search') ;	 
 

if(x==""){
$('#piechart').css({
	"width":"75%",
	"height":"50%" ,
	"align-center":"left"
	 
});



  
}else{
	$('#piechart').css({
	"width":"50%",
	"height":"40%",
	"align-center":"center" 

});
	 
}

 

		 });
	


</script>

	</head>

	<body>
	<div id ="container" >
		<form method="post"  id="aja"   class="  formMaps"   > 

<h5>Choisir la Circonscription :</h5>
					<select name="circonscriptionchoisie" id="ajax"  size="1" >
					  	 <option value="">  Choisir la circonscription </option>
						 <option value="taher">  taher </option>
						  <option value="el ancer">  el ancer </option>
						   <option value="el milia">  el milia </option>
						    <option value="texenna">  texenna </option>
						      <option value="el aouana">  el aouana </option>
						 
				</select><br/><br/>


	<button type="submit" class="btn btn-default" id="search" name="search">Recherche</button>

		</form>

</div>
	<div id="piechart"> </div> 
 	 
 
 
</body>
