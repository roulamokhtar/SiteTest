 <?php

if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
 

}?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ee">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                     
          <a class="navbar-brand" href="Bienvenue.php">Bienvenue au site</a>

        </div>
        <div class="collapse navbar-collapse" id="ee">
          <ul class="nav navbar-nav">
            <li <?php echo ($page == "maps") ? 'class="active"' : ''; ?> ><a href="maps.php">Cartographie  des projets </a></li>
            </ul>
            <ul class="nav navbar-nav">
            <li <?php echo ($page == "projets") ? 'class="active"' : ''; ?> ><a href="projets.php">Consultation des Projets </a></li>
            </ul>
            <ul class="nav navbar-nav">
          <li <?php echo ($page == "actions") ? 'class="active"' : ''; ?> ><a href="actions.php">Consultation des actions</a></li>
             </ul>
   
    

<ul class="nav navbar-nav"> 

<li <?php echo ($page == "maps" or $page == "projets" or $page == "actions"   ) ? 'class="active"' : ''; ?> > <a href="#"> <?php  echo "Circonscription".$_SESSION['name'] ;?></a></li>

 

         </ul>          
 
             <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Déconnexion</a></li>
            </ul>  
        </div>
        </div>
        <!--/.nav-collapse -->
      
    </div>