<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          <li <?php echo ($page == "indexs") ? 'class="active"' : ''; ?> ><a href="Bienvenue.php">Bienvenue au site </a></li>
            <li <?php echo ($page == "maps") ? 'class="active"' : ''; ?> ><a href="maps.php">Cartographie dynamique des projets </a></li>
            <li <?php echo ($page == "projets") ? 'class="active"' : ''; ?> ><a href="projets.php">Consultation des Projets </a></li>
          <li <?php echo ($page == "actions") ? 'class="active"' : ''; ?> ><a href="actions.php">Consultation des actions</a></li>
            

           <a class="navbar-brand" href="index.php"> Déconnexion</a>
 <li   class="navbar-brand"  ><?php

if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
 

}elseif( isset($_SESSION['pwd']) AND  isset($_SESSION['name']) and $_SESSION['name']=="ADMIN"){

echo " <font size='2' color='red'  'font-weight:bold'  align-text='center' >Connecté:Conservation des forêts   </font> "; 
}elseif(isset($_SESSION['pwd']) AND  isset($_SESSION['name']) and $_SESSION['name']!=="ADMIN"){
echo '<font size="2" color="red"  "font-weight:bold"   > ' ."Connecté:Circonscription  :".$_SESSION['name']. '</font>'; 
}



  //echo '<font size="4" color="red"> '  ."Membre ". '</font>' 




   ; ?></li>

          </ul>   
        </div>
        </div>
        <!--/.nav-collapse -->
      
    </div>