
<?php include_once("template/vueHeader.php"); ?>
<?php include_once("template/vueNavbar.php"); ?>
<head> 
   
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="jquery.fancybox.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link   href="jquery.fancybox.min.css"  rel="stylesheet"  > 

    <style type="text/css">
    p{
      line-height: 30px;
    }
    main{

width: 100%;
margin: 0px  auto;

    }
      .thumnails{
        width: 33%;
      float:left;
      margin:1px;
      background: #fff;
      padding: 2px;
      box-sizing: border-box;


    }
    @media screen and (max-width: 1279px){
      .thumnails{
width: 100%;
      }
     
  }
    .thumnails img{
    width: 80%;
    height: 80px;
 
    }
    @media screen and (max-width: 1279px){
      .thumnails img{
width: 80%;
    height: 80px;
      }
     
  }
    #Cartographie{
position: relative;  width: 90%;
    border: 3px     
background-color: red;
border-color: green;
text-align: center;


    }
    @media screen and (max-width: 1279px){
    #Cartographie{
position: relative;
       width: 100%;
        top: 00px; right:  : 00px;
    border: 3px    height: none;
    background-color: white;
    text-align: center;
   }
}
#Cartographie-image{
 position: relative;  width: 100%;
    border: 3px  ;

    }
@media screen and (max-width: 1279px){
    #Cartographie-image{
position: relative;
       width: 100%;
       top: none; height : none; right: none;
   }
}
    </style>
    </head>
  <body>
 
          <h4    style="text-align: center  "   >PROJETS - SIG- SUIVI EVALUATION DE LA WILAYA DE JIJEL 2010-2014</h4>  </br>
<div id="Cartographie"  >
           <p> > <span style="color:blue;font-weight:bold">Partie Cartographie dynamique des projets </span> avec des fonctionnalités diverses de recherches et de visualisation des projets et les actions sur la carte google maps. Chaque localité  peut contenir un ou plusieurs projets PPDRI  du secteur des forêts de la Wilaya de JIJEL. 
           L'application est faite en php 5 en utilisant la nouvelle classe PDO avec une  architecture MVC.  
            La base de données postgresql comprend 22 tables avec 284 projets du programme 2010- 2014 répartis dans 213 localités .
          </p>
 </div>
          <div id ="Cartographie-image"  >
    <main>
          <?php
           $carto = glob('../ppdri/images/carto/{*.jpg ,*.PNG}', GLOB_BRACE);
           
          foreach ($carto as   $value) {

            ?>
            <div class="thumnails">

            <a href="<?php echo $value; ?>" data-fancybox="carto" data-caption="<?php echo $value;  ?>">
            <img src="<?php echo $value; ?>" alt="<?php echo $value;  ?>">
            </a>
            

            </div>
            <?php
          }
            

         ?>
    </main>
          </div>
 
 <div id="Cartographie">
          <p  ><span style="color:blue;font-weight:bold">Partie gestion dynamique des projets </span>avec des fonctionnalités de recherches , actualisation des données et suivi évaluation des projets.Aider le gestionnaire forestier à  faire ressortir un cadre logique dynamique pour chaque projet 2010-2014 (Activités, Résultat attendu, Objectif spécifique et Indicateurs Objectivement vérifiables(IOV).Ainsi  d'actualiser les fiches IOV   
          </p>
          </div>
          <div id ="Cartographie-image">
    <main>
          <?php
           $projet = glob('../ppdri/images/projet/{*.jpg ,*.PNG}', GLOB_BRACE);
           
          foreach ($projet as   $projets) {

            ?>
            <div class="thumnails">

            <a href="<?php echo $projets; ?>" data-fancybox="projet" data-caption="<?php echo $projets;  ?>">
            <img src="<?php echo $projets; ?>" alt="<?php echo $projets;  ?>">
            </a>
            

            </div>
            <?php
          }
            

         ?>
         </main>
          </div>
            <div  id="Cartographie">
          <p  ><span style="color:blue;font-weight:bold">Partie gestion des actions et les réceptions définitives</span> des actions  , Histogramme de clotures par communes et Circonscriptions.... 
            - Permettre au gestionnaire forestier à  faire des recherches instantanées sur la situation des travaux, cette recherche peut etre faite suivant plusieurs critères à savoir:
            
          - Par: Année, Programme , volume physique, paiement, réception définitive , ,Circonscription, commune,source de financement, type d'action..............   
          </p>
          </div>
          <div id ="Cartographie-image">
    <main>
          <?php
           $actions = glob('../ppdri/images/action/{*.jpg ,*.PNG}', GLOB_BRACE);
           
          foreach ($actions as   $actionss) {

            ?>
            <div class="thumnails">

            <a href="<?php echo $actionss; ?>" data-fancybox="action" data-caption="<?php echo $actionss;  ?>">
            <img src="<?php echo $actionss; ?>" alt="<?php echo $actionss;  ?>">
            </a>
            

            </div>
            <?php
          }
            

         ?>
         </main>
          </div>
 
  

	<?php include_once("template/vueFooter.php"); ?>