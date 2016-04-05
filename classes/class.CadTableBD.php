<?
class CadTableBD extends BD{
	
	function CadTableBD(){
		$this->BD();
	}
	
	function getAllTableDB($nameDB){
		$sql = "SHOW TABLES FROM $nameDB";
		$rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);		
	}
	
}

?>