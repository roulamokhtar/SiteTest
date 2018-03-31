<?php
session_start();
if (!isset($_SESSION['pwd']) AND !isset($_SESSION['name']))

{
header('Location:index.php'   );
   // echo 'Bonjour ' . $_SESSION['name'];

} 

?>
<!DOCTYPE html> 
<html lang="fr"> 
 <div>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration</title>
     
  </head>

 <body>
   
 

 <?php

 
	$titre = "Indexs";
	$page = "indexs"; //__variable pour la classe "active" du menu-header
	
//__variables pour les balises méta
	$description = "Projets de proximité de developpement rural de la Wilaya de JIJEL";
    $title = "projets PPDRI JIJEL";
	$keyword = "mot-clé 1, mot-clé 2, mot-clé 3";
    $author = "r";

 
    	include_once("view/vueIndex.php");

    
     
   
  