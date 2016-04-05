<?
include_once dirname(__FILE__).'/class.CadFieldBD.php';
include_once dirname(__FILE__).'/class.Field.php';

class CadField{
	var $cadFieldBD;

	function CadField(){
		$this->cadFieldBD = new CadFieldBD();
	}
	
	function getAllFieldTb($nameTb,$nameBd){
		if($rs = $this->cadFieldBD->getAllFieldTb($nameTb,$nameBd)){
			while ($va = array_shift($rs)){   
				$this->cadFieldBD->tratar($va);
				$vetFields[] = new Field($va['field'],$va['type'],$va['size'],$va['null'],$va['extra'],$va['default'],$va['PK'],$va['FK'],$nameTb);
			}
			return $vetFields;
		}else
			return false;
	}
	
}
?>