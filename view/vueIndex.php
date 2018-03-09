
<?php include_once("template/vueHeader.php"); ?>
<?php include_once("template/vueNavbar.php"); ?>
<head> 
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="jquery.fancybox.min.js"></script>
    <link   href="jquery.fancybox.min.css"  rel="stylesheet"  >  
    <style type="text/css">
    main{

width: 60%;
margin: 0px  auto;

    }
      .thumnails{
        width: 30%;
      float:left;
      margin:1px;
      background: #fff;
      padding: 2px;
      box-sizing: border-box;

    }
    .thumnails img{
    width: 100%;
    height: auto;
 
    }

    </style>
    </head>
  <body>


   

        <div>
          <h4   style="text-align: center"  >PROJETS - SIG- SUIVI EVALUATION DE LA WILAYA DE JIJEL 2010-2014</h4>  </br>
           <div style=" position: fixed; top: 90px; right:  : 250px;width: 50%;
    border: 3px    height: 180px;">
           <p style="text-align: center ;  line-height: 250%; vertical-align: middle; "> <span style="color:blue;font-weight:bold">Partie Cartographie dynamique des projets </span> avec des fonctionnalités diverses de recherches et de visualisation des projets et les actions sur la carte google maps. Chaque localité  peut contenir un ou plusieurs projets PPDRI  du secteur des forêts de la Wilaya de JIJEL. 
           L'application est faite en php 5 en utilisant la nouvelle classe PDO avec une  architecture MVC.  
            La base de données postgresql comprend 22 tables avec 284 projets du programme 2010- 2014 répartis dans 213 localités .
          </p>
          </div>
          <div style=" position: fixed; top: 90px; height : 180px; right: 10px;width: 750px;
    border: 3px  ;  ">
    <main>
          <?php
           $carto = glob('images/carto/{*.PNG}', GLOB_BRACE);
           
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
 
 <div style=" position: fixed; top: 280px; right:  : 250px;width: 50%;
    border: 3px  ;  height: 180px; ">
          <p style="text-align: center ; line-height: 250%;  vertical-align: middle;  "><span style="color:blue;font-weight:bold">Partie gestion dynamique des projets </span>avec des fonctionnalités de recherches , actualisation des données et suivi évaluation des projets.Aider le gestionnaire forestier à  faire ressortir un cadre logique dynamique pour chaque projet 2010-2014 (Activités, Résultat attendu, Objectif spécifique et Indicateurs Objectivement vérifiables(IOV).Ainsi  d'actualiser les fiches IOV   
          </p>
          </div>
          <div style=" position: fixed; top: 280px; height : 180px; right: 10px;width: 750px;
    border: 3px  ;  ">
    <main>
          <?php
           $projet = glob('images/projet/{*.PNG}', GLOB_BRACE);
           
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
            <div style=" position: fixed; top: 480px; right:  : 250px;width: 50%;
    border: 3px  ;  height: 180px; ">
          <p style="text-align: center ; line-height: 200%;   padding-bottom: 20px; "><span style="color:blue;font-weight:bold">Partie gestion des actions et les réceptions définitives</span> des actions  , Histogramme de clotures par communes et Circonscriptions.... 
            - Permettre au gestionnaire forestier à  faire des recherches instantanées sur la situation des travaux, cette recherche peut etre faite suivant plusieurs critères à savoir:
            
          - Par: Année, Programme , volume physique, paiement, réception définitive , ,Circonscription, commune,source de financement, type d'action..............   
          </p>
          </div>
          <div style=" position: fixed; top: 480px; height : 180px; right: 10px;width: 750px;
    border: 3px  ;  ">
    <main>
          <?php
           $actions = glob('images/action/{*.PNG}', GLOB_BRACE);
           
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