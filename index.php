


<!DOCTYPE html> 
<html lang="fr"> 
 <div>
  <head>
    <meta charset="utf-8">
    <title>Administration</title>
     <style type="text/css">
    
.form-style-3{
     position:absolute;
    top: 200px;
       width: 500px;
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    background-color: rgba(128,128,128,0.9);
    right: 300px;
    left: 300px;

}
.form-style-3 label{
    display:block;
    margin-bottom: 10px;
}
.form-style-3 label > span{
    float: left;
    width: 100px;
     font-weight: bold;
    font-size: 13px;
 }
.form-style-3 fieldset{
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    margin: 0px 0px 10px 0px;
    border: 1px solid  
    padding: 20px;
     
}
.form-style-3 fieldset legend{
     border-top: 1px solid  
    border-left: 1px solid  
    border-right: 1px solid  
    border-radius: 5px 5px 0px 0px;
    -webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
     padding: 0px 8px 3px 8px;
     
    font-weight: normal;
    font-size: 12px;
}
.form-style-3 textarea{
    width:250px;
    height:100px;
}
.form-style-3 input[type=text],
.form-style-3 input[type=date],
.form-style-3 input[type=datetime],
.form-style-3 input[type=number],
.form-style-3 input[type=search],
.form-style-3 input[type=time],
.form-style-3 input[type=url],
.form-style-3 input[type=email],
.form-style-3 select,
.form-style-3 textarea{
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border: 1px solid  ;
    outline: none;
     padding: 5px 8px 5px 8px;
     width:50%;
}
.form-style-3  input[type=submit],
.form-style-3  input[type=button]{
     border: 1px solid  ;
    padding: 5px 15px 5px 15px;
      
    border-radius: 3px;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;   
    font-weight: bold;
}
.required{
     font-weight:normal;
}
</style>
    
  </head>


 
<form class="form-style-3" action="index.php" method ="POST">
<fieldset><legend>Authentification</legend>
<label for="field1"><span>Circonscription  <span class="required"> </span></span><input type="text" class="input-field" name="name" value="" /></label>
<label for="field2"><span>Mot de passe <span class="required"> </span></span><input type="password" class="input-field" name="pwd"   /></label>
 
 <label for="field1"> <?php   echo    "Veuiller entrer votre nom d 'utilisateur et mot de passe "      ;?></label>

 
<label><span>&nbsp;</span><input type="submit" value="Submit" name="Entrer" placeholder="Entrer"/></label>

</form>
 
   
   
   
  