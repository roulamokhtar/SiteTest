<?php
/*
 * Classe BDD pour se connecter à la BDD
 * permet l'accès à la BDD à partir des fonctions des classes enfants
 */


class BDD {
	var $localhost = "", $user = "postgres", $password = "foret", $dbname='AA';
		
//__Effectue la connexion à la BDD
//__Instancie et renvoie l'objet PDO associé
    function getBdd() {
    	$bdd = new PDO("pgsql:host=ec2-50-17-206-214.compute-1.amazonaws.com;dbname=postgresql-rigid-43283", "vpxvhvftohqcoq", "57606f9441058e43b836e87aa125de6a843803c3e671bf9e254654723119abac");
   $bdd->exec("SET NAMES utf8");
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		
        return $bdd;
    }

//__Effectue un SELECT sur la BDD
	function SELECT( $select ) {
		return $sql = "SELECT ".$select;
	}
	function DISTINCT( $select ) {
		return $sql = "  DISTINCT ".$select;
	}
	function DISTINCTLOC( $select ) {
		return $sql = " SELECT DISTINCT ".$select;
	}
	function CREATE( $select ) {
		return $sql = "CREATE ".$select;
	}

//__Effectue un FROM d'une (ou plusieurs) table(s)
	function FROM( $from ) {
		return $sql = " FROM ".$from;
	}
	
//__Effectue un WHERE
	function WHERE( $where ) {
		return $sql = " WHERE ".$where;
	}
	
//__Effectue un AND
	function WHEREAND( $and ) {
		return $sql = " AND ".$and;
	}
	function WHEREOR( $and ) {
		return $sql = " OR ".$and;
	}
	
	function HAVING( $HAVING ) {
		return $sql = " HAVING ".$HAVING;
	}
	
//__Effectue un GROUP BY
	function GROUPBY( $groupby ) {
		return $sql = " GROUP BY ".$groupby;
	}
	 
//__Effectue un ORDER BY selon une (ou plusieurs) colonne(s)
	function ORDERBY( $order, $clause = "asc" ) {
		$sql = " ORDER BY ".$order;
		
		if (!empty($clause)){
			$sql .= " ".$clause;
		}
		
		return $sql;
	}
	function ORDERBYDESC( $order, $clause = "desc" ) {
		$sql = " ORDER BY ".$order;
		
		if (!empty($clause)){
			$sql .= " ".$clause;
		}
		
		return $sql;
	}
	
	
//__Effectue un LIMIT d'une (ou plusieurs) table(s)
	function LIMIT( $limit ) {
		if (empty($limit)){
			$sql = " LIMIT 20";
		} else {
			$sql = " LIMIT ".$limit;
		}
		
		return $sql;
	}
	
//__Effectue un INSERT INTO sur la BDD
	function INSERTINTO( $insert ) {
		return $sql = "INSERT INTO ".$insert;
	}
	
//__Effectue un VALUES sur la BDD
	function VALUES( $values ) {
		return $sql = " VALUES (".$values.")";
	}
	
}
$BDD = new BDD();










