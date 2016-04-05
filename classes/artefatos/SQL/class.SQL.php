<?
include_once dirname(__FILE__).'/class.SQLMySQL.php';
include_once dirname(__FILE__).'/class.SQLDB2.php';

class SQL{

	function SQL(){
	}
	
	function insert($table, $vetFields){
		$texto .= 	" INSERT INTO ".$table->getName()."\n".
      				"                  VALUES(";
      	for($j=0;$j<count($vetFields);$j++)
			$texto .= "'$".$vetFields[$j]->getNameF()."'".(($j != (count($vetFields)-1))?", ":")");
		return $texto;
	}
	
	function update($table, $vetPK,$vetNK){
		$texto .= 	" UPDATE ".$table->getName()."\n".
    				"               SET\n";
   		while($field = array_shift($vetNK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".
										((0 != count($vetNK))?",\n":"\n               WHERE\n");
		while($field = array_shift($vetPK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".
										((0 != count($vetPK))?" AND \n":"");
		return $texto;
	}
	
	function delete($table, $vetPK){
		$texto .= 	" DELETE FROM ".$table->getName()."\n".
	    			"             WHERE\n";
		while($field = array_shift($vetPK))
			$texto .= "               ".$field->getName()." = '$".$field->getNameF()."'".((0 != count($vetPK))?" AND \n":"");
		return $texto;
	}
	
	function selectPK($table, $vetPK){
		$texto .= 	" SELECT * FROM ".$table->getName()."\n".
    				"               WHERE\n";
		for($j=0;$j<count($vetPK);$j++)
			$texto .= "                 ".$vetPK[$j]->getName()." = '$".$vetPK[$j]->getNameF()."'".(($j != (count($vetPK)-1))?" AND \n":"\n");
		$texto .= "                  ORDER BY\n                    ";
		while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"\";\n");	
		return $texto;
	}
	
	function selectAll($table,$vetPK=''){
		$texto .= " SELECT * FROM ".$table->getName()."\";\n";
		if($vetPK){
			$texto .= "    \$sql .= \" ORDER BY\n                    ";
			while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"\";\n");	
		}
		return $texto;
	}
	
}


?>