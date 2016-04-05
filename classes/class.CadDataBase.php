<?
include_once dirname(__FILE__).'/class.CadDataBaseBD.php';
include_once dirname(__FILE__).'/class.DataBase.php';

class CadDataBase{

	var $cadDataBaseBD;
	
	function CadDataBase(){
		$this->cadDataBaseBD = new CadDataBaseBD();
	}
	
	function getAllDataBase(){
		if($rs = $this->cadDataBaseBD->getAllDataBase()){
			while ($va = array_shift($rs))   
				$vetDataBases[] = new DataBase($va['database']);
			return $vetDataBases;
		}else 
			return false;
	}
	
}
?>