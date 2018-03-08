$t="select * from action where action.cloture is not null";
		$res=$bdd->prepare($t) ;
		$res->execute();
		$u= number_format($res->rowCount());
		 var_dump($u);

$m="select * from action  ";
		$n=$bdd->prepare($m) ;
		$n->execute();
		$v= number_format($n->rowCount());
 var_dump($v);

		 

		if(!empty($pv) ){
		if($u == $v ){
$sql .= " and action.cloture is not null";
		}elseif($u != $v){
$sql .=" action.Code_PPDRI is null";
		}
	}	 