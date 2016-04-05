<?
include_once dirname(__FILE__).'/class.CadTableBD.php';
include_once dirname(__FILE__).'/class.CadField.php';
include_once dirname(__FILE__).'/class.Table.php';

class CadTable{
	
	var $cadTableBD;

	function CadTable(){
		$this->cadTableBD = new CadTableBD();
	}
	
	function getAllTableDB($nameDB){
		if($rs = $this->cadTableBD->getAllTableDB($nameDB)){
			$cadField = new CadField();
			while ($va = array_shift($rs)){
				$vetFields = $cadField->getAllFieldTb($va["tables_in_".strtolower($nameDB)],$nameDB);
				$vetTables[] = new Table($va["tables_in_".strtolower($nameDB)],$nameDB,$vetFields);
			}
			return $vetTables;
		}else
			return false;
	}
}
?>