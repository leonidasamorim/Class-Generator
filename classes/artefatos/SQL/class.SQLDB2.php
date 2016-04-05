<?

class SQLDB2 extends SQL {

	function SQLDB2(){
	}
	
	function insert($table, $vetFields){
		$texto .= 	" INSERT INTO ".$table->getNameDB().".".$table->getName()."\n".
      				"                  VALUES(";
      	for($j=0;$j<count($vetFields);$j++){
      		$str = (($vetFields[$j]->getCategory() == "int") || ($vetFields[$j]->getCategory() == "float"))?"":"'";
			$texto .= "$str\$".$vetFields[$j]->getNameF()."$str".(($j != (count($vetFields)-1))?", ":")");
      	}
		return $texto;
	}
	
	function update($table, $vetPK, $vetNK){
		$texto .= 	" UPDATE ".$table->getNameDB().".".$table->getName()."\n".
    				"              SET\n";
   		while($field = array_shift($vetNK)){
   			$str = (($field->getCategory() == "int") || ($field->getCategory() == "float"))?"":"'";
			$texto .= "               ".$field->getName()." = $str\$".$field->getNameF()."$str".
										((0 != count($vetNK))?",\n":"\n              WHERE\n");
   		}
		while($field = array_shift($vetPK)){
			$str = (($field->getCategory() == "int") || ($field->getCategory() == "float"))?"":"'";
			$texto .= "               ".$field->getName()." = $str\$".$field->getNameF()."$str".
										((0 != count($vetPK))?" AND \n":"");
		}
		return $texto;
	}
	
	function delete($table, $vetPK){
		$texto .= 	" DELETE FROM ".$table->getNameDB().".".$table->getName()."\n".
	    			"              WHERE\n";
		while($field = array_shift($vetPK)){
			$str = (($field->getCategory() == "int") || ($field->getCategory() == "float"))?"":"'";
			$texto .= "               ".$field->getName()." = $str$".$field->getNameF()."$str".((0 != count($vetPK))?" AND \n":"");
		}
		return $texto;
	}
	
	function selectPK($table, $vetPK){
		$texto .= 	" SELECT * FROM ".$table->getNameDB().".".$table->getName()."\n".
    				"               WHERE\n";
		while($field = array_shift($vetPK)){
			$str = (($field->getCategory() == "int") || ($field->getCategory() == "float"))?"":"'";
			$texto .= "                 ".$field->getName()." = $str$".$field->getNameF()."$str".((0 != count($vetPK))?" AND \n":"");
		}
		return $texto;
	}
	
	function selectAll($table,$vetPK=''){
		$texto .= " SELECT * FROM ".$table->getNameDB().".".$table->getName();
		if($vetPK){
			$texto .= "\n      ORDER BY\n                    ";
			while($field = array_shift($vetPK))
				$texto .= $field->getName().((0 != count($vetPK))?", ":"");	
		}
		return $texto;
	}
	
	function limit(){
		return  " FETCH FIRST \".\$ini+\$num .\"";
	}
	
}


?>