


<!DOCTYPE html> 
<html lang="fr"> 
 <div>
  <head>
    <meta charset="utf-8">
    <title>Administration</title>
   
 
    
  </head>

<?php
/*
 * Contrôleur de notre page d'accueil
 * gère la dynamique de l'application. Elle fait le lien entre l'utilisateur et le reste de l'application
 */
	
	include_once("model/BDD.php");
	include_once("model/REQUETE.php");
	include_once("model/Map.php");
	 
    
$map=new Map();

  
if(!isset ($_POST['name']) AND !isset ($_POST['pwd'])){

$name=null;
$pwd=null;
}else{
$name=  htmlspecialchars(trim ($_POST['name'])) ;

$pwd=  htmlspecialchars(trim ($_POST['pwd'])) ; 

}

  
   $result = $map->login();
$z  = $result->fetch(PDO::FETCH_OBJ);
      //var_dump($z);
   
if(!$rows=$z){
  
  	
 ?>
 
<form  action="index.php" method ="POST" style="margin:auto">
<legend>Authentification</legend>
<label for="form-group"> Circonscription  <span class="required"> </span> </label> 
<input type="text" class="input-field" name="name" value="" /></label>
<label for="field2"><span>Mot de passe <span class="required"> </span></span><input type="password" class="input-field" name="pwd"   /></label>
 
 <label for="field1"> <?php   echo    "Veuiller entrer votre nom d 'utilisateur et mot de passe "      ;?></label>

 
<label><span>&nbsp;</span><input type="submit" value="Submit" name="Entrer" placeholder="Entrer"/></label>

</form>
 
  <?php  
  }else{
 
session_start();
    $_SESSION['pwd'] = $z->pwd;
    $_SESSION['name'] =  $name;
     
 
	$titre = "Index";
	$page = "index"; //__variable pour la classe "active" du menu-header
	
//__variables pour les balises méta
	$description = "Projets de proximité de developpement rural de la Wilaya de JIJEL";
    $title = "projets PPDRI JIJEL";
	$keyword = "mot-clé 1, mot-clé 2, mot-clé 3";
    $author = "r";

 
    	include_once("view/vueIndex.php");

    
    }
   
  