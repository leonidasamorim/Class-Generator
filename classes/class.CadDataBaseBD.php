<?
class CadDataBaseBD extends BD{
	
	function CadDataBaseBD(){
		$this->BD();
	}
	
	function getAllDataBase(){
		$sql = "SHOW DATABASES";
		$rs = $this->con->execute($sql);
    return $this->con->fetch_array($rs);
	}

}
?>