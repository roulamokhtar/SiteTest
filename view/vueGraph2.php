<?php 
include_once("model/BDD.php");

include_once("model/REQUETE.php");
include_once("template/vueHeader.php");
include_once("template/vueNavbar.php");
  include_once("template/vueFooter.php"); 
  $circonscriptions = $bdd->circonscription();

  $result=$bdd->tableGraph();
    $result=$bdd->tableGraphCirconscription();
  ?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      // Load the Visualization API and the controls package.
      google.charts.load('current', {'packages':['corechart', 'controls']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawDashboard);
google.charts.setOnLoadCallback(drawDashboardCirconscription);


      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawDashboard() {

        // Create our data table.
        var data = google.visualization.arrayToDataTable([
          ['commune',  'réceptions','prévu'   ],

          <?php
            


               
                  $result=$bdd->tableGraph();
                     
              
              

          foreach (  $result as $row   )
        
          {
           
echo  "['".addslashes($row['commune']) ."',  ".$row['receptions'].", ".$row['nombreaction']." ], ";
          
          } 
           
          ?>
         
        ]);

        // Create a dashboard.
        var dashboard_commune = new google.visualization.Dashboard(
            document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'commune'
          }
        });


 
        // Create a pie chart, passing some options
        var pieChart = new google.visualization.ChartWrapper({
          'chartType': 'ColumnChart',
          'containerId': 'chart_div',
          'options': {
             'vAxis': {'viewWindow': {'min': 0}},
            'width': 1200,
            'height': 270,
            'pieSliceText': 'value',
            'legend': 'right'
          }
          
        });

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard_commune.bind(  donutRangeSlider, pieChart );

        // Draw the dashboard.
        dashboard_commune.draw(data);
      }


       function drawDashboardCirconscription() {

        // Create our data table.
        var dataCirconscription = google.visualization.arrayToDataTable([
          ['circonscription',  'réceptions', 'prévu'],

          <?php
            


               
                  $result=$bdd->tableGraphCirconscription();
                     
              
              

          foreach (  $result as $row   )
        
          {
           
              echo  "['".addslashes($row['circonscription']) ."',  ".$row['receptions'].", ".$row['nombreaction']." ],";
          
          } 
           
          ?>
         
        ]);

        // Create a dashboard.
       
      }
    </script>
  </head>

  <body>

  <div align="center">

 <table      >
  
  <thead  >
 <tr  >
     <th>Circonscrition </th> 
    <th>Nombre d'action prévu</th>
    <th>Nombre d'action réceptionés</th>
    <th>Nombre d'action restantes</th>
    <th>Taux de réception définitive</th>

</tr>
</thead  > </table>
  
<table   >
 <tbody > 
<?php
 
foreach ( $result as $actions) {
   ?>
<tr  >
     <td > <?php echo  stripcslashes($actions['circonscription']);?></td>
    <td > <?php echo stripcslashes($actions['nombreaction'] ) ;?></td>
 
    <td > <?php echo stripcslashes($actions['receptions']) ;?></td>
 
    <td > <?php echo stripcslashes($actions['nbrrestant'])  ;?></td>
    <td > <?php echo stripcslashes($actions['tauxreception']);?></td>
      
    
    
</tr>
<?php
}
?>
 </tbody> 
   
</table>

      <h5 > vous avez <?php 
                  $resultgeneral =$bdd->ReceptionDefinitiveGenerale($circonscription);
 echo '<font size="4" color="red"> '. ($resultgeneral['tauxreception']).' </font>';
                  

 
  ?>  % de récéption définitif des travaux <h5 >
  

 
  <?php 
 
  /*
  if(isset ($users)){
  
 
foreach ( $result as $actions) {
var_dump($actions['tauxreception']);

}}
  

 */
  ?>

    </div>
    <!--Div that will hold the dashboard-->
    <div id="dashboard_div">
      <!--Divs that will hold each control and chart--> 
      <br/> 
      <div id="filter_div" align="center"></div>
       <div id="chart_div"></div>
    </div>


      
 
  </body>
</html>