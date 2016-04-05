<?

class DataBase{
	
	var $name;
	var $vetTables;
	var $nameF;
	
	function DataBase($name,$vetTables='',$nameF=''){
		$this->name 	= $name;
		$this->nameF 	= $nameF;
		$this->vetTables = $vetTables;
		//no firebird
		//SELECT RDB$RELATION_NAME FROM RDB$RELATIONS;
		/*
		SELECT FIELD.RDB$FIELD_NAME, FIELDSD.RDB$FIELD_LENGTH, FIELDSD.RDB$FIELD_TYPE
		FROM 
		RDB$RELATION_FIELDS FIELD
		INNER JOIN RDB$FIELDS FIELDSD
		ON FIELDSD.RDB$FIELD_NAME = FIELD.RDB$FIELD_SOURCE
		WHERE RDB$RELATION_NAME = 'ALUNO'
		*/
	}

	function getName(){
		return $this->name;
	}
	
	function setName($name){
		$this->name = $name;
	}
	
	function getNameF(){
		return $this->nameF;
	}
	
	function setNameF($nameF){
		$this->nameF = $nameF;
	}
	
	function getVetTables(){
		return $this->vetTables;
	}
	
	function setVetTables($vetTables){
		$this->vetTables = $vetTables;
	}
}
?>