<?
include_once dirname(__FILE__).'/class.Util.php';

class Field{

	var $name;
	var $nameF;
	var $type;
	var $size;
	var $null;
	var $extra;
	var $default;
	var $PK;
	var $FK;
	var $nameTable;
	var $category;
	
	function Field($name,$type='',$size='',$null='',$extra='',$default='',$PK='',$FK='',$nameTable=''){
		$this->name  = $name;
		$this->nameF  = $name;
		$this->type = $type;
		$this->size = $size;
		$this->null = $null;
		$this->extra = $extra;
		$this->default = $default;
		$this->PK = $PK;
		$this->FK = $FK;
		$this->nameTable = $nameTable;
		//mapeamento
		switch ($type){
				case "varchar":	case "char":
					$category = "string";
					break;
				case "text": case "tinytext": case "mediumtext": case "longtext":
					$category = "long string";
					break;
				case "blob": case "tinyblob": case "mediumblob": case "longblob":
					$category = "file";
					break;
				case "float": case "double": case "decimal":
					$category = "float";
					break;
				case "int": case "tinyint": case "mediumint": case "bigint": case "smallint":
					$category = "int";
					break;
				case "date": case "datetime":
					$category = "date";
					break;
				case "time":
					$category = "time";
					break;
				default:
					$category = "string";
			}
		/* XML de configuração do mapeamento
		<rule>
			<type>name|type|extra|FK|PK</type>
			<value>varchar</value>
			<category>simpleString</category>
		</rule>
		*/
		$this->category = $category;
	}
	
	function getName(){
		return $this->name;
	}
	
	function getNameF(){
		return $this->nameF;
	}
	
	function getType(){
		return $this->type;
	}
	
	function getSize(){
		return $this->size;
	}
	
	function getNull(){
		return $this->null;
	}
	
	function getExtra(){
		return $this->extra;
	}
	
	function getDefault(){
		return $this->default;
	}
	
	function getPK(){
		return $this->PK;
	}
	
	function getFK(){
		return $this->FK;
	}
	
	function getNameTable(){
		return $this->nameTable;
	}
	
	function setName($name){
		$this->name = $name;
	}
	
	function setNameF($nameF){
		$this->nameF = $nameF;
	}
	
	function setType($type){
		$this->type = $type;
	}
	
	function setSize($size){
		$this->size = $size;
	}
	
	function setNull($null){
		$this->null = $null;
	}
	
	function setExtra($extra){
		$this->extra = $extra;
	}
	
	function setDefault($default){
		$this->default = $default;
	}
	
	function setPK($PK){
		$this->PK = $PK;
	}
	
	function setFK($FK){
		$this->FK = $FK;
	}
	
	function setNameTable($nameTable){
		$this->nametable = $nameTable;
	}

	function getCategory(){
		return $this->category;
	}
	
	function setCategory($category){
		$this->category = $category;
	}
	
}
?>