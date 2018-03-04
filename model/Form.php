<?php
/*
 * Modele de classe PHP : Form.php
 * Classe de gestion des données du formulaire de contact
 */

class Formulaire extends BDD {
	function verifDataMail($data){
		$data = strip_tags($data); // XSS

		$data = stripslashes($data); // quotes ' et "
		$data = addslashes($data);

		$data = str_replace("\'","'",$data);
		$data = str_replace('\"','"',$data);

		return $data;
	}
	
	function update($nom, $prenom, $email, $sujet, $message){
		$bdd = parent::getBdd();
		
		$sql = parent::INSERTINTO('markers_contact (nom, prenom, email, sujet, message)');
		$sql .= parent::VALUES(':nom, :prenom, :email, :sujet, :message');

		$stmt = $bdd->prepare($sql);

		$stmt->bindParam(':nom', $nom);
		$stmt->bindParam(':prenom', $prenom);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':sujet', $sujet);
		$stmt->bindParam(':message', $message);
		
		$stmt->execute();
		
	}
}
$Formulaire = new Formulaire();
