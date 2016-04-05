<?

class SQLMySQL extends SQL{

	function SQLMySQL(){
	}
	
	function insert($table, $vetFields){
		$texto .= 	" INSERT INTO ".$table->getName()."\n".
      				"                  VALUES(";
      	for($j=0;$j<count($vetFields);$j++)
			$texto .= "'$".$vetFields[$j]->getNameF()."'".(($j != (count($vetFields)-1))?", ":")");
		return $texto;
	}
	
	function update($table, $vetPK, $vetNK){
		$texto .= 	" UPDATE ".$table->getName()."\n".
    				"              SET\n";
   		while($field = array_shift($vetNK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".
										((0 != count($vetNK))?",\n":"\n              WHERE\n");
		while($field = array_shift($vetPK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".
										((0 != count($vetPK))?" AND \n":"");
		return $texto;
	}
	
	function delete($table, $vetPK){
		$texto .= 	" DELETE FROM ".$table->getName()."\n".
	    			"              WHERE\n";
		while($field = array_shift($vetPK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetPK))?" AND \n":"");
		return $texto;
	}
	
	function selectPK($table, $vetPK){
		$texto .= 	" SELECT * FROM ".$table->getName()."\n".
    				"               WHERE\n";
		while($field = array_shift($vetPK))
			$texto .= "                 ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetPK))?" AND \n":"");
		return $texto;
	}
	
	function selectAll($table,$vetPK=''){
		$texto .= " SELECT * FROM ".$table->getName();
		if($vetPK){
			$texto .= "\n      ORDER BY\n                    ";
			while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"");	
		}
		return $texto;
	}
	
	function limit(){
		return  " LIMIT \$ini,\$num ";
	}
	
}


?>