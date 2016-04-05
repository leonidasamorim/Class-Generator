<?
class CadFieldBd extends BD{

	function CadFieldBd(){
		$this->BD();		
	}
	
	function getAllFieldTb($nameTb,$nameBd){
		$sql = "SHOW FIELDS FROM $nameTb";
		$this->con->setBd($nameBd);
		$rs  = $this->con->execute($sql) or print $sql."    ".$this->con->conexao->ErrorMsg();
		return $this->con->fetch_array($rs);
	}
	
	function tratar(&$va){
		$typeSize 	= explode("(",$va['type']);
		$va['type'] = $typeSize[0];
		$size 			= explode(")",$typeSize[1]);
		$va['size'] = $size[0];
		$va['PK'] 	= ($va['key'] == 'PRI')?true:false;
		$va['null'] = ($va['null'])?true:false;
		//verificar
		$va['FK'] 	= ($va['key'] == 'FOR')?true:false;
	}
	
}

?>